# Dokumentasi Akun Default & Seed Data (SiPenting)

Dokumen ini berisi informasi mengenai akun-akun default hasil dari execution database seeder (`php artisan db:seed` atau `php artisan migrate:fresh --seed`) untuk mempermudah login pada lingkungan development/lokal.

---

## 1. Akun Administrator Web Portal

### 🏛️ Bapeda (Badan Perencanaan Pembangunan Daerah)
Akun ini digunakan untuk mengelola keseluruhan puskesmas dan data di tingkat kabupaten.
* **Email:** `bapeda@gmail.com`
* **Password:** `bapeda_admin`
* **Tabel Database:** `akun_bapeda`

### 🏥 Puskesmas (25 Akun Kecamatan)
Puskesmas digunakan untuk monitoring data pada wilayah kecamatan masing-masing. Pola kredensialnya adalah:
* **Username/Nama:** `Puskesmas[1-25]` (Contoh: `Puskesmas1`, `Puskesmas2`, ..., `Puskesmas25`)
* **Password:** `puskesmas_admin[1-25]` (Contoh: `puskesmas_admin1`, `puskesmas_admin2`, ..., `puskesmas_admin25`)
* **Tabel Database:** `akun_puskesmas`

---

## 2. Akun Mobile / API Client (Tabel `users`)

### 👩‍⚕️ Bidan Developer (Role 2)
* **NIK / Username:** `3509200904020021`
* **Password:** `3509200904020021`

### 🤰 Ibu Hamil Developer (Role 1)
Akun percobaan untuk hak akses warga/ibu hamil:
* **NIK / Username 1:** `3511111111111111`
  * **Password:** `3511111111111111`
* **NIK / Username 2:** `3511111111111112`
  * **Password:** `3511111111111112`

### 👥 Guest Mode (Role 3)
Akun tamu untuk mengakses fitur umum tanpa registrasi penuh:
* **NIK / Username:** `1919191919191919`
* **Password:** `1919191919191919`

---

## 3. Akun Ibu Hamil Hasil Faker (Masal)
Seeder juga men-generate puluhan akun ibu hamil secara acak untuk simulasi data di berbagai desa:
* **NIK / Password:** `3511...` (16 digit angka acak)
* **Username:** Hasil slug dari nama ibu (lowercase, tanpa spasi, misal `siti-nur-rahayu`)
* **Password Default (Jika Login Manual):** `password`

---

## 🚀 Cara Menjalankan Seeder Database
Jika Anda baru melakukan setup database atau ingin me-reset data ke kondisi awal default di atas:
```bash
php artisan migrate:fresh --seed
```
