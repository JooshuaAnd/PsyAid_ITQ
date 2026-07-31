<?php

namespace App\Services;

use App\Models\AiAssessmentModel;
use App\Models\DisasterInfoModel;
use App\Models\ItqResultModel;
use App\Models\PsychologicalHistoryModel;
use App\Models\VictimModel;
use App\Models\VolunteerScreeningModel;
use Config\Services;

/**
 * AI Clinical Decision Support Service
 * 
 * Multi-Engine Decision Support System:
 * 1. Google Gemini API Engine with Google Search Grounding & RAG Knowledge Retrieval
 * 2. Objective Rule-Based Decision Support Engine with RAG Clinical Guidelines (Fallback)
 */
class AiAssessmentService
{
    public function calculateRisk(int $victimId): array
    {
        // 1. Load victim records
        $victimModel    = new VictimModel();
        $screeningModel = new VolunteerScreeningModel();
        $disasterModel  = new DisasterInfoModel();
        $psychModel     = new PsychologicalHistoryModel();
        $itqResultModel = new ItqResultModel();

        $victim    = $victimModel->find($victimId) ?? [];
        $screening = $screeningModel->getByVictimId($victimId) ?? [];
        $disaster  = $disasterModel->getByVictimId($victimId) ?? [];
        $psych     = $psychModel->getByVictimId($victimId) ?? [];
        $itqResult = $itqResultModel->getByVictimId($victimId) ?? [];

        // 2. Perform RAG Knowledge Base Retrieval
        $ragService   = new ClinicalRagKnowledgeService();
        $ragKnowledge = $ragService->retrieveRelevantKnowledge([
            'victim'    => $victim,
            'screening' => $screening,
            'disaster'  => $disaster,
            'psych'     => $psych,
            'itq'       => $itqResult,
        ]);

        // 3. Check if Gemini API key is configured
        $apiKey = env('GEMINI_API_KEY', getenv('GEMINI_API_KEY') ?: '');
        $assessmentData = null;

        if (! empty($apiKey)) {
            $assessmentData = $this->analyzeWithGemini($apiKey, $victim, $screening, $disaster, $psych, $itqResult, $ragKnowledge);
        }

        // Fallback to Rule-Based Engine with RAG if Gemini failed or unconfigured
        if (empty($assessmentData)) {
            $assessmentData = $this->calculateRuleBasedRisk($victimId, $victim, $screening, $disaster, $psych, $itqResult, $ragKnowledge);
        } else {
            $assessmentData['victim_id'] = $victimId;
        }

        // 4. Save/Update record in ai_assessment table
        $aiModel  = new AiAssessmentModel();
        $existing = $aiModel->where('victim_id', $victimId)->first();

        if ($existing) {
            $aiModel->update($existing['id'], $assessmentData);
        } else {
            $aiModel->insert($assessmentData);
        }

        // 5. Trigger Auto-Assignment Service (SEGMEN 9) for High & Medium risk cases
        if (in_array($assessmentData['risk_level'], ['high', 'medium'], true)) {
            $assignService = new PsychologistAssignmentService();
            $assignService->autoAssign($victimId);
        }

        return $assessmentData;
    }

