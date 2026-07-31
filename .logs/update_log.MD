# Log Perubahan System PsyAid ITQ

Format Entri: `[Timestamp], [Author], --> [Perubahan, Lokasi Perubahan]`

---

- `[2026-07-24 21:05:00]`, `[Rafael Evan]`, --> `[Penambahan Tab 5. Summary untuk review data penyintas & quick edit, app/Views/victim/detail.php]`
- `[2026-07-24 21:05:00]`, `[Rafael Evan]`, --> `[Penambahan Field Read-Only Lokasi Bencana berbasis wilayah posko, app/Views/victim/detail.php]`
- `[2026-07-24 21:05:00]`, `[Rafael Evan]`, --> `[Pembaruan alur redirect paska skrining relawan menuju tab summary, app/Controllers/ScreeningController.php]`
- `[2026-07-24 21:05:00]`, `[Rafael Evan]`, --> `[Pembaruan dokumentasi struktur project, Project.MD]`
- `[2026-07-24 21:10:00]`, `[Rafael Evan]`, --> `[Perbaikan ParseError (unclosed php endif & div penutup tab-screening), app/Views/victim/detail.php]`
- `[2026-07-24 21:10:00]`, `[Rafael Evan]`, --> `[Inisialisasi & pencatatan log perubahan sistem, .logs/update_log.MD]`
- `[2026-07-24 21:32:00]`, `[Rafael Evan]`, --> `[Penggantian logo navbar top header dengan public/images/Logo_PsyAid.png, app/Views/layouts/main.php]`
- `[2026-07-24 21:34:00]`, `[Rafael Evan]`, --> `[Penggantian icon login page dengan Logo_PsyAid.png yang disesuaikan ukurannya lebih besar, app/Views/auth/login.php]`
- `[2026-07-24 21:34:00]`, `[Rafael Evan]`, --> `[Mengubah warna top header dari bg-dark menjadi putih soft (bg-white border-bottom), app/Views/layouts/main.php]`
- `[2026-07-24 21:39:00]`, `[Rafael Evan]`, --> `[Menyembunyikan top header navbar pada halaman login, app/Views/layouts/main.php]`
- `[2026-07-24 21:40:00]`, `[Rafael Evan]`, --> `[Pengiriman variabel hideNavbar => true dari AuthController & penguatan kondisi isLoginPage pada main.php untuk memastikan navbar 100% tersembunyi pada halaman login, app/Controllers/AuthController.php, app/Views/layouts/main.php]`
- `[2026-07-24 21:42:00]`, `[Rafael Evan]`, --> `[Pengubahan warna top header navbar menjadi perpaduan hijau muda soft dan putih (.navbar-soft-green), app/Views/layouts/main.php]`
- `[2026-07-24 21:43:00]`, `[Rafael Evan]`, --> `[Mengubah warna top header navbar menjadi hijau muda (soft light green #d1fae5), app/Views/layouts/main.php]`
- `[2026-07-24 21:48:00]`, `[Rafael Evan]`, --> `[Penambahan popup modal konfirmasi logout Bootstrap 5 dengan tombol konfirmasi berwarna merah bertuliskan putih, app/Views/layouts/main.php]`
- `[2026-07-25 18:08:00]`, `[Rafael Evan]`, --> `[Pengembalian default baseURL ke localhost:8080/ & penambahan trust proxyIPs untuk Railway SSL, app/Config/App.php]`
- `[2026-07-25 18:21:00]`, `[Rafael Evan]`, --> `[Perbaikan kompatibilitas PostgreSQL Strict GROUP BY pada getFilteredPoskoList, app/Controllers/CommandCenterController.php]`
- `[2026-07-25 18:48:00]`, `[Rafael Evan]`, --> `[Penambahan route GET dan POST /register untuk pendaftaran akun, app/Config/Routes.php]`
- `[2026-07-25 18:48:00]`, `[Rafael Evan]`, --> `[Penambahan flash alert notifikasi dan link menuju halaman registrasi pada halaman login, app/Views/auth/login.php]`
- `[2026-07-25 18:48:00]`, `[Rafael Evan]`, --> `[Pembaruan logika penyembunyian navbar untuk mendukung halaman registrasi, app/Views/layouts/main.php]`
- `[2026-07-25 19:00:00]`, `[Rafael Evan]`, --> `[Pembaruan AuthController register & attemptRegister dengan default role bpbd_admin, app/Controllers/AuthController.php]`
- `[2026-07-25 19:20:00]`, `[Rafael Evan]`, --> `[Perbaikan bug toggle icon password & konfirmasi password tanpa outline tambahan antara input dan icon toggle, app/Views/auth/register.php]`
- `[2026-07-25 19:35:00]`, `[Rafael Evan]`, --> `[Penyesuaian placeholder password agar fit dan tidak terpotong, app/Views/auth/register.php]`
- `[2026-07-25 19:50:00]`, `[Rafael Evan]`, --> `[Pembaruan halaman login terintegrasi dengan tema register page dan efek node/heartbeat canvas background, app/Views/auth/login.php, app/Views/auth/register.php]`
- `[2026-07-25 20:12:00]`, `[Rafael Evan]`, --> `[Refactoring arsitektur controllers ke dalam sub-folder berbasis peran (app/Controllers/auth/, bpbd/, relawan/, psikolog/), pembaruan namespace App\Controllers\<Role>, impor BaseController, dan pembaruan handler pada app/Config/Routes.php, app/Controllers/, app/Config/Routes.php]`
- `[2026-07-25 20:22:00]`, `[Rafael Evan]`, --> `[Pembaruan tata letak dengan Collapsible Sidebar berbasis peran (bpbd_admin, relawan, psikolog), pemindahan Logo PsyAid ke sidebar, tombol sticky toggle sidebar di luar top header, tombol Logout di bagian bawah sidebar, dan top header non-sticky, app/Views/layouts/main.php]`
- `[2026-07-25 20:26:00]`, `[Rafael Evan]`, --> `[Penambahan dukungan mobile responsive dengan tombol toggle hamburger (garis tiga) pada top header dan dropdown menu sidebar berbasis peran pada layar kecil, app/Views/layouts/main.php]`
- `[2026-07-25 20:28:00]`, `[Rafael Evan]`, --> `[Pembaruan tombol toggle mobile nav (garis tiga) menjadi sticky/fixed di pojok kiri atas viewport seluler sementara top header tetap non-sticky, app/Views/layouts/main.php]`
- `[2026-07-25 20:32:00]`, `[Rafael Evan]`, --> `[Pembaruan perataan tombol Logout di sidebar desktop menjadi rata tengah (center aligned) secara khusus, sementara menu navigasi lainnya tetap rata kiri, app/Views/layouts/main.php]`
- `[2026-07-25 20:51:00]`, `[Rafael Evan]`, --> `[Pembaruan top header dengan komponen Dynamic Liquid Glass Breadcrumb menggantikan judul statis dan penambahan gambar avatar profil pengguna menggunakan public/images/profile.svg di samping nama user, app/Views/layouts/main.php]`
- `[2026-07-25 20:55:00]`, `[Rafael Evan]`, --> `[Pembaruan warna teks merek PsyAid disesuaikan dengan tema emerald sistem (#047857), font size diperkecil, serta penghapusan teks keterangan subtitle di bawahnya, app/Views/layouts/main.php]`
- `[2026-07-25 21:09:00]`, `[Rafael Evan]`, --> `[Penambahan EarthquakeRadarController & endpoint API proxy /api/earthquake-data untuk konsumsi real-time BMKG TEWS JSON, app/Controllers/bpbd/EarthquakeRadarController.php]`
- `[2026-07-25 21:09:00]`, `[Rafael Evan]`, --> `[Pembuatan view Peta Radar Gempa real-time dengan animasi Leaflet radar pulse waves, indikator live feed 30s, dan rincian dampak gempa, app/Views/bpbd/EarthquakeRadar.php]`
- `[2026-07-25 21:09:00]`, `[Rafael Evan]`, --> `[Penambahan route GET /bpbd/earthquake-radar dan GET /api/earthquake-data, app/Config/Routes.php]`
- `[2026-07-25 21:09:00]`, `[Rafael Evan]`, --> `[Penambahan item menu Peta Radar Gempa pada sidebar navigasi BPBD Admin, app/Views/layouts/main.php]`
- `[2026-07-25 21:17:00]`, `[Rafael Evan]`, --> `[Pembaruan border-radius seluruh card, modal, badge, dan container peta pada view Peta Radar Gempa menjadi tepat 6px (rounded-6), app/Views/bpbd/EarthquakeRadar.php]`
- `[2026-07-25 21:21:00]`, `[Rafael Evan]`, --> `[Pembaruan format teks Gempa Terakhir pada kartu statistik dengan pembersihan prefiks redundan BMKG dan line-clamp multi-line agar pas & informatif di dalam kartu, app/Views/bpbd/EarthquakeRadar.php]`
- `[2026-07-25 21:23:00]`, `[Rafael Evan]`, --> `[Penyetaraan struktur HTML, ukuran font (h4 fw-bold), dan penataan posisi teks Gempa Terakhir pada kartu statistik agar 100% presisi dan sejajar dengan kartu KPI lainnya, app/Views/bpbd/EarthquakeRadar.php]`
- `[2026-07-25 21:25:00]`, `[Rafael Evan]`, --> `[Penambahan dukungan mobile responsive pada Peta Radar Gempa (penyesuaian tinggi peta 420px pada seluler, scaling ikon & font kartu KPI, serta flex layout header), app/Views/bpbd/EarthquakeRadar.php]`
- `[2026-07-25 21:30:00]`, `[Rafael Evan]`, --> `[Penambahan sistem notifikasi darurat gempa real-time (>= 5.0 SR) di latar belakang (background polling 30s) dengan efek suara peringatan Web Audio API dan modal darurat khusus peran BPBD Admin di seluruh halaman aplikasi, app/Views/layouts/main.php]`
- `[2026-07-25 21:34:00]`, `[Rafael Evan]`, --> `[Perbaikan dan perapihan seluruh log catatan perubahan sistem agar tercatat lengkap secara kronologis tanpa ada yang terhapus, .logs/update_log.MD]`
- `[2026-07-31 18:11:19]`, `[Rafael Evan]`, --> `[Pengubahan UI halaman ItqResult.php agar sesuai dengan tema frosted glass & color palette standar PsyAid (seperti ItqForm.php & VictimDetail.php), app/Views/psikolog/ItqResult.php]`
- `[2026-07-31 18:49:33]`, `[Rafael Evan]`, --> `[Pembaruan UI Dashboard Psikolog dari format tabel menjadi grid card (maksimal 6 data per halaman) dengan styling paginasi identik Manajemen Data Penyintas Relawan, app/Views/psikolog/Dashboard.php]`
- `[2026-07-31 18:49:33]`, `[Rafael Evan]`, --> `[Pembaruan pengurutan data penyintas ter-assign pada Dashboard Psikolog menjadi berdasarkan nama penyintas (Alphabetical A-Z), app/Controllers/psikolog/PsikologController.php]`
-   [ x ]   I m p l e m e n t   I T Q   F i n a l   D i a g n o s i s   ( C P T S D / P T S D )   b a s e d   o n   I C D - 1 1   c r i t e r i a   i n   I t q S c o r i n g S e r v i c e  
 -   [ x ]   A d d   a s s i g n m e n t s ,   I T Q   r e s u l t s ,   a n d   c l i n i c a l   a c t i o n s   t o   D u m m y V i c t i m S e e d e r   f o r   t e s t i n g   f l o w  
 