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