    /**
     * Call Google Gemini API with Web Search Grounding & RAG Context
     */
    private function analyzeWithGemini(string $apiKey, array $victim, array $screening, array $disaster, array $psych, array $itqResult, array $ragKnowledge): ?array
    {
        $modelName = env('GEMINI_MODEL', getenv('GEMINI_MODEL') ?: 'gemini-1.5-flash');
        $url       = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $apiKey;

        $prompt = $this->buildClinicalPrompt($victim, $screening, $disaster, $psych, $itqResult, $ragKnowledge);

        $payload = [
            'contents' => [
                [
                    'role'  => 'user',
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'tools' => [
                [
                    'googleSearch' => (object) []
                ]
            ],
            'generationConfig' => [
                'temperature'     => 0.2,
                'responseMimeType' => 'application/json'
            ]
        ];

        try {
            $client = Services::curlrequest([
                'timeout'     => 15,
                'http_errors' => false,
            ]);

            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() !== 200) {
                log_message('error', 'Gemini API Error: HTTP ' . $response->getStatusCode() . ' - ' . $response->getBody());
                return null;
            }

            $result  = json_decode($response->getBody(), true);
            $candidate = $result['candidates'][0] ?? [];
            $rawText   = $candidate['content']['parts'][0]['text'] ?? null;

            if (empty($rawText)) {
                return null;
            }

            $aiData = json_decode($rawText, true);
            if (! is_array($aiData) || empty($aiData['risk_level'])) {
                return null;
            }

            // Extract Google Search Grounding Metadata if returned
            $groundingSources = [];
            $groundingMeta = $candidate['groundingMetadata'] ?? [];
            if (! empty($groundingMeta['webSearchQueries'])) {
                $queries = implode(', ', $groundingMeta['webSearchQueries']);
                $groundingSources[] = 'Google Web Search Grounding Queries: "' . $queries . '"';
            }
            if (! empty($groundingMeta['groundingChunks'])) {
                foreach (array_slice($groundingMeta['groundingChunks'], 0, 3) as $chunk) {
                    if (! empty($chunk['web']['title']) && ! empty($chunk['web']['uri'])) {
                        $groundingSources[] = 'Web Source: ' . $chunk['web']['title'] . ' (' . $chunk['web']['uri'] . ')';
                    }
                }
            }

            // Build RAG Knowledge Source Evidence Text
            $ragTitles = array_column($ragKnowledge, 'title');
            $ragEvidence = ! empty($ragTitles) ? 'RAG Clinical Guidelines Retrieved: ' . implode('; ', $ragTitles) : '';

            $evidenceText = $aiData['evidence_sources'] ?? '';
            if (! empty($ragEvidence)) {
                $evidenceText .= "\n• " . $ragEvidence;
            }
            if (! empty($groundingSources)) {
                $evidenceText .= "\n• " . implode("\n• ", $groundingSources);
            }

            // Normalize and sanitize API output
            $riskLevel = strtolower($aiData['risk_level']);
            if (! in_array($riskLevel, ['low', 'medium', 'high'], true)) {
                $riskLevel = 'medium';
            }

            $ptsdRisk = strtolower($aiData['risiko_ptsd_berkembang'] ?? $riskLevel);
            if (! in_array($ptsdRisk, ['low', 'medium', 'high'], true)) {
                $ptsdRisk = $riskLevel;
            }

            return [
                'risk_level'             => $riskLevel,
                'confidence'             => (float) ($aiData['confidence'] ?? 88.00),
                'clinical_priority'     => $aiData['clinical_priority'] ?? ($riskLevel === 'high' ? 'Urgent' : ($riskLevel === 'medium' ? 'Normal' : 'Rendah')),
                'kemungkinan_diagnosis'  => $aiData['kemungkinan_diagnosis'] ?? 'Acute Stress Reaction',
                'risiko_ptsd_berkembang'  => $ptsdRisk,
                'evidence_sources'       => $evidenceText,
                'ai_summary'             => '[Gemini AI + RAG + Web Search] ' . ($aiData['ai_summary'] ?? ''),
                'status'                 => 'ai_generated',
                'generated_at'           => date('Y-m-d H:i:s'),
            ];

        } catch (\Throwable $e) {
            log_message('error', 'Gemini API Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Build Prompt formatted for Gemini API JSON analysis with RAG Context
     */
    private function buildClinicalPrompt(array $victim, array $screening, array $disaster, array $psych, array $itqResult, array $ragKnowledge): string
    {
        $context = [
            'victim_identity_biodata' => [
                'nama'           => $victim['nama'] ?? 'Penyintas Baru',
                'nik'            => $victim['nik'] ?? 'Tidak Diisi',
                'umur'           => ($victim['umur'] ?? '-') . ' tahun',
                'jenis_kelamin'  => ($victim['jenis_kelamin'] ?? 'L') === 'L' ? 'Laki-Laki' : 'Perempuan',
                'alamat'         => $victim['alamat'] ?? '-',
                'no_hp_keluarga' => $victim['no_hp_keluarga'] ?? '-',
                'tanggal_datang' => $victim['tanggal_datang'] ?? '-',
                'jam_datang'     => $victim['jam_datang'] ?? '-',
            ],
            'disaster_trauma_exposure' => [
                'jenis_bencana'       => $disaster['jenis_bencana'] ?? 'Gempa Bumi / Bencana Alam',
                'saksi_kematian'      => ! empty($disaster['saksi_kematian']) ? 'Ya (Saksi Kematian Korban Lain)' : 'Tidak',
                'kehilangan_keluarga' => ! empty($disaster['kehilangan_keluarga']) ? 'Ya (Kehilangan Anggota Keluarga)' : 'Tidak',
                'durasi_terjebak'     => $disaster['durasi_terjebak'] ?? '<1 jam',
                'cedera_fisik'        => ! empty($disaster['cedera']) ? 'Ya' : 'Tidak',
                'rawat_inap'          => ! empty($disaster['rawat_inap']) ? 'Ya' : 'Tidak',
                'kehilangan_rumah'    => ! empty($disaster['kehilangan_rumah']) ? 'Ya (Rumah Hancur)' : 'Tidak',
            ],
            'screening_behavioral_observations' => [
                'mampu_sebut_nama'     => ! empty($screening['mampu_sebut_nama']) ? 'Mampu' : 'Disorientasi (Tidak)',
                'mampu_sebut_lokasi'   => ! empty($screening['mampu_sebut_lokasi']) ? 'Mampu' : 'Disorientasi (Tidak)',
                'mampu_sebut_tanggal'  => ! empty($screening['mampu_sebut_tanggal']) ? 'Mampu' : 'Disorientasi (Tidak)',
                'kontak_mata'          => $screening['kontak_mata'] ?? 'baik',
                'pola_bicara'          => $screening['bicara'] ?? 'normal',
                'menyebut_ingin_mati'  => ! empty($screening['menyebut_ingin_mati']) ? 'YA (INDIKATOR KRITIS)' : 'Tidak',
                'mengancam_bunuh_diri' => ! empty($screening['mengancam_bunuh_diri']) ? 'YA (INDIKATOR KRITIS)' : 'Tidak',
                'melukai_diri'         => ! empty($screening['melukai_diri']) ? 'YA (INDIKATOR KRITIS)' : 'Tidak',
                'berteriak_histeris'   => ! empty($screening['berteriak_histeris']) ? 'Ya' : 'Tidak',
                'diam_total_stupor'    => ! empty($screening['diam_total']) ? 'Ya' : 'Tidak',
                'agresif'              => ! empty($screening['agresif']) ? 'Ya' : 'Tidak',
                'sulit_ditenangkan'    => ! empty($screening['sulit_ditenangkan']) ? 'Ya' : 'Tidak',
                'panik_gemetar'        => (! empty($screening['tampak_panik']) || ! empty($screening['gemetar'])) ? 'Ya' : 'Tidak',
                'menangis_terus'       => ! empty($screening['menangis_terus']) ? 'Ya' : 'Tidak',
                'mencari_keluarga'     => ! empty($screening['mencari_keluarga']) ? 'Ya' : 'Tidak',
                'menolak_makan'        => ! empty($screening['tidak_mau_makan']) ? 'Ya' : 'Tidak',
                'menghindari_orang'    => ! empty($screening['menghindari_orang']) ? 'Ya' : 'Tidak',
            ],
            'psychological_medical_history' => [
                'pernah_konsultasi'            => ! empty($psych['pernah_konsultasi']) ? 'Ya' : 'Tidak',
                'pernah_dirawat_psikiater'      => ! empty($psych['pernah_dirawat_psikiater']) ? 'Ya' : 'Tidak',
                'riwayat_percobaan_bunuh_diri' => ! empty($psych['riwayat_percobaan_bunuh_diri']) ? 'YA (INDIKATOR KRITIS)' : 'Tidak',
                'riwayat_melukai_diri'         => ! empty($psych['riwayat_melukai_diri']) ? 'Ya' : 'Tidak',
                'riwayat_napza'                 => ! empty($psych['riwayat_napza']) ? 'Ya' : 'Tidak',
                'diagnosis_sebelumnya'         => $psych['diagnosis_sebelumnya'] ?? 'Tidak ada',
                'sedang_konsumsi_obat'         => ! empty($psych['sedang_konsumsi_obat']) ? ('Ya - ' . ($psych['nama_obat'] ?? '')) : 'Tidak',
                'penyakit_kronis'              => ! empty($psych['riwayat_penyakit_kronis']) ? ('Ya - ' . ($psych['keterangan_penyakit_kronis'] ?? '')) : 'Tidak',
            ],
            'itq_international_trauma_questionnaire' => ! empty($itqResult) ? [
                'ptsd_score'        => ($itqResult['ptsd_score'] ?? 0) . ' / 24 (' . ($itqResult['ptsd_severity'] ?? 'N/A') . ')',
                'ptsd_criteria_met' => ! empty($itqResult['ptsd_criteria_met']) ? 'TERPENUHI (PTSD Confirmed)' : 'Belum Terpenuhi',
                'dso_score'         => ($itqResult['dso_score'] ?? 0) . ' / 24 (' . ($itqResult['dso_severity'] ?? 'N/A') . ')',
                'dso_criteria_met'  => ! empty($itqResult['dso_criteria_met']) ? 'TERPENUHI (CPTSD Indicator)' : 'Belum Terpenuhi',
                'overall_itq_risk'  => $itqResult['final_diagnosis'] ?? 'N/A',
            ] : 'Instrumen ITQ belum diisi oleh Psikolog Jaga',
            'rag_clinical_retrieved_knowledge_base' => array_map(function($k) {
                return [
                    'id'        => $k['id'],
                    'title'     => $k['title'],
                    'source'    => $k['source'],
                    'guideline' => $k['guideline']
                ];
            }, $ragKnowledge)
        ];

        $jsonContext = json_encode($context, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return <<<PROMPT
Anda adalah sistem pendukung keputusan klinis psikologi bencana (Clinical Decision Support AI) untuk platform PsyAid.
Tugas Anda adalah menganalisis BIODATA PENYINTAS, paparan bencana, observasi skrining relawan, riwayat medis psikologis, hasil ITQ, serta mengintegrasikan PEDOMAN KLINIS RAG (WHO PFA, IASC MHPSS, HIMPSI, ICD-11) dan pencarian Google Web Search.

Data Penyintas Bencana & RAG Knowledge Context:
{$jsonContext}

Petunjuk Analisis & Output Wajib:
1. Mulai narasi 'ai_summary' secara eksplisit menyebutkan nama penyintas, contoh: "Atas nama [Nama Penyintas] (NIK: [NIK], Umur: [Umur] tahun)..."
2. Jika terdapat indikator kritis bunuh diri (menyebut ingin mati / mengancam bunuh diri / melukai diri / riwayat percobaan bunuh diri), tingkat risiko HARUS 'high' dan clinical_priority HARUS 'Urgent'.
3. Rujuk pedoman klinis RAG (WHO PFA, IASC MHPSS, HIMPSI, ICD-11) yang relevan dalam merumuskan rekomendasi intervensi psikologis.
4. Gunakan fitur Google Web Search Grounding untuk menelusuri penanganan klinis / protokol darurat terkini jika diperlukan.
5. Evaluasi tingkat risiko: 'high' (krisis/darurat trauma), 'medium' (sedang/butuh konseling), 'low' (ringan/stabil).
6. Berikan nilai keyakinan (confidence) antara 75.00 sampai 98.00 berdasarkan kelengkapan data.
7. Rumuskan kemungkinan diagnosis klinis awal (seperti Acute Stress Disorder, Major Depressive Episode, PTSD, Complex PTSD / CPTSD, Panic Reaction, atau Mild Stress Response).
8. Buat daftar poin bukti 'evidence_sources' diawali dengan '• ' yang merangkum poin-poin penting dari Identitas, Kebencanaan, Skrining, Riwayat Psikologis, ITQ, serta RAG/Web Grounding.

Kembalikan jawaban HANYA dalam format JSON persis seperti schema berikut:
{
  "risk_level": "high" | "medium" | "low",
  "confidence": 92.5,
  "clinical_priority": "Urgent" | "Normal" | "Rendah",
  "kemungkinan_diagnosis": "string",
  "risiko_ptsd_berkembang": "high" | "medium" | "low",
  "evidence_sources": "• Poin 1\\n• Poin 2",
  "ai_summary": "string"
}
PROMPT;
    }

    /**
     * Objective Rule-Based Decision Support Engine with RAG Guidelines (Dynamic Fallback Method)
     */
    public function calculateRuleBasedRisk(int $victimId, array $victim = [], array $screening = [], array $disaster = [], array $psych = [], array $itqResult = [], array $ragKnowledge = []): array
    {
        if (empty($victim)) {
            $victimModel = new VictimModel();
            $victim      = $victimModel->find($victimId) ?? [];
        }
        if (empty($screening)) {
            $screeningModel = new VolunteerScreeningModel();
            $screening      = $screeningModel->getByVictimId($victimId) ?? [];
        }
        if (empty($disaster)) {
            $disasterModel = new DisasterInfoModel();
            $disaster      = $disasterModel->getByVictimId($victimId) ?? [];
        }
        if (empty($psych)) {
            $psychModel = new PsychologicalHistoryModel();
            $psych      = $psychModel->getByVictimId($victimId) ?? [];
        }
        if (empty($itqResult)) {
            $itqModel  = new ItqResultModel();
            $itqResult = $itqModel->getByVictimId($victimId) ?? [];
        }
        if (empty($ragKnowledge)) {
            $ragService   = new ClinicalRagKnowledgeService();
            $ragKnowledge = $ragService->retrieveRelevantKnowledge([
                'victim'    => $victim,
                'screening' => $screening,
                'disaster'  => $disaster,
                'psych'     => $psych,
                'itq'       => $itqResult,
            ]);
        }

        $namaPenyintas  = $victim['nama'] ?? ('Penyintas #' . $victimId);
        $nikPenyintas   = ! empty($victim['nik']) ? $victim['nik'] : 'Tidak Ada NIK';
        $umurPenyintas  = $victim['umur'] ?? '-';
        $jkPenyintas    = ($victim['jenis_kelamin'] ?? 'L') === 'L' ? 'Laki-Laki' : 'Perempuan';
        $jenisBencana   = $disaster['jenis_bencana'] ?? 'Bencana Alam';
        $durasiTerjebak = $disaster['durasi_terjebak'] ?? '<1 jam';
        $tanggalDatang  = $victim['tanggal_datang'] ?? date('Y-m-d');

        // Objective Weighted Scoring Calculation
        $score    = 0;
        $maxScore = 240;
        $evidence = [];

        // Critical Suicide & Self-Harm Indicators
        if (! empty($screening['menyebut_ingin_mati'])) {
            $score += 30;
            $evidence[] = 'Penyintas verbalisasi ingin mati saat skrining';
        }
        if (! empty($screening['mengancam_bunuh_diri'])) {
            $score += 35;
            $evidence[] = 'Penyintas mengancam tindakan bunuh diri';
        }
        if (! empty($screening['melukai_diri'])) {
            $score += 30;
            $evidence[] = 'Terlihat perilaku melukai diri sendiri (Self-Harm)';
        }
        if (! empty($psych['riwayat_percobaan_bunuh_diri'])) {
            $score += 25;
            $evidence[] = 'Riwayat medis percobaan bunuh diri di masa lalu';
        }
        if (! empty($psych['riwayat_melukai_diri'])) {
            $score += 15;
            $evidence[] = 'Riwayat medis melukai diri';
        }

        // Trauma & Disaster Exposure
        if (! empty($disaster['saksi_kematian'])) {
            $score += 25;
            $evidence[] = 'Saksi kematian korban lain saat bencana ' . $jenisBencana;
        }
        if (! empty($disaster['kehilangan_keluarga'])) {
            $score += 25;
            $evidence[] = 'Kehilangan anggota keluarga inti akibat ' . $jenisBencana;
        }
        if (($disaster['durasi_terjebak'] ?? '') === '>6 jam') {
            $score += 25;
            $evidence[] = 'Terjebak reruntuhan/bencana lebih dari 6 jam';
        } elseif (($disaster['durasi_terjebak'] ?? '') === '1-6 jam') {
            $score += 15;
            $evidence[] = 'Terjebak reruntuhan 1-6 jam';
        }
        if (! empty($disaster['kehilangan_rumah'])) {
            $score += 10;
            $evidence[] = 'Kehilangan tempat tinggal / rumah hancur';
        }
        if (! empty($disaster['cedera']) || ! empty($disaster['rawat_inap'])) {
            $score += 10;
            $evidence[] = 'Menderita cedera fisik / perawatan medis';
        }

        // ITQ Assessment Results Impact
        if (! empty($itqResult)) {
            if (! empty($itqResult['ptsd_criteria_met'])) {
                $score += 30;
                $evidence[] = 'Kuesioner ITQ: Kriteria PTSD Terpenuhi (Skor PTSD: ' . ($itqResult['ptsd_score'] ?? 0) . '/24)';
            }
            if (! empty($itqResult['dso_criteria_met'])) {
                $score += 25;
                $evidence[] = 'Kuesioner ITQ: Kriteria Complex PTSD (DSO) Terpenuhi (Skor DSO: ' . ($itqResult['dso_score'] ?? 0) . '/24)';
            }
            if (($itqResult['final_diagnosis'] ?? '') === 'Complex PTSD (CPTSD)' || ($itqResult['final_diagnosis'] ?? '') === 'PTSD') {
                $score += 20;
            }
        }

        // RAG Knowledge Base Integration into Evidence
        foreach ($ragKnowledge as $ragItem) {
            $evidence[] = '[RAG Clinical Base] ' . $ragItem['title'] . ' (' . $ragItem['source'] . ')';
        }

        // Objective Orientation, Speech & Eye Contact Observations
        $disorientasi = 0;
        if (empty($screening['mampu_sebut_nama'])) $disorientasi++;
        if (empty($screening['mampu_sebut_lokasi'])) $disorientasi++;
        if (empty($screening['mampu_sebut_tanggal'])) $disorientasi++;

        if ($disorientasi >= 2) {
            $score += 20;
            $evidence[] = 'Disorientasi berat (tidak mampu sebut ' . $disorientasi . ' data dasar)';
        } elseif ($disorientasi === 1) {
            $score += 10;
            $evidence[] = 'Disorientasi ringan (1 data dasar tidak terjawab)';
        } else {
            $evidence[] = 'Orientasi dasar baik (mampu sebut nama, lokasi, & tanggal)';
        }

        if (($screening['kontak_mata'] ?? '') === 'tidak ada') {
            $score += 15;
            $evidence[] = 'Kontak mata tidak ada (menghindari penuh)';
        } elseif (($screening['kontak_mata'] ?? '') === 'kurang') {
            $score += 10;
            $evidence[] = 'Kontak mata kurang fokus';
        }

        if (($screening['bicara'] ?? '') === 'berteriak') {
            $score += 15;
            $evidence[] = 'Respon bicara berteriak histeris';
        } elseif (($screening['bicara'] ?? '') === 'tidak menjawab') {
            $score += 15;
            $evidence[] = 'Bicara tidak menjawab (Stupor / Mutisme)';
        } elseif (($screening['bicara'] ?? '') === 'pelan') {
            $score += 10;
            $evidence[] = 'Bicara sangat pelan/berbisik';
        }

        // Behavioral Symptoms
        if (! empty($screening['berteriak_histeris'])) {
            $score += 15;
            $evidence[] = 'Terlihat berteriak histeris di posko';
        }
        if (! empty($screening['diam_total'])) {
            $score += 15;
            $evidence[] = 'Gejala diam total (Stupor/Catatonic)';
        }
        if (! empty($screening['agresif'])) {
            $score += 15;
            $evidence[] = 'Perilaku agresif / ngamuk di posko';
        }
        if (! empty($screening['sulit_ditenangkan'])) {
            $score += 10;
            $evidence[] = 'Sangat sulit ditenangkan oleh relawan';
        }
        if (! empty($screening['tampak_panik']) || ! empty($screening['gemetar'])) {
            $score += 10;
            $evidence[] = 'Tampak panik & tubuh gemetar hebat';
        }
        if (! empty($screening['menangis_terus'])) {
            $score += 10;
            $evidence[] = 'Menangis terus menerus';
        }

        // Determine Risk Level, Confidence & Priority
        if ($score >= 45 || ! empty($screening['menyebut_ingin_mati']) || ! empty($screening['mengancam_bunuh_diri']) || ! empty($screening['melukai_diri']) || ! empty($itqResult['ptsd_criteria_met'])) {
            $riskLevel        = 'high';
            $clinicalPriority = 'Urgent';
            $diagnosis        = ! empty($itqResult['dso_criteria_met']) ? 'Complex PTSD (CPTSD) & Krisis Trauma Bencana' : (! empty($itqResult['ptsd_criteria_met']) ? 'Post-Traumatic Stress Disorder (PTSD) Terkonfirmasi ITQ' : 'Acute Stress Disorder Risiko Tinggi / Potensi Krisis Trauma');
            $risikoPtsd       = 'high';
        } elseif ($score >= 20) {
            $riskLevel        = 'medium';
            $clinicalPriority = 'Normal';
            $diagnosis        = 'Moderate Acute Stress Reaction / Distres Psikologis Sedang';
            $risikoPtsd       = 'medium';
        } else {
            $riskLevel        = 'low';
            $clinicalPriority = 'Rendah';
            $diagnosis        = 'Mild Stress Response / Respon Adaptif Bencana Normal';
            $risikoPtsd       = 'low';
        }

        // Calculate dynamic confidence ratio
        $dataFactor = count($ragKnowledge) * 3;
        $rawRatio   = ($score / $maxScore) * 100;
        $confidence = round(min(98.00, max(75.00, 75.00 + $dataFactor + ($rawRatio * 0.12))), 2);

        // Build dynamic RAG-backed summary
        $narrative = [];
        $narrative[] = '[RAG + Rule-Based Engine] Atas nama ' . $namaPenyintas . ' (NIK: ' . $nikPenyintas . ', Umur: ' . $umurPenyintas . ' thn, ' . $jkPenyintas . '), penyintas bencana ' . $jenisBencana . ' yang tiba di posko pada ' . $tanggalDatang . '.';
        
        $narrative[] = 'Berdasarkan analisis skrining relawan dan RAG Clinical Knowledge Base (retrieved: ' . implode(', ', array_column($ragKnowledge, 'id')) . '), penyintas dikategorikan dalam tingkat risiko ' . strtoupper($riskLevel) . ' (Confidence Ratio: ' . $confidence . '%, Prioritas: ' . $clinicalPriority . ').';

        if (! empty($ragKnowledge[0]['guideline'])) {
            $narrative[] = 'Rekomendasi RAG Klinis (' . $ragKnowledge[0]['source'] . '): ' . $ragKnowledge[0]['guideline'];
        }

        $aiSummary    = implode(' ', $narrative);
        $evidenceText = implode("\n• ", array_merge(['Komponen Bukti & RAG Knowledge Base Terdeteksi:'], array_unique($evidence)));

        return [
            'victim_id'               => $victimId,
            'risk_level'              => $riskLevel,
            'confidence'              => $confidence,
            'clinical_priority'      => $clinicalPriority,
            'kemungkinan_diagnosis'   => $diagnosis,
            'risiko_ptsd_berkembang'   => $risikoPtsd,
            'evidence_sources'        => $evidenceText,
            'ai_summary'              => $aiSummary,
            'generated_at'            => date('Y-m-d H:i:s'),
        ];
    }

    public function generateFollowUpSummary(int $victimId): ?string
    {
        $db = \Config\Database::connect();
        
        $victim = $db->table('victims')->where('id', $victimId)->get()->getRowArray();
        $followups = $db->table('longitudinal_followup')->where('victim_id', $victimId)->orderBy('hari', 'ASC')->get()->getResultArray();
        $itqResult = $db->table('itq_result')->where('victim_id', $victimId)->get()->getRowArray();

        if (!$victim || empty($followups)) {
            return null;
        }

        // Build context for Gemini
        $context = [
            'victim_nama' => $victim['nama'],
            'initial_itq' => [
                'ptsd_score' => $itqResult['ptsd_score'] ?? 0,
                'dso_score' => $itqResult['dso_score'] ?? 0,
                'diagnosis' => $itqResult['final_diagnosis'] ?? 'Unknown'
            ],
            'followups' => []
        ];

        foreach ($followups as $f) {
            $context['followups'][] = [
                'hari_ke' => $f['hari'],
                'ptsd_score' => $f['ptsd_score'],
                'dso_score' => $f['dso_score'],
                'catatan_psikolog' => $f['catatan_psikolog']
            ];
        }

        $jsonContext = json_encode($context, JSON_PRETTY_PRINT);
        
        $prompt = <<<PROMPT
Anda adalah AI Clinical Assistant. Tugas Anda adalah memberikan ringkasan (summary) perkembangan klinis pasien berdasarkan data longitudinal follow-up (pemantauan berkala) terkait gejala PTSD dan DSO (Complex PTSD).

Data:
$jsonContext

Instruksi:
1. Buat ringkasan maksimal 3 paragraf.
2. Analisis tren pergerakan skor PTSD dan DSO dari asesmen awal ke setiap follow up.
3. Apakah ada perbaikan atau perburukan gejala?
4. Berikan rekomendasi singkat untuk psikolog.
PROMPT;

        $apiKey = env('GEMINI_API_KEY', getenv('GEMINI_API_KEY') ?: '');
        if (empty($apiKey)) {
            // Fallback rule-based summary
            return $this->generateRuleBasedFollowUpSummary($context);
        }

        $modelName = env('GEMINI_MODEL', getenv('GEMINI_MODEL') ?: 'gemini-1.5-flash');
        $url       = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $apiKey;

        $payload = [
            'contents' => [['role' => 'user', 'parts' => [['text' => $prompt]]]],
            'generationConfig' => ['temperature' => 0.3]
        ];

        try {
            $client = Services::curlrequest(['timeout' => 15, 'http_errors' => false]);
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody(), true);
                $rawText = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
                if (!empty($rawText)) {
                    return trim($rawText);
                }
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return $this->generateRuleBasedFollowUpSummary($context);
    }

    private function generateRuleBasedFollowUpSummary(array $context): string
    {
        $nama = $context['victim_nama'];
        $initialPtsd = $context['initial_itq']['ptsd_score'];
        $initialDso = $context['initial_itq']['dso_score'];
        $latest = end($context['followups']);
        
        $ptsdTrend = $latest['ptsd_score'] < $initialPtsd ? 'menurun' : 'meningkat/stabil';
        $dsoTrend = $latest['dso_score'] < $initialDso ? 'menurun' : 'meningkat/stabil';

        $summary = "Berdasarkan data monitoring, penyintas atas nama $nama menunjukkan tren skor PTSD yang $ptsdTrend dan skor DSO yang $dsoTrend dibandingkan skor awal. ";
        $summary .= "Pada follow-up terakhir (hari ke-{$latest['hari_ke']}), skor PTSD adalah {$latest['ptsd_score']} dan DSO adalah {$latest['dso_score']}. ";
        $summary .= "Disarankan untuk melanjutkan intervensi saat ini dan terus memantau efektivitasnya.";
        
        return $summary;
    }
}
