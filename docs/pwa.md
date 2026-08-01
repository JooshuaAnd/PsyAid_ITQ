# Progressive Web App PsyAid

PsyAid dapat dipasang sebagai Progressive Web App (PWA) pada browser yang mendukung. Implementasinya bersifat *privacy-first*: aplikasi tetap installable dan mempunyai pengalaman offline, tetapi data penyintas dan halaman klinis tidak disimpan ke Cache Storage perangkat.

## Kemampuan

- manifest dengan nama, warna, shortcut, dan ikon aplikasi;
- ikon 192×192, 512×512, Apple Touch, dan ikon maskable;
- mode tampilan `standalone` setelah dipasang;
- tombol instalasi berbentuk ikon download saat browser mengirim event `beforeinstallprompt`;
- panduan `Tambahkan ke Layar Utama` saat tombol instalasi dibuka melalui iPhone/iPad;
- badge koneksi `Online`/`Offline` pada seluruh halaman utama;
- halaman fallback offline yang mandiri;
- service worker dengan pembaruan cache berversi;
- shortcut menuju laporan bencana, rekrutmen relawan, dan login.

PWA harus disajikan melalui HTTPS di produksi. `localhost` dan `127.0.0.1` dapat digunakan untuk pengembangan lokal.

## Kebijakan cache

| Jenis request | Strategi | Alasan |
|---|---|---|
| Shell PWA, ikon, logo, dan helper publik | Cache-first, cache berversi | Aset tidak memuat data pengguna dan diperlukan untuk pengalaman offline. |
| Navigasi HTML | Network-only, fallback ke `offline.html` | Mencegah halaman dengan session atau data klinis tertinggal pada perangkat. |
| API, health check, halaman internal, login, dan register | Network-only dengan `cache: no-store` | Respons dapat sensitif atau harus selalu terbaru. |
| POST/PUT/PATCH/DELETE | Tidak diintersep | Mutasi tidak boleh dimasukkan ke cache atau diantrikan tanpa rancangan konflik yang eksplisit. |
| Resource lintas origin | Tidak diintersep | CDN dan integrasi eksternal tetap mengikuti kebijakan browser/upstream. |

Konsekuensinya, mode offline tidak mengizinkan membaca atau mengubah data klinis. Pengguna mendapat penjelasan yang aman dan dapat mencoba kembali setelah koneksi pulih. Offline mutation queue/background sync sengaja tidak diaktifkan karena memerlukan enkripsi lokal, resolusi konflik, audit trail, dan kebijakan retensi data kesehatan yang belum tersedia.

## Struktur file

| File | Tanggung jawab |
|---|---|
| `public/manifest.webmanifest` | Identitas dan metadata instalasi PWA. |
| `public/service-worker.js` | Precache shell, penghapusan cache lama, dan routing request. |
| `public/offline.html` | Fallback navigasi ketika jaringan gagal. |
| `public/pwa.js` | Registrasi service worker, prompt/panduan instalasi, dan label status koneksi. |
| `public/pwa.css` | Tampilan tombol ikon instalasi, badge status, dan panduan instalasi iOS. |
| `public/icons/` | Ikon regular, Apple Touch, dan maskable. |
| `app/Views/components/pwa_head.php` | Metadata PWA yang digunakan seluruh dokumen HTML utama. |
| `tests/unit/PwaAssetsTest.php` | Validasi manifest, ikon, cache policy, dan integrasi template. |

## Siklus pembaruan

Nama cache berada pada konstanta `STATIC_CACHE` di `public/service-worker.js` dan saat ini menggunakan `psyaid-static-v4`. Saat daftar atau isi aset precache berubah, naikkan versinya, misalnya menjadi `psyaid-static-v5`. Service worker baru akan memasang cache baru dan menghapus cache PsyAid lama saat aktivasi.

Jangan menambahkan route penyintas, response API, HTML dashboard, atau upload klinis ke `PRECACHE_URLS` maupun `SAFE_STATIC_PATHS`.

## Verifikasi lokal

Jalankan aplikasi:

```bash
php spark serve --host 127.0.0.1 --port 8080
```

Kemudian buka `http://127.0.0.1:8080` dan periksa:

1. `manifest.webmanifest` berhasil dimuat dan memiliki ikon 192 serta 512 piksel.
2. `service-worker.js` aktif dengan scope `/`.
3. Tombol ikon download muncul bila browser memenuhi kriteria dan aplikasi belum terpasang; pada iOS tombol menampilkan panduan pemasangan manual.
4. Badge berubah dari `Online` menjadi `Offline` ketika koneksi dinonaktifkan.
5. Navigasi saat offline membuka `offline.html`, bukan salinan halaman klinis.
6. Cache Storage hanya berisi cache bernama `psyaid-static-*` dengan aset publik yang diizinkan.

Jalankan test otomatis dengan:

```bash
composer test
```

## Referensi standar

- [MDN: Making PWAs installable](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Making_PWAs_installable)
- [MDN: Offline and background operation](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Offline_and_background_operation)
- [MDN: PWA caching](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Caching)
