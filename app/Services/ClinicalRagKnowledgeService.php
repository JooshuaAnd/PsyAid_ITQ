<?php

namespace App\Services;

/**
 * Clinical RAG Knowledge Service for Disaster Psychology
 * 
 * Retrieval-Augmented Generation (RAG) Knowledge Base containing official 
 * Disaster Mental Health Protocols:
 * 1. WHO Psychological First Aid (PFA) Field Guide
 * 2. IASC Guidelines for MHPSS in Emergency Settings
 * 3. HIMPSI Crisis Intervention & Suicide Protocol
 * 4. ICD-11 PTSD and Complex PTSD (CPTSD) Diagnostic Manual
 * 5. BNPB Guidelines for Bereavement, Loss & Vulnerable Groups
 */
class ClinicalRagKnowledgeService
{
    private array $knowledgeBase = [
        'suicide_crisis' => [
            'id'       => 'RAG-HIMPSI-01',
            'title'    => 'HIMPSI & Hotline 119 Ext 8 Crisis Protocol for Emergency Suicide & Self-Harm',
            'source'   => 'Himpunan Psikologi Indonesia (HIMPSI) & Kementerian Kesehatan RI',
            'guideline' => 'Indikator verbalisasi bunuh diri atau melukai diri memerlukan penanganan darurat Psychological First Aid (PFA) intensif, pengawasan 24 jam tanpa ditinggalkan sendiri, rujukan langsung ke Psikolog Klinis Jaga Posko Utama, dan rujukan psikiatri jika diperlukan.',
            'keywords' => ['menyebut_ingin_mati', 'mengancam_bunuh_diri', 'melukai_diri', 'riwayat_percobaan_bunuh_diri', 'riwayat_melukai_diri']
        ],
        'icd11_ptsd' => [
            'id'       => 'RAG-ICD11-PTSD',
            'title'    => 'ICD-11 Diagnostic Guidelines for PTSD & Complex PTSD (CPTSD)',
            'source'   => 'World Health Organization (WHO) ICD-11 Clinical Descriptions & Diagnostic Requirements',
            'guideline' => 'PTSD dicirikan oleh 3 klaster utama: Re-experiencing (flasback/mimpi buruk), Avoidance (penghindaran), dan Persistent Threat (hyperarousal/panik). CPTSD mencakup klaster PTSD ditambah Disturbances in Self-Organization (DSO: reaktif emosional, konsep diri negatif, & gangguan hubungan interpersonal). Dibutuhkan konseling klinis bertahap (Cognitive Processing Therapy / EMDR).',
            'keywords' => ['ptsd_criteria_met', 'dso_criteria_met', 'mimpi_buruk', 'sulit_tidur', 'tampak_panik']
        ],
        'who_pfa_panic' => [
            'id'       => 'RAG-WHO-PFA-02',
            'title'    => 'WHO Psychological First Aid (PFA): Acute Panic & Stupor Stabilization Protocol',
            'source'   => 'World Health Organization (WHO) Psychological First Aid Field Guide',
            'guideline' => 'Untuk penyintas yang mengalami panik hebat, tubuh gemetar, berteriak histeris, atau stupor (diam total): Terapkan prinsip Look-Listen-Link, gunakan teknik grounding pernapasan (4-7-8 breathing), ciptakan rasa aman fisik, batasi paparan stimulasi trauma, dan penuhi kebutuhan dasar (air, selimut, makanan).',
            'keywords' => ['berteriak_histeris', 'diam_total', 'tampak_panik', 'gemetar', 'agresif', 'sulit_ditenangkan']
        ],
        'iasc_bereavement' => [
            'id'       => 'RAG-IASC-GRIEF',
            'title'    => 'IASC Guidelines on Mental Health & Psychosocial Support: Grief, Loss & Trauma',
            'source'   => 'Inter-Agency Standing Committee (IASC) MHPSS Task Force in Emergency Settings',
            'guideline' => 'Penyintas yang menyaksikan kematian korban lain atau kehilangan anggota keluarga inti memerlukan pendampingan duka cita (grief counseling), dukungan psikososial komunitas (PSS), penyediaan informasi pencarian keluarga (Restoring Family Links/PMI), dan fasilitasi ritual keagamaan/budaya lokal.',
            'keywords' => ['saksi_kematian', 'kehilangan_keluarga', 'mencari_keluarga', 'kehilangan_rumah']
        ],
        'pediatric_disaster' => [
            'id'       => 'RAG-BNPB-PED',
            'title'    => 'BNPB & UNICEF Child-Friendly Spaces (CFS) & Pediatric Disaster Care',
            'source'   => 'BNPB Pedoman Layanan Dukungan Psikososial (LDP) Anak & Kelompok Rentan',
            'guideline' => 'Anak-anak dan remaja terdampak bencana memerlukan intervensi berbasis Ruang Ramah Anak (RRA/CFS), terapi bermain (play therapy), stabilisasi emosi keluarga, serta integrasi kembali ke aktivitas rutinitas terstruktur.',
            'keywords' => ['anak', 'remaja', 'umur_muda']
        ]
    ];

