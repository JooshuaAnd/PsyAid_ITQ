# Progressive Web App dan Mode Offline PsyAid

PsyAid dapat dipasang sebagai PWA dan digunakan tanpa jaringan setelah pengguna melakukan sinkronisasi awal dalam keadaan online. Snapshot dipisahkan berdasarkan ID pengguna dan peran agar cache BPBD, relawan, dan psikolog tidak saling tertukar.

## Alur penggunaan

1. Pengguna login menggunakan internet.
2. Browser mengambil `/offline/bootstrap`. Endpoint ini menyusun daftar halaman dan data yang boleh diakses sesi aktif.
3. Service worker mengunduh daftar tersebut ke Cache Storage dan menyimpan waktu snapshot di IndexedDB.
   Aset yang dirujuk HTML (stylesheet, script, font, gambar, audio, dan video) ikut ditemukan dan dipanaskan.
4. Saat offline, navigasi dan GET API menggunakan snapshot akun tersebut.
   Pada Safari/iOS, klik menu juga memiliki fallback langsung dari Cache Storage sehingga navigasi tetap bekerja bila WebKit tidak meneruskan navigasi ke service worker.
5. POST, PUT, PATCH, dan DELETE yang gagal karena jaringan disimpan berurutan di IndexedDB.
6. Ketika koneksi pulih, Background Sync atau event `online` mengirim antrean ke endpoint aslinya dengan cookie sesi aktif.
7. Setelah antrean selesai, snapshot diambil ulang sehingga data lokal mencerminkan database cloud.

Saat logout atau berpindah akun, proses snapshot scope sebelumnya dibatalkan. Cache halaman dan metadata snapshot akun lama dihapus sebelum scope worker menjadi `public`; pesan progres dari scope lama diabaikan oleh akun baru. Sinkronisasi antrean juga membawa scope eksplisit dan berhenti bila akun aktif berubah. Setiap respons HTTP nyata—termasuk login, forbidden, 4xx, atau 5xx tanpa snapshot—tetap disajikan sebagai respons server dan tidak boleh diterjemahkan menjadi halaman offline. Halaman “Perangkat sedang offline” hanya digunakan ketika request jaringan benar-benar gagal atau tidak menghasilkan respons HTTP.

Tombol sinkronisasi di kanan bawah dapat dipakai untuk menjalankan langkah 5–7 secara manual. Badge menampilkan kondisi koneksi, proses snapshot, dan jumlah antrean.

## Cakupan snapshot per peran

| Peran | Data yang dipanaskan saat online |
|---|---|
| BPBD | Dashboard, command center, posko, pemetaan psikolog, tiket, registrasi, seluruh detail posko/penyintas, statistik, dan data gempa terakhir. |
| Relawan | Dashboard posko sendiri, manajemen penyintas, form tambah penyintas, dan detail/JSON penyintas pada posko sendiri. |
| Psikolog | Clinical workspace, assessment, monitoring, serta detail/review/ITQ/chart penyintas yang ditugaskan. |

Daftar URL dibuat oleh `app/Controllers/OfflineController.php`. Semua URL tetap melewati filter autentikasi dan role yang sama seperti akses online.

## Penyimpanan dan strategi request

| Jenis request | Penyimpanan | Strategi |
|---|---|---|
| App shell, ikon, gambar publik, helper | Cache Storage `psyaid-static-v9` | Cache-first. |
| Bootstrap/Bootstrap Icons, font, Swiper, Leaflet, Chart.js, Tailwind, Lucide, Motion | Cache Storage `psyaid-external-v9` | Cache-first setelah pemanasan/runtime, maksimal 250 entri. |
| Halaman HTML dan GET/JSON | `psyaid-pages-{user-id}-{role}-v9` | Network-first; fallback ke snapshot dengan query lalu URL dasar. |
| Mutasi offline | IndexedDB `psyaid-offline`, store `mutations` | Network-first; bila fetch gagal, simpan body, header, URL, metode, scope, dan ID mutasi. |
| Metadata snapshot/konteks | IndexedDB `psyaid-offline`, store `meta` | Menyimpan scope aktif dan waktu snapshot terakhir. |
| Login, register, logout, health, bootstrap manifest | Tidak dicache/diantrekan | Selalu membutuhkan server. |

File upload dari `multipart/form-data` ikut disimpan sebagai body request di IndexedDB. Kuota penyimpanan tetap mengikuti kebijakan browser/perangkat.

