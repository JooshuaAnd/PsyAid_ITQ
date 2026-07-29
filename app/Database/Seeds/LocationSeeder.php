<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. All 38 Provinces of Indonesia (2026)
        $provincesData = [
            ['id' => 1,  'name' => 'Aceh'],
            ['id' => 2,  'name' => 'Sumatera Utara'],
            ['id' => 3,  'name' => 'Sumatera Barat'],
            ['id' => 4,  'name' => 'Riau'],
            ['id' => 5,  'name' => 'Kepulauan Riau'],
            ['id' => 6,  'name' => 'Jambi'],
            ['id' => 7,  'name' => 'Sumatera Selatan'],
            ['id' => 8,  'name' => 'Kepulauan Bangka Belitung'],
            ['id' => 9,  'name' => 'Bengkulu'],
            ['id' => 10, 'name' => 'Lampung'],
            ['id' => 11, 'name' => 'DKI Jakarta'],
            ['id' => 12, 'name' => 'Jawa Barat'],
            ['id' => 13, 'name' => 'Banten'],
            ['id' => 14, 'name' => 'Jawa Tengah'],
            ['id' => 15, 'name' => 'DI Yogyakarta'],
            ['id' => 16, 'name' => 'Jawa Timur'],
            ['id' => 17, 'name' => 'Bali'],
            ['id' => 18, 'name' => 'Nusa Tenggara Barat'],
            ['id' => 19, 'name' => 'Nusa Tenggara Timur'],
            ['id' => 20, 'name' => 'Kalimantan Barat'],
            ['id' => 21, 'name' => 'Kalimantan Tengah'],
            ['id' => 22, 'name' => 'Kalimantan Selatan'],
            ['id' => 23, 'name' => 'Kalimantan Timur'],
            ['id' => 24, 'name' => 'Kalimantan Utara'],
            ['id' => 25, 'name' => 'Sulawesi Utara'],
            ['id' => 26, 'name' => 'Gorontalo'],
            ['id' => 27, 'name' => 'Sulawesi Tengah'],
            ['id' => 28, 'name' => 'Sulawesi Barat'],
            ['id' => 29, 'name' => 'Sulawesi Selatan'],
            ['id' => 30, 'name' => 'Sulawesi Tenggara'],
            ['id' => 31, 'name' => 'Maluku'],
            ['id' => 32, 'name' => 'Maluku Utara'],
            ['id' => 33, 'name' => 'Papua'],
            ['id' => 34, 'name' => 'Papua Barat'],
            ['id' => 35, 'name' => 'Papua Selatan'],
            ['id' => 36, 'name' => 'Papua Tengah'],
            ['id' => 37, 'name' => 'Papua Pegunungan'],
            ['id' => 38, 'name' => 'Papua Barat Daya'],
        ];

        foreach ($provincesData as $prov) {
            $exists = $db->table('provinces')->where('id', $prov['id'])->get()->getRow();
            if (!$exists) {
                $db->table('provinces')->insert($prov);
            } else {
                $db->table('provinces')->where('id', $prov['id'])->update(['name' => $prov['name']]);
            }
        }

        // 2. Regencies / Cities grouped by Province ID
        $regenciesData = [
            // 1. Aceh
            ['p' => 1, 'name' => 'Kota Banda Aceh'],
            ['p' => 1, 'name' => 'Kota Sabang'],
            ['p' => 1, 'name' => 'Kota Lhokseumawe'],
            ['p' => 1, 'name' => 'Kota Langsa'],
            ['p' => 1, 'name' => 'Kota Subulussalam'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Besar'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Pidie'],
            ['p' => 1, 'name' => 'Kabupaten Pidie Jaya'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Utara'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Timur'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Selatan'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Barat'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Tengah'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Singkil'],
            ['p' => 1, 'name' => 'Kabupaten Bener Meriah'],
            ['p' => 1, 'name' => 'Kabupaten Bireuen'],
            ['p' => 1, 'name' => 'Kabupaten Nagan Raya'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Jaya'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Barat Daya'],
            ['p' => 1, 'name' => 'Kabupaten Aceh Tenggara'],
            ['p' => 1, 'name' => 'Kabupaten Gayo Lues'],
            ['p' => 1, 'name' => 'Kabupaten Simeulue'],

            // 2. Sumatera Utara
            ['p' => 2, 'name' => 'Kota Medan'],
            ['p' => 2, 'name' => 'Kota Binjai'],
            ['p' => 2, 'name' => 'Kota Pematangsiantar'],
            ['p' => 2, 'name' => 'Kota Tanjungbalai'],
            ['p' => 2, 'name' => 'Kota Tebing Tinggi'],
            ['p' => 2, 'name' => 'Kota Sibolga'],
            ['p' => 2, 'name' => 'Kota Padangsidimpuan'],
            ['p' => 2, 'name' => 'Kota Gunungsitoli'],
            ['p' => 2, 'name' => 'Kabupaten Deli Serdang'],
            ['p' => 2, 'name' => 'Kabupaten Karo'],
            ['p' => 2, 'name' => 'Kabupaten Simalungun'],
            ['p' => 2, 'name' => 'Kabupaten Asahan'],
            ['p' => 2, 'name' => 'Kabupaten Dairi'],
            ['p' => 2, 'name' => 'Kabupaten Toba'],
            ['p' => 2, 'name' => 'Kabupaten Mandailing Natal'],
            ['p' => 2, 'name' => 'Kabupaten Nias'],
            ['p' => 2, 'name' => 'Kabupaten Langkat'],
            ['p' => 2, 'name' => 'Kabupaten Serdang Bedagai'],
            ['p' => 2, 'name' => 'Kabupaten Labuhanbatu'],
            ['p' => 2, 'name' => 'Kabupaten Tapanuli Utara'],
            ['p' => 2, 'name' => 'Kabupaten Tapanuli Selatan'],
            ['p' => 2, 'name' => 'Kabupaten Tapanuli Tengah'],
            ['p' => 2, 'name' => 'Kabupaten Pakpak Bharat'],
            ['p' => 2, 'name' => 'Kabupaten Humbang Hasundutan'],
            ['p' => 2, 'name' => 'Kabupaten Batu Bara'],
            ['p' => 2, 'name' => 'Kabupaten Padang Lawas'],
            ['p' => 2, 'name' => 'Kabupaten Padang Lawas Utara'],
            ['p' => 2, 'name' => 'Kabupaten Nias Selatan'],

            // 3. Sumatera Barat
            ['p' => 3, 'name' => 'Kota Padang'],
            ['p' => 3, 'name' => 'Kota Bukittinggi'],
            ['p' => 3, 'name' => 'Kota Payakumbuh'],
            ['p' => 3, 'name' => 'Kota Solok'],
            ['p' => 3, 'name' => 'Kota Sawahlunto'],
            ['p' => 3, 'name' => 'Kota Padang Panjang'],
            ['p' => 3, 'name' => 'Kota Pariaman'],
            ['p' => 3, 'name' => 'Kabupaten Agam'],
            ['p' => 3, 'name' => 'Kabupaten Tanah Datar'],
            ['p' => 3, 'name' => 'Kabupaten Pasaman'],
            ['p' => 3, 'name' => 'Kabupaten Pasaman Barat'],
            ['p' => 3, 'name' => 'Kabupaten Pesisir Selatan'],
            ['p' => 3, 'name' => 'Kabupaten Solok'],
            ['p' => 3, 'name' => 'Kabupaten Solok Selatan'],
            ['p' => 3, 'name' => 'Kabupaten Sijunjung'],
            ['p' => 3, 'name' => 'Kabupaten Dharmasraya'],
            ['p' => 3, 'name' => 'Kabupaten Padang Pariaman'],
            ['p' => 3, 'name' => 'Kabupaten Limapuluh Kota'],
            ['p' => 3, 'name' => 'Kabupaten Kepulauan Mentawai'],

            // 4. Riau
            ['p' => 4, 'name' => 'Kota Pekanbaru'],
            ['p' => 4, 'name' => 'Kota Dumai'],
            ['p' => 4, 'name' => 'Kabupaten Kampar'],
            ['p' => 4, 'name' => 'Kabupaten Bengkalis'],
            ['p' => 4, 'name' => 'Kabupaten Indragiri Hilir'],
            ['p' => 4, 'name' => 'Kabupaten Indragiri Hulu'],
            ['p' => 4, 'name' => 'Kabupaten Pelalawan'],
            ['p' => 4, 'name' => 'Kabupaten Siak'],
            ['p' => 4, 'name' => 'Kabupaten Kuantan Singingi'],
            ['p' => 4, 'name' => 'Kabupaten Rokan Hilir'],
            ['p' => 4, 'name' => 'Kabupaten Rokan Hulu'],
            ['p' => 4, 'name' => 'Kabupaten Kepulauan Meranti'],

            // 5. Kepulauan Riau
            ['p' => 5, 'name' => 'Kota Batam'],
            ['p' => 5, 'name' => 'Kota Tanjungpinang'],
            ['p' => 5, 'name' => 'Kabupaten Bintan'],
            ['p' => 5, 'name' => 'Kabupaten Karimun'],
            ['p' => 5, 'name' => 'Kabupaten Natuna'],
            ['p' => 5, 'name' => 'Kabupaten Lingga'],
            ['p' => 5, 'name' => 'Kabupaten Kepulauan Anambas'],

            // 6. Jambi
            ['p' => 6, 'name' => 'Kota Jambi'],
            ['p' => 6, 'name' => 'Kota Sungai Penuh'],
            ['p' => 6, 'name' => 'Kabupaten Muaro Jambi'],
            ['p' => 6, 'name' => 'Kabupaten Bungo'],
            ['p' => 6, 'name' => 'Kabupaten Tebo'],
            ['p' => 6, 'name' => 'Kabupaten Kerinci'],
            ['p' => 6, 'name' => 'Kabupaten Merangin'],
            ['p' => 6, 'name' => 'Kabupaten Sarolangun'],
            ['p' => 6, 'name' => 'Kabupaten Batanghari'],
            ['p' => 6, 'name' => 'Kabupaten Tanjung Jabung Barat'],
            ['p' => 6, 'name' => 'Kabupaten Tanjung Jabung Timur'],

            // 7. Sumatera Selatan
            ['p' => 7, 'name' => 'Kota Palembang'],
            ['p' => 7, 'name' => 'Kota Prabumulih'],
            ['p' => 7, 'name' => 'Kota Lubuklinggau'],
            ['p' => 7, 'name' => 'Kota Pagar Alam'],
            ['p' => 7, 'name' => 'Kabupaten Ogan Komering Ulu'],
            ['p' => 7, 'name' => 'Kabupaten OKU Timur'],
            ['p' => 7, 'name' => 'Kabupaten OKU Selatan'],
            ['p' => 7, 'name' => 'Kabupaten Ogan Komering Ilir'],
            ['p' => 7, 'name' => 'Kabupaten Muara Enim'],
            ['p' => 7, 'name' => 'Kabupaten Lahat'],
            ['p' => 7, 'name' => 'Kabupaten Musi Rawas'],
            ['p' => 7, 'name' => 'Kabupaten Musi Banyuasin'],
            ['p' => 7, 'name' => 'Kabupaten Banyuasin'],
            ['p' => 7, 'name' => 'Kabupaten Empat Lawang'],
            ['p' => 7, 'name' => 'Kabupaten PALI'],

            // 8. Kepulauan Bangka Belitung
            ['p' => 8, 'name' => 'Kota Pangkalpinang'],
            ['p' => 8, 'name' => 'Kabupaten Bangka'],
            ['p' => 8, 'name' => 'Kabupaten Bangka Barat'],
            ['p' => 8, 'name' => 'Kabupaten Bangka Tengah'],
            ['p' => 8, 'name' => 'Kabupaten Bangka Selatan'],
            ['p' => 8, 'name' => 'Kabupaten Belitung'],
            ['p' => 8, 'name' => 'Kabupaten Belitung Timur'],

            // 9. Bengkulu
            ['p' => 9, 'name' => 'Kota Bengkulu'],
            ['p' => 9, 'name' => 'Kabupaten Bengkulu Utara'],
            ['p' => 9, 'name' => 'Kabupaten Bengkulu Selatan'],
            ['p' => 9, 'name' => 'Kabupaten Bengkulu Tengah'],
            ['p' => 9, 'name' => 'Kabupaten Rejang Lebong'],
            ['p' => 9, 'name' => 'Kabupaten Lebong'],
            ['p' => 9, 'name' => 'Kabupaten Kepahiang'],
            ['p' => 9, 'name' => 'Kabupaten Mukomuko'],
            ['p' => 9, 'name' => 'Kabupaten Seluma'],
            ['p' => 9, 'name' => 'Kabupaten Kaur'],

            // 10. Lampung
            ['p' => 10, 'name' => 'Kota Bandar Lampung'],
            ['p' => 10, 'name' => 'Kota Metro'],
            ['p' => 10, 'name' => 'Kabupaten Lampung Selatan'],
            ['p' => 10, 'name' => 'Kabupaten Lampung Tengah'],
            ['p' => 10, 'name' => 'Kabupaten Lampung Utara'],
            ['p' => 10, 'name' => 'Kabupaten Lampung Barat'],
            ['p' => 10, 'name' => 'Kabupaten Lampung Timur'],
            ['p' => 10, 'name' => 'Kabupaten Tanggamus'],
            ['p' => 10, 'name' => 'Kabupaten Pringsewu'],
            ['p' => 10, 'name' => 'Kabupaten Pesawaran'],
            ['p' => 10, 'name' => 'Kabupaten Way Kanan'],
            ['p' => 10, 'name' => 'Kabupaten Tulang Bawang'],

            // 11. DKI Jakarta
            ['p' => 11, 'name' => 'Kota Jakarta Pusat'],
            ['p' => 11, 'name' => 'Kota Jakarta Utara'],
            ['p' => 11, 'name' => 'Kota Jakarta Barat'],
            ['p' => 11, 'name' => 'Kota Jakarta Selatan'],
            ['p' => 11, 'name' => 'Kota Jakarta Timur'],
            ['p' => 11, 'name' => 'Kabupaten Kepulauan Seribu'],

            // 12. Jawa Barat
            ['p' => 12, 'name' => 'Kota Bandung'],
            ['p' => 12, 'name' => 'Kota Bogor'],
            ['p' => 12, 'name' => 'Kota Depok'],
            ['p' => 12, 'name' => 'Kota Bekasi'],
            ['p' => 12, 'name' => 'Kota Cimahi'],
            ['p' => 12, 'name' => 'Kota Tasikmalaya'],
            ['p' => 12, 'name' => 'Kota Cirebon'],
            ['p' => 12, 'name' => 'Kota Sukabumi'],
            ['p' => 12, 'name' => 'Kota Banjar'],
            ['p' => 12, 'name' => 'Kabupaten Cianjur'],
            ['p' => 12, 'name' => 'Kabupaten Sukabumi'],
            ['p' => 12, 'name' => 'Kabupaten Bogor'],
            ['p' => 12, 'name' => 'Kabupaten Bekasi'],
            ['p' => 12, 'name' => 'Kabupaten Karawang'],
            ['p' => 12, 'name' => 'Kabupaten Purwakarta'],
            ['p' => 12, 'name' => 'Kabupaten Subang'],
            ['p' => 12, 'name' => 'Kabupaten Bandung'],
            ['p' => 12, 'name' => 'Kabupaten Bandung Barat'],
            ['p' => 12, 'name' => 'Kabupaten Sumedang'],
            ['p' => 12, 'name' => 'Kabupaten Garut'],
            ['p' => 12, 'name' => 'Kabupaten Tasikmalaya'],
            ['p' => 12, 'name' => 'Kabupaten Ciamis'],
            ['p' => 12, 'name' => 'Kabupaten Kuningan'],
            ['p' => 12, 'name' => 'Kabupaten Cirebon'],
            ['p' => 12, 'name' => 'Kabupaten Majalengka'],
            ['p' => 12, 'name' => 'Kabupaten Indramayu'],
            ['p' => 12, 'name' => 'Kabupaten Pangandaran'],

            // 13. Banten
            ['p' => 13, 'name' => 'Kota Tangerang'],
            ['p' => 13, 'name' => 'Kota Tangerang Selatan'],
            ['p' => 13, 'name' => 'Kota Serang'],
            ['p' => 13, 'name' => 'Kota Cilegon'],
            ['p' => 13, 'name' => 'Kabupaten Tangerang'],
            ['p' => 13, 'name' => 'Kabupaten Serang'],
            ['p' => 13, 'name' => 'Kabupaten Pandeglang'],
            ['p' => 13, 'name' => 'Kabupaten Lebak'],

            // 14. Jawa Tengah
            ['p' => 14, 'name' => 'Kota Semarang'],
            ['p' => 14, 'name' => 'Kota Surakarta'],
            ['p' => 14, 'name' => 'Kota Magelang'],
            ['p' => 14, 'name' => 'Kota Salatiga'],
            ['p' => 14, 'name' => 'Kota Pekalongan'],
            ['p' => 14, 'name' => 'Kota Tegal'],
            ['p' => 14, 'name' => 'Kabupaten Magelang'],
            ['p' => 14, 'name' => 'Kabupaten Karanganyar'],
            ['p' => 14, 'name' => 'Kabupaten Banyumas'],
            ['p' => 14, 'name' => 'Kabupaten Cilacap'],
            ['p' => 14, 'name' => 'Kabupaten Purbalingga'],
            ['p' => 14, 'name' => 'Kabupaten Banjarnegara'],
            ['p' => 14, 'name' => 'Kabupaten Kebumen'],
            ['p' => 14, 'name' => 'Kabupaten Purworejo'],
            ['p' => 14, 'name' => 'Kabupaten Wonosobo'],
            ['p' => 14, 'name' => 'Kabupaten Boyolali'],
            ['p' => 14, 'name' => 'Kabupaten Klaten'],
            ['p' => 14, 'name' => 'Kabupaten Sukoharjo'],
            ['p' => 14, 'name' => 'Kabupaten Wonogiri'],
            ['p' => 14, 'name' => 'Kabupaten Sragen'],
            ['p' => 14, 'name' => 'Kabupaten Grobogan'],
            ['p' => 14, 'name' => 'Kabupaten Blora'],
            ['p' => 14, 'name' => 'Kabupaten Rembang'],
            ['p' => 14, 'name' => 'Kabupaten Pati'],
            ['p' => 14, 'name' => 'Kabupaten Kudus'],
            ['p' => 14, 'name' => 'Kabupaten Jepara'],
            ['p' => 14, 'name' => 'Kabupaten Demak'],
            ['p' => 14, 'name' => 'Kabupaten Semarang'],
            ['p' => 14, 'name' => 'Kabupaten Temanggung'],
            ['p' => 14, 'name' => 'Kabupaten Kendal'],
            ['p' => 14, 'name' => 'Kabupaten Batang'],
            ['p' => 14, 'name' => 'Kabupaten Pekalongan'],
            ['p' => 14, 'name' => 'Kabupaten Pemalang'],
            ['p' => 14, 'name' => 'Kabupaten Tegal'],
            ['p' => 14, 'name' => 'Kabupaten Brebes'],

            // 15. DI Yogyakarta
            ['p' => 15, 'name' => 'Kota Yogyakarta'],
            ['p' => 15, 'name' => 'Kabupaten Sleman'],
            ['p' => 15, 'name' => 'Kabupaten Bantul'],
            ['p' => 15, 'name' => 'Kabupaten Gunungkidul'],
            ['p' => 15, 'name' => 'Kabupaten Kulon Progo'],

            // 16. Jawa Timur
            ['p' => 16, 'name' => 'Kota Surabaya'],
            ['p' => 16, 'name' => 'Kota Malang'],
            ['p' => 16, 'name' => 'Kota Kediri'],
            ['p' => 16, 'name' => 'Kota Madiun'],
            ['p' => 16, 'name' => 'Kota Blitar'],
            ['p' => 16, 'name' => 'Kota Pasuruan'],
            ['p' => 16, 'name' => 'Kota Probolinggo'],
            ['p' => 16, 'name' => 'Kota Batu'],
            ['p' => 16, 'name' => 'Kota Mojokerto'],
            ['p' => 16, 'name' => 'Kabupaten Sidoarjo'],
            ['p' => 16, 'name' => 'Kabupaten Gresik'],
            ['p' => 16, 'name' => 'Kabupaten Lamongan'],
            ['p' => 16, 'name' => 'Kabupaten Tuban'],
            ['p' => 16, 'name' => 'Kabupaten Bojonegoro'],
            ['p' => 16, 'name' => 'Kabupaten Ngawi'],
            ['p' => 16, 'name' => 'Kabupaten Magetan'],
            ['p' => 16, 'name' => 'Kabupaten Madiun'],
            ['p' => 16, 'name' => 'Kabupaten Nganjuk'],
            ['p' => 16, 'name' => 'Kabupaten Jombang'],
            ['p' => 16, 'name' => 'Kabupaten Mojokerto'],
            ['p' => 16, 'name' => 'Kabupaten Pasuruan'],
            ['p' => 16, 'name' => 'Kabupaten Probolinggo'],
            ['p' => 16, 'name' => 'Kabupaten Lumajang'],
            ['p' => 16, 'name' => 'Kabupaten Jember'],
            ['p' => 16, 'name' => 'Kabupaten Banyuwangi'],
            ['p' => 16, 'name' => 'Kabupaten Bondowoso'],
            ['p' => 16, 'name' => 'Kabupaten Situbondo'],
            ['p' => 16, 'name' => 'Kabupaten Kediri'],
            ['p' => 16, 'name' => 'Kabupaten Blitar'],
            ['p' => 16, 'name' => 'Kabupaten Tulungagung'],
            ['p' => 16, 'name' => 'Kabupaten Trenggalek'],
            ['p' => 16, 'name' => 'Kabupaten Ponorogo'],
            ['p' => 16, 'name' => 'Kabupaten Pacitan'],
            ['p' => 16, 'name' => 'Kabupaten Bangkalan'],
            ['p' => 16, 'name' => 'Kabupaten Sampang'],
            ['p' => 16, 'name' => 'Kabupaten Pamekasan'],
            ['p' => 16, 'name' => 'Kabupaten Sumenep'],

            // 17. Bali
            ['p' => 17, 'name' => 'Kota Denpasar'],
            ['p' => 17, 'name' => 'Kabupaten Badung'],
            ['p' => 17, 'name' => 'Kabupaten Gianyar'],
            ['p' => 17, 'name' => 'Kabupaten Tabanan'],
            ['p' => 17, 'name' => 'Kabupaten Buleleng'],
            ['p' => 17, 'name' => 'Kabupaten Karangasem'],
            ['p' => 17, 'name' => 'Kabupaten Klungkung'],
            ['p' => 17, 'name' => 'Kabupaten Bangli'],
            ['p' => 17, 'name' => 'Kabupaten Jembrana'],

            // 18. Nusa Tenggara Barat
            ['p' => 18, 'name' => 'Kota Mataram'],
            ['p' => 18, 'name' => 'Kota Bima'],
            ['p' => 18, 'name' => 'Kabupaten Lombok Barat'],
            ['p' => 18, 'name' => 'Kabupaten Lombok Tengah'],
            ['p' => 18, 'name' => 'Kabupaten Lombok Timur'],
            ['p' => 18, 'name' => 'Kabupaten Lombok Utara'],
            ['p' => 18, 'name' => 'Kabupaten Sumbawa'],
            ['p' => 18, 'name' => 'Kabupaten Sumbawa Barat'],
            ['p' => 18, 'name' => 'Kabupaten Dompu'],
            ['p' => 18, 'name' => 'Kabupaten Bima'],

            // 19. Nusa Tenggara Timur
            ['p' => 19, 'name' => 'Kota Kupang'],
            ['p' => 19, 'name' => 'Kabupaten Kupang'],
            ['p' => 19, 'name' => 'Kabupaten Timor Tengah Selatan'],
            ['p' => 19, 'name' => 'Kabupaten Timor Tengah Utara'],
            ['p' => 19, 'name' => 'Kabupaten Belu'],
            ['p' => 19, 'name' => 'Kabupaten Malaka'],
            ['p' => 19, 'name' => 'Kabupaten Rote Ndao'],
            ['p' => 19, 'name' => 'Kabupaten Flores Timur'],
            ['p' => 19, 'name' => 'Kabupaten Sikka'],
            ['p' => 19, 'name' => 'Kabupaten Ende'],
            ['p' => 19, 'name' => 'Kabupaten Manggarai'],
            ['p' => 19, 'name' => 'Kabupaten Manggarai Barat'],
            ['p' => 19, 'name' => 'Kabupaten Sumba Barat'],
            ['p' => 19, 'name' => 'Kabupaten Sumba Timur'],

            // 20. Kalimantan Barat
            ['p' => 20, 'name' => 'Kota Pontianak'],
            ['p' => 20, 'name' => 'Kota Singkawang'],
            ['p' => 20, 'name' => 'Kabupaten Kubu Raya'],
            ['p' => 20, 'name' => 'Kabupaten Mempawah'],
            ['p' => 20, 'name' => 'Kabupaten Sambas'],
            ['p' => 20, 'name' => 'Kabupaten Bengkayang'],
            ['p' => 20, 'name' => 'Kabupaten Landak'],
            ['p' => 20, 'name' => 'Kabupaten Sanggau'],
            ['p' => 20, 'name' => 'Kabupaten Sintang'],
            ['p' => 20, 'name' => 'Kabupaten Ketapang'],

            // 21. Kalimantan Tengah
            ['p' => 21, 'name' => 'Kota Palangka Raya'],
            ['p' => 21, 'name' => 'Kabupaten Kotawaringin Barat'],
            ['p' => 21, 'name' => 'Kabupaten Kotawaringin Timur'],
            ['p' => 21, 'name' => 'Kabupaten Kapuas'],
            ['p' => 21, 'name' => 'Kabupaten Barito Selatan'],
            ['p' => 21, 'name' => 'Kabupaten Barito Utara'],
            ['p' => 21, 'name' => 'Kabupaten Katingan'],
            ['p' => 21, 'name' => 'Kabupaten Seruyan'],

            // 22. Kalimantan Selatan
            ['p' => 22, 'name' => 'Kota Banjarmasin'],
            ['p' => 22, 'name' => 'Kota Banjarbaru'],
            ['p' => 22, 'name' => 'Kabupaten Banjar'],
            ['p' => 22, 'name' => 'Kabupaten Tanah Laut'],
            ['p' => 22, 'name' => 'Kabupaten Tanah Bumbu'],
            ['p' => 22, 'name' => 'Kabupaten Kotabaru'],
            ['p' => 22, 'name' => 'Kabupaten Barito Kuala'],
            ['p' => 22, 'name' => 'Kabupaten Tabalong'],

            // 23. Kalimantan Timur
            ['p' => 23, 'name' => 'Kota Samarinda'],
            ['p' => 23, 'name' => 'Kota Balikpapan'],
            ['p' => 23, 'name' => 'Kota Bontang'],
            ['p' => 23, 'name' => 'Kabupaten Kutai Kartanegara'],
            ['p' => 23, 'name' => 'Kabupaten Kutai Timur'],
            ['p' => 23, 'name' => 'Kabupaten Kutai Barat'],
            ['p' => 23, 'name' => 'Kabupaten Paser'],
            ['p' => 23, 'name' => 'Kabupaten Penajam Paser Utara'],
            ['p' => 23, 'name' => 'Kabupaten Berau'],

            // 24. Kalimantan Utara
            ['p' => 24, 'name' => 'Kota Tarakan'],
            ['p' => 24, 'name' => 'Kabupaten Bulungan'],
            ['p' => 24, 'name' => 'Kabupaten Malinau'],
            ['p' => 24, 'name' => 'Kabupaten Nunukan'],
            ['p' => 24, 'name' => 'Kabupaten Tana Tidung'],

            // 25. Sulawesi Utara
            ['p' => 25, 'name' => 'Kota Manado'],
            ['p' => 25, 'name' => 'Kota Bitung'],
            ['p' => 25, 'name' => 'Kota Tomohon'],
            ['p' => 25, 'name' => 'Kota Kotamobagu'],
            ['p' => 25, 'name' => 'Kabupaten Minahasa'],
            ['p' => 25, 'name' => 'Kabupaten Minahasa Utara'],
            ['p' => 25, 'name' => 'Kabupaten Minahasa Selatan'],
            ['p' => 25, 'name' => 'Kabupaten Bolaang Mongondow'],
            ['p' => 25, 'name' => 'Kabupaten Kepulauan Sangihe'],

            // 26. Gorontalo
            ['p' => 26, 'name' => 'Kota Gorontalo'],
            ['p' => 26, 'name' => 'Kabupaten Gorontalo'],
            ['p' => 26, 'name' => 'Kabupaten Gorontalo Utara'],
            ['p' => 26, 'name' => 'Kabupaten Boalemo'],
            ['p' => 26, 'name' => 'Kabupaten Bone Bolango'],
            ['p' => 26, 'name' => 'Kabupaten Pohuwato'],

            // 27. Sulawesi Tengah
            ['p' => 27, 'name' => 'Kota Palu'],
            ['p' => 27, 'name' => 'Kabupaten Sigi'],
            ['p' => 27, 'name' => 'Kabupaten Donggala'],
            ['p' => 27, 'name' => 'Kabupaten Parigi Moutong'],
            ['p' => 27, 'name' => 'Kabupaten Poso'],
            ['p' => 27, 'name' => 'Kabupaten Banggai'],
            ['p' => 27, 'name' => 'Kabupaten Morowali'],
            ['p' => 27, 'name' => 'Kabupaten Tolitoli'],

            // 28. Sulawesi Barat
            ['p' => 28, 'name' => 'Kabupaten Mamuju'],
            ['p' => 28, 'name' => 'Kabupaten Mamuju Tengah'],
            ['p' => 28, 'name' => 'Kabupaten Pasangkayu'],
            ['p' => 28, 'name' => 'Kabupaten Polewali Mandar'],
            ['p' => 28, 'name' => 'Kabupaten Majene'],
            ['p' => 28, 'name' => 'Kabupaten Mamasa'],

            // 29. Sulawesi Selatan
            ['p' => 29, 'name' => 'Kota Makassar'],
            ['p' => 29, 'name' => 'Kota Parepare'],
            ['p' => 29, 'name' => 'Kota Palopo'],
            ['p' => 29, 'name' => 'Kabupaten Gowa'],
            ['p' => 29, 'name' => 'Kabupaten Maros'],
            ['p' => 29, 'name' => 'Kabupaten Pangkajene dan Kepulauan'],
            ['p' => 29, 'name' => 'Kabupaten Barru'],
            ['p' => 29, 'name' => 'Kabupaten Bone'],
            ['p' => 29, 'name' => 'Kabupaten Soppeng'],
            ['p' => 29, 'name' => 'Kabupaten Wajo'],
            ['p' => 29, 'name' => 'Kabupaten Pinrang'],
            ['p' => 29, 'name' => 'Kabupaten Luwu'],
            ['p' => 29, 'name' => 'Kabupaten Tana Toraja'],
            ['p' => 29, 'name' => 'Kabupaten Bulukumba'],

            // 30. Sulawesi Tenggara
            ['p' => 30, 'name' => 'Kota Kendari'],
            ['p' => 30, 'name' => 'Kota Baubau'],
            ['p' => 30, 'name' => 'Kabupaten Konawe'],
            ['p' => 30, 'name' => 'Kabupaten Konawe Selatan'],
            ['p' => 30, 'name' => 'Kabupaten Kolaka'],
            ['p' => 30, 'name' => 'Kabupaten Muna'],
            ['p' => 30, 'name' => 'Kabupaten Buton'],
            ['p' => 30, 'name' => 'Kabupaten Wakatobi'],

            // 31. Maluku
            ['p' => 31, 'name' => 'Kota Ambon'],
            ['p' => 31, 'name' => 'Kota Tual'],
            ['p' => 31, 'name' => 'Kabupaten Maluku Tengah'],
            ['p' => 31, 'name' => 'Kabupaten Seram Bagian Barat'],
            ['p' => 31, 'name' => 'Kabupaten Seram Bagian Timur'],
            ['p' => 31, 'name' => 'Kabupaten Buru'],

            // 32. Maluku Utara
            ['p' => 32, 'name' => 'Kota Ternate'],
            ['p' => 32, 'name' => 'Kota Tidore Kepulauan'],
            ['p' => 32, 'name' => 'Kabupaten Halmahera Barat'],
            ['p' => 32, 'name' => 'Kabupaten Halmahera Utara'],
            ['p' => 32, 'name' => 'Kabupaten Halmahera Selatan'],
            ['p' => 32, 'name' => 'Kabupaten Pulau Morotai'],

            // 33. Papua
            ['p' => 33, 'name' => 'Kota Jayapura'],
            ['p' => 33, 'name' => 'Kabupaten Jayapura'],
            ['p' => 33, 'name' => 'Kabupaten Keerom'],
            ['p' => 33, 'name' => 'Kabupaten Sarmi'],
            ['p' => 33, 'name' => 'Kabupaten Biak Numfor'],
            ['p' => 33, 'name' => 'Kabupaten Kepulauan Yapen'],

            // 34. Papua Barat
            ['p' => 34, 'name' => 'Kota Manokwari'],
            ['p' => 34, 'name' => 'Kabupaten Manokwari'],
            ['p' => 34, 'name' => 'Kabupaten Teluk Bintuni'],
            ['p' => 34, 'name' => 'Kabupaten Teluk Wondama'],
            ['p' => 34, 'name' => 'Kabupaten Kaimana'],
            ['p' => 34, 'name' => 'Kabupaten Fakfak'],

            // 35. Papua Selatan
            ['p' => 35, 'name' => 'Kabupaten Merauke'],
            ['p' => 35, 'name' => 'Kabupaten Boven Digoel'],
            ['p' => 35, 'name' => 'Kabupaten Mappi'],
            ['p' => 35, 'name' => 'Kabupaten Asmat'],

            // 36. Papua Tengah
            ['p' => 36, 'name' => 'Kabupaten Nabire'],
            ['p' => 36, 'name' => 'Kabupaten Puncak Jaya'],
            ['p' => 36, 'name' => 'Kabupaten Paniai'],
            ['p' => 36, 'name' => 'Kabupaten Mimika'],
            ['p' => 36, 'name' => 'Kabupaten Puncak'],

            // 37. Papua Pegunungan
            ['p' => 37, 'name' => 'Kabupaten Jayawijaya'],
            ['p' => 37, 'name' => 'Kabupaten Pegunungan Bintang'],
            ['p' => 37, 'name' => 'Kabupaten Yahukimo'],
            ['p' => 37, 'name' => 'Kabupaten Tolikara'],
            ['p' => 37, 'name' => 'Kabupaten Lanny Jaya'],

            // 38. Papua Barat Daya
            ['p' => 38, 'name' => 'Kota Sorong'],
            ['p' => 38, 'name' => 'Kabupaten Sorong'],
            ['p' => 38, 'name' => 'Kabupaten Sorong Selatan'],
            ['p' => 38, 'name' => 'Kabupaten Raja Ampat'],
            ['p' => 38, 'name' => 'Kabupaten Tambrauw'],
            ['p' => 38, 'name' => 'Kabupaten Maybrat'],
        ];

        foreach ($regenciesData as $reg) {
            $exists = $db->table('regencies')
                ->where('province_id', $reg['p'])
                ->where('name', $reg['name'])
                ->get()->getRow();

            if (!$exists) {
                $db->table('regencies')->insert([
                    'province_id' => $reg['p'],
                    'name'        => $reg['name'],
                ]);
            }
        }
    }
}
