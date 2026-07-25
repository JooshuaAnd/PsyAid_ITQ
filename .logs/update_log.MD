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
- `[2026-07-25 20:12:00]`, `[Rafael Evan]`, --> `[Refactoring arsitektur controllers ke dalam sub-folder berbasis peran (app/Controllers/auth/, bpbd/, relawan/, psikolog/), pembaruan namespace App\Controllers\<Role>, impor BaseController, dan pembaruan handler pada app/Config/Routes.php, app/Controllers/, app/Config/Routes.php]`