    /**
     * Retrieve Relevant Clinical RAG Guidelines based on victim context
     */
    public function retrieveRelevantKnowledge(array $context): array
    {
        $retrieved = [];

        $screeningModel = $context['screening'] ?? [];
        $disasterModel  = $context['disaster'] ?? [];
        $psychModel     = $context['psych'] ?? [];
        $itqResultModel = $context['itq'] ?? [];
        $victimModel    = $context['victim'] ?? [];

        // Check Suicide Crisis Keywords
        if (! empty($screeningModel['menyebut_ingin_mati']) ||
            ! empty($screeningModel['mengancam_bunuh_diri']) ||
            ! empty($screeningModel['melukai_diri']) ||
            ! empty($psychModel['riwayat_percobaan_bunuh_diri']) ||
            ! empty($psychModel['riwayat_melukai_diri'])) {
            $retrieved[] = $this->knowledgeBase['suicide_crisis'];
        }

        // Check ICD-11 PTSD Keywords
        if (! empty($itqResultModel['ptsd_criteria_met']) ||
            ! empty($itqResultModel['dso_criteria_met']) ||
            ! empty($screeningModel['mimpi_buruk']) ||
            ! empty($screeningModel['sulit_tidur'])) {
            $retrieved[] = $this->knowledgeBase['icd11_ptsd'];
        }

        // Check WHO PFA Panic Keywords
        if (! empty($screeningModel['berteriak_histeris']) ||
            ! empty($screeningModel['diam_total']) ||
            ! empty($screeningModel['tampak_panik']) ||
            ! empty($screeningModel['gemetar']) ||
            ! empty($screeningModel['agresif']) ||
            ! empty($screeningModel['sulit_ditenangkan'])) {
            $retrieved[] = $this->knowledgeBase['who_pfa_panic'];
        }

        // Check Grief & Bereavement Keywords
        if (! empty($disasterModel['saksi_kematian']) ||
            ! empty($disasterModel['kehilangan_keluarga']) ||
            ! empty($screeningModel['mencari_keluarga']) ||
            ! empty($disasterModel['kehilangan_rumah'])) {
            $retrieved[] = $this->knowledgeBase['iasc_bereavement'];
        }

        // Check Pediatric / Child Trauma
        $umur = (int) ($victimModel['umur'] ?? 25);
        if ($umur <= 18) {
            $retrieved[] = $this->knowledgeBase['pediatric_disaster'];
        }

        // Default: If no specific trigger, include WHO PFA Standard
        if (empty($retrieved)) {
            $retrieved[] = $this->knowledgeBase['who_pfa_panic'];
            $retrieved[] = $this->knowledgeBase['iasc_bereavement'];
        }

        return $retrieved;
    }
}
