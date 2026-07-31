<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyVictimSeeder extends Seeder
{
    public function run()
    {
        $today = date('Y-m-d');
        $now   = date('Y-m-d H:i:s');

        // 1. Victims List (8 victims spread across Posko 1, 2, 3)
        $victims = [
            [
                'posko_id'      => 1, // Posko Utama Cianjur
                'nama'          => 'Siti Aminah',
                'jenis_kelamin' => 'P',
                'umur'          => 35,
                'nik'           => '3203014508880001',
                'no_hp_keluarga'=> '081234567890',
                'alamat'        => 'Desa Cugenang RT 02/01, Cianjur',
                'tanggal_datang'=> $today,
                'jam_datang'    => '08:30:00',
                'ditemukan_oleh_relawan_id' => 2,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 1,
                'nama'          => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'umur'          => 42,
                'nik'           => '3203011204820003',
                'no_hp_keluarga'=> '081298765432',
                'alamat'        => 'Desa Cugenang RT 01/02, Cianjur',
                'tanggal_datang'=> $today,
                'jam_datang'    => '09:15:00',
                'ditemukan_oleh_relawan_id' => 2,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 1,
                'nama'          => 'Rina Rose',
                'jenis_kelamin' => 'P',
                'umur'          => 19,
                'nik'           => '3203015509040005',
                'no_hp_keluarga'=> '085712345678',
                'alamat'        => 'Desa Nagrak, Cianjur',
                'tanggal_datang'=> $today,
                'jam_datang'    => '10:00:00',
                'ditemukan_oleh_relawan_id' => 2,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 1,
                'nama'          => 'Ahmad Fauzi',
                'jenis_kelamin' => 'L',
                'umur'          => 50,
                'nik'           => '3203011010730002',
                'no_hp_keluarga'=> '081311223344',
                'alamat'        => 'Desa Cugenang RT 03/01, Cianjur',
                'tanggal_datang'=> $today,
                'jam_datang'    => '11:20:00',
                'ditemukan_oleh_relawan_id' => 2,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 2, // Posko Lapangan Majalengka
                'nama'          => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'umur'          => 28,
                'nik'           => '3210014203950004',
                'no_hp_keluarga'=> '087899887766',
                'alamat'        => 'Kecamatan Kadipaten, Majalengka',
                'tanggal_datang'=> $today,
                'jam_datang'    => '07:45:00',
                'ditemukan_oleh_relawan_id' => 3,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 2,
                'nama'          => 'Hendra Wijaya',
                'jenis_kelamin' => 'L',
                'umur'          => 38,
                'nik'           => '3210011506850007',
                'no_hp_keluarga'=> '081900112233',
                'alamat'        => 'Desa Liangjulang, Majalengka',
                'tanggal_datang'=> $today,
                'jam_datang'    => '08:10:00',
                'ditemukan_oleh_relawan_id' => 3,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 2,
                'nama'          => 'Maya Indah',
                'jenis_kelamin' => 'P',
                'umur'          => 24,
                'nik'           => '3210016801990009',
                'no_hp_keluarga'=> '085233445566',
                'alamat'        => 'Kadipaten, Majalengka',
                'tanggal_datang'=> $today,
                'jam_datang'    => '10:30:00',
                'ditemukan_oleh_relawan_id' => 3,
                'created_at'    => $now,
            ],
            [
                'posko_id'      => 3, // Posko Siaga Karanganyar
                'nama'          => 'Trikurnia',
                'jenis_kelamin' => 'L',
                'umur'          => 60,
                'nik'           => '3313010507630008',
                'no_hp_keluarga'=> '081543219876',
                'alamat'        => 'Desa Tawangmangu, Karanganyar',
                'tanggal_datang'=> $today,
                'jam_datang'    => '09:00:00',
                'ditemukan_oleh_relawan_id' => null,
                'created_at'    => $now,
            ],
        ];

        foreach ($victims as $row) {
            $exists = $this->db->table('victims')->where('nik', $row['nik'])->get()->getRow();
            if (!$exists) {
                $this->db->table('victims')->insert($row);
            } else {
                $this->db->table('victims')->where('nik', $row['nik'])->update($row);
            }
        }

        // 2. Volunteer Screening (7 victims screened, victim #4 & #8 not screened yet)
        $screenings = [
            [
                'victim_id' => 1,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => true, 'mampu_sebut_tanggal' => true,
                'kontak_mata' => 'kurang', 'bicara' => 'pelan', 'menangis_terus' => true,
                'tampak_panik' => true, 'sulit_ditenangkan' => false, 'gemetar' => true, 'berteriak_histeris' => false,
                'skala_distress' => 8, 'catatan_relawan' => 'Sangat syok setelah gempa',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 2,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => true, 'mampu_sebut_tanggal' => true,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => false,
                'tampak_panik' => false, 'sulit_ditenangkan' => false, 'gemetar' => false, 'berteriak_histeris' => false,
                'skala_distress' => 4, 'catatan_relawan' => 'Kondisi relatif stabil',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 3,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => false, 'mampu_sebut_tanggal' => false,
                'kontak_mata' => 'tidak ada', 'bicara' => 'tidak menjawab', 'menangis_terus' => true,
                'tampak_panik' => true, 'sulit_ditenangkan' => true, 'gemetar' => true, 'berteriak_histeris' => true,
                'skala_distress' => 9, 'catatan_relawan' => 'Anak terpisah dari orangtua, distres tinggi',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 5,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => true, 'mampu_sebut_tanggal' => true,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => false,
                'skala_distress' => 3, 'catatan_relawan' => 'Tenang',
                'relawan_id' => 3, 'created_at' => $now,
            ],
            [
                'victim_id' => 6,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => true, 'mampu_sebut_tanggal' => true,
                'kontak_mata' => 'kurang', 'bicara' => 'pelan', 'menangis_terus' => true,
                'skala_distress' => 6, 'catatan_relawan' => 'Khawatir dengan ternak dan rumah',
                'relawan_id' => 3, 'created_at' => $now,
            ],
            [
                'victim_id' => 7,
                'mampu_sebut_nama' => true, 'mampu_sebut_lokasi' => true, 'mampu_sebut_tanggal' => true,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => false,
                'skala_distress' => 5, 'catatan_relawan' => 'Penyintas muda',
                'relawan_id' => 3, 'created_at' => $now,
            ],
        ];

        foreach ($screenings as $row) {
            $exists = $this->db->table('volunteer_screening')->where('victim_id', $row['victim_id'])->get()->getRow();
            if (!$exists) {
                $this->db->table('volunteer_screening')->insert($row);
            } else {
                $this->db->table('volunteer_screening')->where('victim_id', $row['victim_id'])->update($row);
            }
        }

        // 3. AI Assessment (for screened victims)
        $aiAssessments = [
            [
                'victim_id' => 1,
                'risk_level' => 'high',
                'confidence' => 0.89,
                'clinical_priority' => 'Prioritas 1',
                'kemungkinan_diagnosis' => 'Acute Stress Reaction / High Risk PTSD',
                'risiko_ptsd_berkembang' => 'high',
                'evidence_sources' => 'Skala distress 8/10, gemetar, panik',
                'ai_summary' => 'Penyintas mengalami rekues intervensi PFA segera.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
            [
                'victim_id' => 2,
                'risk_level' => 'low',
                'confidence' => 0.92,
                'clinical_priority' => 'Prioritas 3',
                'kemungkinan_diagnosis' => 'Mild Stress Response',
                'risiko_ptsd_berkembang' => 'low',
                'evidence_sources' => 'Kontak mata baik, bicara normal, distress 4/10',
                'ai_summary' => 'Respon adaptif normal.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
            [
                'victim_id' => 3,
                'risk_level' => 'high',
                'confidence' => 0.95,
                'clinical_priority' => 'Prioritas 1',
                'kemungkinan_diagnosis' => 'Severe Acute Stress Disorder / Trauma Anak',
                'risiko_ptsd_berkembang' => 'high',
                'evidence_sources' => 'Skala distress 9/10, histeris, anak terpisah keluarga',
                'ai_summary' => 'Rekomendasi pendampingan psikologi anak dan pencarian keluarga.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
            [
                'victim_id' => 5,
                'risk_level' => 'low',
                'confidence' => 0.90,
                'clinical_priority' => 'Prioritas 3',
                'kemungkinan_diagnosis' => 'Normal Resilience',
                'risiko_ptsd_berkembang' => 'low',
                'evidence_sources' => 'Distress 3/10',
                'ai_summary' => 'Kondisi baik.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
            [
                'victim_id' => 6,
                'risk_level' => 'medium',
                'confidence' => 0.85,
                'clinical_priority' => 'Prioritas 2',
                'kemungkinan_diagnosis' => 'Moderate Distress Response',
                'risiko_ptsd_berkembang' => 'medium',
                'evidence_sources' => 'Distress 6/10, menangis terus',
                'ai_summary' => 'Perlu monitoring berkala.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
            [
                'victim_id' => 7,
                'risk_level' => 'medium',
                'confidence' => 0.80,
                'clinical_priority' => 'Prioritas 2',
                'kemungkinan_diagnosis' => 'Moderate Stress',
                'risiko_ptsd_berkembang' => 'medium',
                'evidence_sources' => 'Distress 5/10',
                'ai_summary' => 'Konseling kelompok disarankan.',
                'status' => 'ai_generated',
                'generated_at' => $now,
            ],
        ];

        foreach ($aiAssessments as $row) {
            $exists = $this->db->table('ai_assessment')->where('victim_id', $row['victim_id'])->get()->getRow();
            if (!$exists) {
                $this->db->table('ai_assessment')->insert($row);
            } else {
                $this->db->table('ai_assessment')->where('victim_id', $row['victim_id'])->update($row);
            }
        }

        // 4. Psychologist Assignments (Assign all victims to Psikolog ID 4)
        $assignments = [];
        for ($i = 1; $i <= 8; $i++) {
            $assignments[] = [
                'victim_id' => $i,
                'psikolog_id' => 4,
                'assigned_at' => $now,
            ];
        }

        foreach ($assignments as $row) {
            $exists = $this->db->table('psychologist_assignment')->where('victim_id', $row['victim_id'])->get()->getRow();
            if (!$exists) {
                $this->db->table('psychologist_assignment')->insert($row);
            }
        }

        // 5. ITQ Answers (Victim 1: CPTSD High Risk, Victim 2: No PTSD)
        $itqAnswers = [
            [
                'victim_id' => 1,
                'psikolog_id' => 4,
                'item_1' => 3, 'item_2' => 4, 'item_3' => 4, 'item_4' => 3, 'item_5' => 4, 'item_6' => 4, // PTSD (High)
                'item_7' => 3, 'item_8' => 4, 'item_9' => 4, // Impairment
                'item_10' => 4, 'item_11' => 3, 'item_12' => 4, 'item_13' => 4, 'item_14' => 3, 'item_15' => 4, // DSO (High)
                'item_16' => 4, 'item_17' => 3, 'item_18' => 4, // Impairment DSO
                'created_at' => $now
            ],
            [
                'victim_id' => 2,
                'psikolog_id' => 4,
                'item_1' => 0, 'item_2' => 1, 'item_3' => 0, 'item_4' => 0, 'item_5' => 1, 'item_6' => 0, // PTSD (Low)
                'item_7' => 0, 'item_8' => 0, 'item_9' => 0,
                'item_10' => 1, 'item_11' => 0, 'item_12' => 0, 'item_13' => 1, 'item_14' => 0, 'item_15' => 0, // DSO (Low)
                'item_16' => 0, 'item_17' => 0, 'item_18' => 0,
                'created_at' => $now
            ]
        ];

        foreach ($itqAnswers as $row) {
            $exists = $this->db->table('itq_answers')->where('victim_id', $row['victim_id'])->get()->getRow();
            if (!$exists) {
                $this->db->table('itq_answers')->insert($row);
            }
        }

        // 6. ITQ Result
        $itqResults = [
            [
                'victim_id' => 1,
                'ptsd_score' => 22,
                'ptsd_severity' => 'Very Severe',
                'ptsd_percentile' => 99.30,
                'ptsd_criteria_met' => true,
                'dso_score' => 22,
                'dso_severity' => 'Very Severe',
                'dso_percentile' => 99.30,
                'dso_criteria_met' => true,
                'final_diagnosis' => 'Complex PTSD (CPTSD)',
                'reviewed_by' => 4,
                'reviewed_at' => $now,
            ],
            [
                'victim_id' => 2,
                'ptsd_score' => 2,
                'ptsd_severity' => 'Minimal',
                'ptsd_percentile' => 18.00,
                'ptsd_criteria_met' => false,
                'dso_score' => 2,
                'dso_severity' => 'Minimal',
                'dso_percentile' => 18.00,
                'dso_criteria_met' => false,
                'final_diagnosis' => 'No PTSD/CPTSD',
                'reviewed_by' => 4,
                'reviewed_at' => $now,
            ]
        ];

        foreach ($itqResults as $row) {
            $exists = $this->db->table('itq_result')->where('victim_id', $row['victim_id'])->get()->getRow();
            if (!$exists) {
                $this->db->table('itq_result')->insert($row);
            } else {
                $this->db->table('itq_result')->where('victim_id', $row['victim_id'])->update($row);
            }
        }

        // 7. Clinical Action & Review (for Victim 1)
        $reviewExists = $this->db->table('psychologist_review')->where('victim_id', 1)->get()->getRow();
        if (!$reviewExists) {
            $this->db->table('psychologist_review')->insert([
                'victim_id' => 1,
                'psikolog_id' => 4,
                'keluhan_utama' => 'Sering bermimpi buruk dan menghindari tempat keramaian pasca gempa.',
                'penampilan_perilaku' => 'Tampak gelisah, kontak mata kurang.',
                'mood_afek' => 'Cemas, labil',
                'proses_pikir' => 'Koheren tapi isi pikir didominasi rasa takut.',
                'persepsi' => 'Kadang merasa tanah masih bergoyang (ilusi).',
                'insight' => 'Baik',
                'risiko_bunuh_diri' => 'Rendah',
                'catatan_tambahan' => 'Penyintas membutuhkan intervensi intensif.',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $clinicalExists = $this->db->table('clinical_action')->where('victim_id', 1)->get()->getRow();
        if (!$clinicalExists) {
            $this->db->table('clinical_action')->insert([
                'victim_id' => 1,
                'psikolog_id' => 4,
                'ai_recommendation_approved' => true,
                'priority_override' => null,
                'intervensi' => 'CBT',
                'diagnosis_sementara' => 'Complex PTSD pasca bencana alam berat',
                'catatan_klinis' => 'Mohon relawan posko memantau jika penyintas tampak menangis histeris.',
                'jadwal_followup' => date('Y-m-d', strtotime('+3 days')),
                'created_at' => $now,
            ]);
        }
    }
}
