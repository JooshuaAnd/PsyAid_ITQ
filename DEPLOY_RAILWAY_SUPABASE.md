# Panduan Deploy PsyAid ke Railway dengan Database Supabase (PostgreSQL)

Dokumen ini berisi panduan langkah demi langkah untuk melakukan deploy aplikasi CodeIgniter 4 **PsyAid** ke **Railway** menggunakan Docker dan menyambungkannya ke database **Supabase (PostgreSQL)**.

---

## Langkah 1: Persiapan Database Supabase

1. Buka [Supabase Dashboard](https://supabase.com/dashboard) dan login ke akun Anda.
2. Buat Project baru (atau pilih project yang sudah ada).
3. Buka menu **Project Settings** (ikon gerigi di kiri bawah) -> **Database**.
4. Gulir ke bawah ke bagian **Connection Parameters** / **Connection String**:
   - **Host / Hostname**: contoh `db.abcdefgh.supabase.co` (atau connection pooler `aws-0-xxxx.pooler.supabase.com`)
   - **Database Name**: `postgres`
   - **Port**: `5432` (Direct Connection) atau `6543` (Transaction Pooler)
   - **User**: `postgres` (atau `postgres.projectref`)
   - **Password**: Password yang Anda buat saat pembuatan project di Supabase.

---

## Langkah 2: Deploy Repository ke Railway

1. Pastikan seluruh perubahan file di project ini sudah di-commit dan di-push ke repository **GitHub** / **GitLab** Anda:
   ```bash
   git add .
   git commit -m "Add Docker setup and Supabase config for Railway deployment"
   git push origin main
   ```
2. Buka [Railway Dashboard](https://railway.app/dashboard).
3. Klik tombol **New Project** -> pilih **Deploy from GitHub repo**.
4. Pilih repository **PsyAid** Anda.
5. Railway akan mendeteksi file [Dockerfile](file:///d:/PsyAid/Dockerfile) secara otomatis dan mulai memproses build.

---

## Langkah 3: Konfigurasi Environment Variables di Railway

1. Di Dashboard Railway, klik pada service aplikasi **PsyAid** Anda.
2. Pilih tab **Variables**.
3. Tambahkan (New Variable) variabel lingkungan berikut:

| Key | Value Contoh | Keterangan |
| --- | --- | --- |
| `CI_ENVIRONMENT` | `production` | Mode aplikasi CodeIgniter 4 |
| `app.baseURL` | `https://psyaid-production.up.railway.app/` | Domain dari Railway (buka tab Settings -> Networking di Railway) |
| `database.default.DBDriver` | `Postgre` | **Wajib `Postgre`** untuk Supabase |
| `database.default.hostname` | `db.xxxx.supabase.co` | Host database Supabase Anda |
| `database.default.database` | `postgres` | Nama database Supabase |
| `database.default.username` | `postgres` | Username database Supabase |
| `database.default.password` | `PASSWORD_SUPABASE_ANDA` | Password database Supabase |
| `database.default.port` | `5432` | Port database (5432 / 6543) |
| `database.default.schema` | `public` | Schema PostgreSQL |
| `GEMINI_API_KEY` | `AIzaSy...` | API Key Gemini AI (jika digunakan) |
| `GEMINI_MODEL` | `gemini-1.5-flash` | Model Gemini AI |

4. Simpan variabel. Railway akan melakukan *re-deploy* otomatis dengan environment variabel baru.

---

## Langkah 4: Menjalankan Migrasi Database ke Supabase

Agar struktur tabel terbentuk di database Supabase:

### Cara A: Melalui Command Terminal Railway
1. Di Dashboard Railway service Anda, buka tab **CLI** / **Exec** / **Deployments** (klik terminal / shell).
2. Jalankan perintah migrasi CodeIgniter:
   ```bash
   php spark migrate
   ```

### Cara B: Mengisi Seed Data (Optional)
Jika Anda memiliki Seeder data awal:
```bash
php spark db:seed DatabaseSeeder
```

---

## Testing Lokal Menggunakan Docker (Opsional)

Jika Anda ingin mencoba menjalankan Docker di komputer lokal sebelum dipush:
```bash
docker-compose up --build
```
Aplikasi akan berjalan di `http://localhost:8080`.
