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
            $this->db->table('victims')->insert($row);
        }

        // 2. Volunteer Screening (7 victims screened, victim #4 & #8 not screened yet)
        $screenings = [
            [
                'victim_id' => 1,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 1, 'mampu_sebut_tanggal' => 1,
                'kontak_mata' => 'kurang', 'bicara' => 'pelan', 'menangis_terus' => 1,
                'tampak_panik' => 1, 'sulit_ditenangkan' => 0, 'gemetar' => 1, 'berteriak_histeris' => 0,
                'skala_distress' => 8, 'catatan_relawan' => 'Sangat syok setelah gempa',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 2,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 1, 'mampu_sebut_tanggal' => 1,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => 0,
                'tampak_panik' => 0, 'sulit_ditenangkan' => 0, 'gemetar' => 0, 'berteriak_histeris' => 0,
                'skala_distress' => 4, 'catatan_relawan' => 'Kondisi relatif stabil',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 3,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 0, 'mampu_sebut_tanggal' => 0,
                'kontak_mata' => 'tidak ada', 'bicara' => 'tidak menjawab', 'menangis_terus' => 1,
                'tampak_panik' => 1, 'sulit_ditenangkan' => 1, 'gemetar' => 1, 'berteriak_histeris' => 1,
                'skala_distress' => 9, 'catatan_relawan' => 'Anak terpisah dari orangtua, distres tinggi',
                'relawan_id' => 2, 'created_at' => $now,
            ],
            [
                'victim_id' => 5,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 1, 'mampu_sebut_tanggal' => 1,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => 0,
                'skala_distress' => 3, 'catatan_relawan' => 'Tenang',
                'relawan_id' => 3, 'created_at' => $now,
            ],
            [
                'victim_id' => 6,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 1, 'mampu_sebut_tanggal' => 1,
                'kontak_mata' => 'kurang', 'bicara' => 'pelan', 'menangis_terus' => 1,
                'skala_distress' => 6, 'catatan_relawan' => 'Khawatir dengan ternak dan rumah',
                'relawan_id' => 3, 'created_at' => $now,
            ],
            [
                'victim_id' => 7,
                'mampu_sebut_nama' => 1, 'mampu_sebut_lokasi' => 1, 'mampu_sebut_tanggal' => 1,
                'kontak_mata' => 'baik', 'bicara' => 'normal', 'menangis_terus' => 0,
                'skala_distress' => 5, 'catatan_relawan' => 'Penyintas muda',
                'relawan_id' => 3, 'created_at' => $now,
            ],
        ];

        foreach ($screenings as $row) {
            $this->db->table('volunteer_screening')->insert($row);
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
            $this->db->table('ai_assessment')->insert($row);
        }
    }
}
