# 🌋 SI-Berapi (Sistem Informasi Bencana Gunung Berapi)

Aplikasi web terpadu nasional untuk pemantauan tingkat aktivitas vulkanik, sebaran geografis gunung api aktif di Indonesia berbasis Leaflet.js, sistem crowdsourcing pelaporan orang hilang akibat erupsi, modul edukasi mitigasi kebencanaan, arsip riwayat erupsi, dan dashboard moderasi administrator.

---

## 🚀 Fitur Unggulan

1. **Beranda Interaktif**:
   - Headline responsif dengan tema visual vulkanik (*Merah Vulkanik*, *Oranye Magma*, *Abu Gelap*, dan *Putih*).
   - Widget counter ringkas jumlah gunung pada tiap tingkatan bahaya: **Level IV (AWAS)**, **Level III (SIAGA)**, **Level II (WASPADA)**, dan **Level I (NORMAL)**.
   - Peta sebaran gunung interaktif mini & preview laporan orang hilang terkini.
   - Card edukasi cepat 3 fase (Pra-Bencana, Saat Bencana, Pasca-Bencana).

2. **Peta Sebaran Gunung Rawan Bencana**:
   - Integrasi **Leaflet.js** dengan custom pin marker warna dinamis sesuai status bahaya.
   - Fitur pencarian & filter berdasarkan nama gunung, provinsi, atau status bahaya.
   - Halaman detail gunung lengkap dengan ketinggian, lokasi, radius aman/steril bahaya, koordinat, peta zona KRB III, riwayat letusan, dan rekomendasi jalur evakuasi.

3. **Papan Pengaduan & Laporan Orang Hilang (Crowdsourcing Publik)**:
   - Formulir input publik yang mudah diakses tanpa harus login (Nama Pelapor, No. WA/HP, Nama Korban, Umur, Gender, Foto, Ciri-ciri Fisik, Gunung Terkait, Lokasi & Tanggal Hilang).
   - Public Board dengan badge status: **"Masih Dicari" (Merah)** dan **"Sudah Ditemukan" (Hijau)**.
   - Tombol kontak langsung via WhatsApp ke nomor Pelapor / Tim SAR.
   - Flash alert SweetAlert saat laporan sukses dikirim.

4. **Modul Edukasi Bencana**:
   - Definisi & Tipe Gunung Berapi (Stratovulkan, Kaldera, Perisai, Erupsi Plinian, Strombolian, dsb).
   - Penjelasan mekanisme ilmiah mengapa gunung api bisa meletus.
   - Tab komparasi visual Dampak Negatif (Bahaya) vs Dampak Positif (Manfaat Ekologis & Geothermal).
   - Panduan Mitigasi Lengkap: Pra-Bencana (Tas Siaga TSB), Saat Bencana (Masker N95), dan Pasca-Bencana (Pembersihan Abu).
   - Galeri video edukasi resmi YouTube (BNPB / PVMBG).

5. **Arsip Riwayat Bencana (Disaster History Archive)**:
   - Timeline riwayat erupsi dahsyat di Indonesia (Merapi 2010, Semeru 2021, Kelud 2014, Marapi 2023, Lewotobi 2024, Anak Krakatau 2018).
   - Filter berdasarkan tahun dan nama gunung.

6. **Kontak & Posko Darurat**:
   - Daftar nomor darurat: BNPB (117), BASARNAS (115), PVMBG (022-7272606), SPGDT Ambulans (119), POLRI (110).

7. **Dashboard Administrator**:
   - Login petugas admin dengan otentikasi sesi aman.
   - CRUD Data Gunung Berapi & Pembaruan Status Bahaya.
   - Moderasi Laporan Orang Hilang (Ubah status 'Dicari'/'Ditemukan', setujui tayang/sembunyikan, atau hapus laporan palsu).
   - CRUD Riwayat Erupsi Bersejarah.
   - CRUD Materi Edukasi & Link Embed YouTube.

---

## 🛠️ Panduan Instalasi & Menjalankan (XAMPP Localhost)

### 1. Menjalankan Menggunakan MySQL (XAMPP)

1. Buka aplikasi **XAMPP Control Panel**, lalu klik **Start** pada modul **Apache** dan **MySQL**.
2. Buat database baru bernama `si_berapi` melalui **phpMyAdmin** (`http://localhost/phpmyadmin`) atau biarkan Laravel membuatnya otomatis.
3. Buka file `.env` di dalam folder proyek `si-berapi` dan pastikan konfigurasi database sebagai berikut:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=si_berapi
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Jalankan perintah migrasi dan seeder untuk mengisi data awal:
   ```bash
   php artisan migrate --seed
   ```
   *(Opsional: Anda juga dapat langsung mengimpor file dump SQL yang telah disediakan di `database/si_berapi.sql` melalui phpMyAdmin).*

### 2. Menjalankan Server Aplikasi
Jalankan dev server Laravel:
```bash
php artisan serve
```
Buka browser dan akses:
**`http://127.0.0.1:8000`**

---

## 🔑 Kredensial Login Administrator

- **URL Login**: `http://127.0.0.1:8000/login`
- **Email**: `admin@siberapi.id`
- **Password**: `admin123`

---

## 📂 Struktur File Utama Proyek

- `app/Models/`: `Volcano.php`, `MissingPerson.php`, `DisasterHistory.php`, `EducationContent.php`, `User.php`
- `app/Http/Controllers/`:
  - `HomeController.php` (Beranda & Statistik)
  - `VolcanoController.php` (Peta & Detail Gunung)
  - `MissingPersonController.php` (Papan & Input Crowdsourcing)
  - `EducationController.php` (Edukasi & Video)
  - `DisasterHistoryController.php` (Arsip Riwayat)
  - `ContactController.php` (Kontak Darurat)
  - `AuthController.php` (Login & Logout)
  - `AdminController.php` (Dashboard, CRUD & Moderasi)
- `database/migrations/`: 4 file migrasi untuk tabel `volcanoes`, `missing_persons`, `disaster_histories`, `education_contents`.
- `database/seeders/DatabaseSeeder.php`: Data seeder komprehensif gunung api Indonesia, erupsi historis, dan materi mitigasi.
- `database/si_berapi.sql`: Script dump schema MySQL siap impor untuk phpMyAdmin XAMPP.
- `resources/views/`:
  - `layouts/app.blade.php`: Layout publik responsif (Navbar, Footer, Leaflet, Alpine.js, Lucide).
  - `layouts/admin.blade.php`: Layout dashboard admin dengan sidebar responsif.
  - `home.blade.php`, `volcanoes/`, `missing_persons/`, `education/`, `disasters/`, `contact/`, `admin/`, `auth/`.
- `routes/web.php`: 37 rute publik dan terproteksi middleware `auth`.