## Konsistensi dan keamanan replay

Setiap item antrean memiliki `X-PsyAid-Mutation-Id`. Filter `OfflineMutationFilter` mencatat ID tersebut pada tabel `offline_mutation_receipts`. Mutasi yang responsnya telah sukses tidak dieksekusi ulang apabila Background Sync melakukan retry akibat koneksi terputus pada saat respons kembali ke perangkat.

Header `X-PsyAid-User-Scope` juga dibandingkan dengan sesi aktif. Antrean akun lain tidak dapat dikirim menggunakan sesi yang sedang login. Jika sesi kedaluwarsa, antrean dipertahankan dan UI meminta pengguna login kembali.

Logout ditunda ketika masih ada antrean dan perangkat offline. Saat online, PsyAid mencoba mengosongkan antrean sebelum membersihkan cache akun. Jika server menolak item secara permanen, pengguna harus mengonfirmasi secara eksplisit sebelum logout menghapus antrean tersebut.

> Cache Storage dan IndexedDB adalah penyimpanan aplikasi pada profil browser, bukan media terenkripsi khusus. Perangkat operasional harus memakai screen lock, akun OS terpisah, dan kebijakan penghapusan data yang sesuai untuk data kesehatan.

## Deployment

Jalankan migrasi sebelum atau bersamaan dengan deployment aplikasi:

```bash
php spark migrate
```

Tabel baru:

- `offline_mutation_receipts`: receipt idempoten tanpa menyimpan ulang isi klinis request/response. Pada PostgreSQL, migrasi mengaktifkan RLS dan mencabut akses role Data API `anon`/`authenticated`; tabel hanya dipakai koneksi backend langsung.

PWA harus disajikan melalui HTTPS. `localhost` dan `127.0.0.1` dapat dipakai untuk pengembangan.

## Verifikasi

1. Login online dan tunggu notifikasi “Mode offline siap”.
2. Periksa Cache Storage: ada cache `psyaid-pages-user-{id}-{role}-v9`.
3. Nonaktifkan jaringan lalu buka beberapa menu dan detail yang termasuk cakupan role.
4. Kirim form. URL kembali memuat parameter sementara `offline_queued`, badge menampilkan jumlah antrean, dan record muncul di IndexedDB store `mutations`.
5. Aktifkan jaringan. Pastikan antrean menjadi nol, perubahan muncul setelah snapshot diperbarui, dan receipt tersedia di database.
6. Ulangi dengan ID mutasi yang sama dan pastikan server membalas `208` tanpa menjalankan CRUD dua kali.
7. Jalankan test:

```bash
composer test
```

## File utama

- `public/service-worker.js`: routing cache, IndexedDB queue, Background Sync, dan snapshot warmer.
- `public/pwa.js`: registrasi, konteks akun, UI status, sinkronisasi manual, dan logout guard.
- `app/Controllers/OfflineController.php`: manifest snapshot berbasis role.
- `app/Filters/OfflineMutationFilter.php`: idempotensi dan validasi scope replay.
- `app/Database/Migrations/2026-08-07-000001_CreateOfflineMutationReceiptsTable.php`: receipt replay database.

## Pembaruan ikon aplikasi

URL manifest, favicon, dan ikon memakai versi (`?v=20260808-2`) agar browser tidak mempertahankan ikon lama. `public/favicon.ico` harus berupa berkas ICO valid, bukan PNG yang hanya diberi ekstensi `.ico`; Safari juga diberi favicon PNG 32×32 dan `apple-touch-icon-precomposed` secara eksplisit. Service worker memakai cache `v11`, sedangkan `pwa.js` dan URL script service worker memakai release ID `20260808-8`. Instalasi worker melakukan precache setiap aset secara independen agar satu aset opsional yang hilang tidak menahan aktivasi versi perbaikan; dokumen fallback offline tetap wajib tersedia. Versi runtime harus dinaikkan setiap kali perilaku worker berubah, sedangkan versi cache ikut dinaikkan ketika struktur snapshot berubah. Landing page memakai `viewport-fit=cover` dan aturan safe-area Safari agar kontrol PWA tetap berada di kiri bawah pada iOS. Setelah deployment, tutup dan buka kembali PWA agar browser memeriksa metadata terbaru. Bila launcher OS masih menampilkan ikon lama, sinkronkan seluruh antrean terlebih dahulu, uninstall instalasi lama, lalu install PsyAid kembali dari browser.
