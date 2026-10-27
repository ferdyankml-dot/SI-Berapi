<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Volcano;
use App\Models\MissingPerson;
use App\Models\DisasterHistory;
use App\Models\EducationContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@siberapi.id'],
            [
                'name' => 'Pusat Pengendali SI-Berapi',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Volcanoes Dataset
        $volcanoesData = [
            [
                'name' => 'Gunung Merapi',
                'location' => 'Sleman, Magelang, Boyolali, Klaten',
                'province' => 'DI Yogyakarta & Jawa Tengah',
                'height' => 2968,
                'status_level' => 'Siaga',
                'latitude' => -7.5407,
                'longitude' => 110.4460,
                'description' => 'Salah satu gunung api teraktif di dunia dengan tipe letusan khas kubah lava dan awan panas guguran (wedhus gembel). Aktivitas saat ini terpantau berupa suplai magma berkelanjutan.',
                'safety_radius' => '5 km',
                'image' => 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Lewotobi Laki-laki',
                'location' => 'Flores Timur',
                'province' => 'Nusa Tenggara Timur',
                'height' => 1584,
                'status_level' => 'Awas',
                'latitude' => -8.5390,
                'longitude' => 122.7750,
                'description' => 'Gunung api kembar di Pulau Flores bagian timur yang mengalami peningkatan erupsi eksplosif tinggi disertai lontaran lava pijar dan hujan material vulkanik membahayakan pemukiman.',
                'safety_radius' => '7 km',
                'image' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Ibu',
                'location' => 'Halmahera Barat',
                'province' => 'Maluku Utara',
                'height' => 1325,
                'status_level' => 'Awas',
                'latitude' => 1.4880,
                'longitude' => 127.6330,
                'description' => 'Gunung bertipe stratovolcano aktif dengan letusan kolom abu vulkanik mencapai 4.000 meter di atas puncak. Masyarakat dan wisatawan dilarang beraktivitas dalam radius sektoral.',
                'safety_radius' => '5 km',
                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Semeru',
                'location' => 'Lumajang & Malang',
                'province' => 'Jawa Timur',
                'height' => 3676,
                'status_level' => 'Siaga',
                'latitude' => -8.1080,
                'longitude' => 112.9220,
                'description' => 'Puncak tertinggi di Pulau Jawa (Mahameru) dengan kubah lava aktif Jonggring Saloko yang rutin menghembuskan asap dan awan panas guguran ke arah tenggara (Besuk Kobokan).',
                'safety_radius' => '5 km',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Marapi',
                'location' => 'Agam & Tanah Datar',
                'province' => 'Sumatera Barat',
                'height' => 2891,
                'status_level' => 'Siaga',
                'latitude' => -0.3810,
                'longitude' => 100.4730,
                'description' => 'Gunung api kompleks di Dataran Tinggi Minangkabau. Terkenal dengan erupsi freatik mendadak tanpa sinyal kegempaan yang jelas sebelumnya.',
                'safety_radius' => '4.5 km',
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Anak Krakatau',
                'location' => 'Selat Sunda, Lampung Selatan',
                'province' => 'Lampung',
                'height' => 157,
                'status_level' => 'Waspada',
                'latitude' => -6.1020,
                'longitude' => 105.4230,
                'description' => 'Gunung pulau vulkanik yang tumbuh di kaldera legendaris Krakatau pasca letusan dahsyat 1883. Sering memuntahkan abu pekat dan semburan lava strombolian ke laut lepas.',
                'safety_radius' => '5 km',
                'image' => 'https://images.unsplash.com/photo-1546587348-d12660c30c50?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Ruang',
                'location' => 'Kepulauan Sitaro',
                'province' => 'Sulawesi Utara',
                'height' => 725,
                'status_level' => 'Waspada',
                'latitude' => 2.3010,
                'longitude' => 125.3670,
                'description' => 'Gunung api pulau di Laut Sulawesi yang berpotensi memicu runtuhan material vulkanik ke laut dan menimbulkan bahaya tsunami lokal.',
                'safety_radius' => '4 km',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Sinabung',
                'location' => 'Karo',
                'province' => 'Sumatera Utara',
                'height' => 2460,
                'status_level' => 'Waspada',
                'latitude' => 3.1700,
                'longitude' => 98.3920,
                'description' => 'Gunung api yang bangkit kembali setelah tidur selama lebih dari 400 tahun sejak 2010 dengan riwayat guguran awan panas intensif yang merelokasi puluhan desa.',
                'safety_radius' => '3 km',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Bromo',
                'location' => 'Probolinggo, Pasuruan, Malang',
                'province' => 'Jawa Timur',
                'height' => 2329,
                'status_level' => 'Waspada',
                'latitude' => -7.9420,
                'longitude' => 112.9530,
                'description' => 'Gunung api ikonik di dalam Kaldera Tengger dengan lautan pasir luas. Mengeluarkan hembusan asap belerang kawah secara konstan dengan riwayat semburan abu.',
                'safety_radius' => '1 km',
                'image' => 'https://images.unsplash.com/photo-1508873696983-2df5293cb32f?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Slamet',
                'location' => 'Banyumas, Purbalingga, Pemalang',
                'province' => 'Jawa Tengah',
                'height' => 3428,
                'status_level' => 'Waspada',
                'latitude' => -7.2420,
                'longitude' => 109.2080,
                'description' => 'Puncak gunung api tertinggi kedua di Pulau Jawa. Aktivitas terkini menunjukkan peningkatan gempa hembusan dan gempa tremor vulkanik dangkal.',
                'safety_radius' => '2 km',
                'image' => 'https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Kelud',
                'location' => 'Kediri, Blitar, Malang',
                'province' => 'Jawa Timur',
                'height' => 1731,
                'status_level' => 'Normal',
                'latitude' => -7.9300,
                'longitude' => 112.3080,
                'description' => 'Dikenal dengan erupsi eksplosif dahsyat siklik setiap dekade. Pasca letusan besar Februari 2014, kubah kawah saat ini stabil dan berada di status normal.',
                'safety_radius' => '1.5 km',
                'image' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Agung',
                'location' => 'Karangasem',
                'province' => 'Bali',
                'height' => 3031,
                'status_level' => 'Normal',
                'latitude' => -8.3430,
                'longitude' => 115.5080,
                'description' => 'Gunung tertinggi dan disucikan di Pulau Dewata. Setelah fase krisis erupsi 2017-2019, kondisinya kini telah kembali tenang dan terpantau normal.',
                'safety_radius' => '2 km',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Rinjani',
                'location' => 'Lombok Utara & Timur',
                'province' => 'Nusa Tenggara Barat',
                'height' => 3726,
                'status_level' => 'Normal',
                'latitude' => -8.4110,
                'longitude' => 116.4570,
                'description' => 'Gunung api megah dengan danau kawah Segara Anak dan kerucut baru Gunung Barujari di dalamnya. Jalur pendakian dibuka dengan SOP kewaspadaan ketat.',
                'safety_radius' => '1.5 km',
                'image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'name' => 'Gunung Kerinci',
                'location' => 'Kerinci & Solok Selatan',
                'province' => 'Jambi & Sumatera Barat',
                'height' => 3805,
                'status_level' => 'Waspada',
                'latitude' => -1.6970,
                'longitude' => 101.2640,
                'description' => 'Gunung berapi tertinggi di Indonesia dan puncak tertinggi di Sumatera. Terletak di tengah kawasan Taman Nasional Kerinci Seblat.',
                'safety_radius' => '3 km',
                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($volcanoesData as $data) {
            Volcano::updateOrCreate(['name' => $data['name']], $data);
        }

        $merapi = Volcano::where('name', 'Gunung Merapi')->first();
        $semeru = Volcano::where('name', 'Gunung Semeru')->first();
        $marapi = Volcano::where('name', 'Gunung Marapi')->first();
        $lewotobi = Volcano::where('name', 'Gunung Lewotobi Laki-laki')->first();
        $kelud = Volcano::where('name', 'Gunung Kelud')->first();
        $krakatau = Volcano::where('name', 'Gunung Anak Krakatau')->first();

        // 3. Disaster Histories Dataset
        $historiesData = [
            [
                'volcano_id' => $lewotobi?->id ?? 1,
                'event_date' => '2024-11-03',
                'description' => 'Erupsi eksplosif Gunung Lewotobi Laki-laki disertai gemuruh dahsyat dan lontaran batuan panas radius 7 km yang menimpa pemukiman di Desa Klatanlo dan Hokeng Jaya.',
                'impact_summary' => '9 korban jiwa meninggal dunia, 63 luka-luka, puluhan bangunan rusak terbakar, dan lebih dari 10.000 jiwa dievakuasi ke posko darurat.',
                'casualties_count' => 9,
                'image' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'volcano_id' => $marapi?->id ?? 1,
                'event_date' => '2023-12-03',
                'description' => 'Letusan freatik tiba-tiba kolom abu setinggi 3.000 meter terjadi saat sekitar 75 pendaki berada di sekitar kawah puncak tanpa ada peringatan dini seismik sebelumnya.',
                'impact_summary' => '24 pendaki meninggal dunia di jalur pendakian, belasan luka bakar berat, proses evakuasi tim SAR gabungan berlangsung 5 hari dalam cuaca ekstrem.',
                'casualties_count' => 24,
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'volcano_id' => $semeru?->id ?? 1,
                'event_date' => '2021-12-04',
                'description' => 'Guguran awan panas (APG) dahsyat menerjang aliran Besuk Kobokan hingga sejauh 11 km menimbun Jembatan Gladak Perak dan pemukiman Curah Kobokan.',
                'impact_summary' => '51 orang meninggal dunia, ribuan rumah rata dengan material abu dan pasir, lebih dari 10.400 warga mengungsi, jalur transportasi Lumajang-Malang putus total.',
                'casualties_count' => 51,
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'volcano_id' => $krakatau?->id ?? 1,
                'event_date' => '2018-12-22',
                'description' => 'Longsoran lereng barat daya Gunung Anak Krakatau seluas 64 hektare ke laut memicu gelombang tsunami tanpa peringatan gempa tektonik menghantam pesisir Banten dan Lampung.',
                'impact_summary' => '437 orang meninggal dunia, 14.059 luka-luka, ratusan hotel dan pemukiman pantai di Pandeglang & Kalianda hancur.',
                'casualties_count' => 437,
                'image' => 'https://images.unsplash.com/photo-1546587348-d12660c30c50?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'volcano_id' => $kelud?->id ?? 1,
                'event_date' => '2014-02-13',
                'description' => 'Erupsi plinian eksplosif Gunung Kelud memuntahkan material piroklastik hingga ketinggian 26 km ke atmosfer dengan dentuman terdengar hingga Yogyakarta dan Surabaya.',
                'impact_summary' => 'Hujan abu tebal melumpuhkan 7 bandara internasional di Jawa, jutaan hektar lahan pertanian tertutup abu tebal, 7 orang meninggal dunia.',
                'casualties_count' => 7,
                'image' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1000&q=80',
            ],
            [
                'volcano_id' => $merapi?->id ?? 1,
                'event_date' => '2010-10-26',
                'description' => 'Erupsi Merapi abad ke-21 terbesar dengan luncuran awan panas melampaui radius 15 km menyusuri Sungai Gendol hingga meluluhlantakkan Dusun Kinahrejo dan sekitarnya.',
                'impact_summary' => '353 korban jiwa termasuk Mbah Maridjan, lebih dari 350.000 warga dievakuasi serentak, kerugian ekonomi ditaksir lebih dari Rp 7,3 triliun.',
                'casualties_count' => 353,
                'image' => 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=1000&q=80',
            ],
        ];

        foreach ($historiesData as $hist) {
            DisasterHistory::create($hist);
        }

        // 4. Missing Persons Dataset (Crowdsourcing Reports)
        $missingData = [
            [
                'reporter_name' => 'Bambang Santoso',
                'reporter_phone' => '081234567890',
                'victim_name' => 'Rian Hidayat',
                'age' => 24,
                'gender' => 'Laki-laki',
                'photo' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=600&q=80',
                'characteristics' => 'Tinggi 172 cm, kulit sawo matang, rambut ikal pendek. Terakhir mengenakan jaket outdoor merah merk Consina, celana kargo hitam, dan ransel abu-abu 45L.',
                'volcano_id' => $marapi?->id,
                'last_seen_location' => 'Jalur Cadas menuju puncak Kawah Marapi',
                'last_seen_date' => '2023-12-03',
                'status' => 'Dicari',
                'notes' => 'Terpisah dari rombongan saat terdengar suara dentuman pertama erupsi. Mohon infonya segera jika melihat!',
                'is_approved' => true,
            ],
            [
                'reporter_name' => 'Siti Nurhaliza',
                'reporter_phone' => '085712345678',
                'victim_name' => 'Dimas Arya Pratama',
                'age' => 21,
                'gender' => 'Laki-laki',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'characteristics' => 'Tinggi 168 cm, berkacamata frame hitam, kulit kuning langsat. Memakai kupluk wol biru dongker dan sepatu trekking Salomon cokelat.',
                'volcano_id' => $semeru?->id,
                'last_seen_location' => 'Area Ranu Kumbolo menuju Kalimati',
                'last_seen_date' => '2024-08-15',
                'status' => 'Dicari',
                'notes' => 'Tidak tiba di shelter pos berikutnya sesuai jadwal lapor regu.',
                'is_approved' => true,
            ],
            [
                'reporter_name' => 'Agus Hendrawan',
                'reporter_phone' => '082198765432',
                'victim_name' => 'Laras Ayu Wulandari',
                'age' => 22,
                'gender' => 'Perempuan',
                'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=600&q=80',
                'characteristics' => 'Tinggi 160 cm, rambut sebahu bergelombang, berlesung pipit. Mengenakan windbreaker kuning terang dan buff corak batik.',
                'volcano_id' => $merapi?->id,
                'last_seen_location' => 'Kawasan Selo sisi utara Merapi',
                'last_seen_date' => '2024-05-10',
                'status' => 'Ditemukan',
                'notes' => 'Alhamdulillah telah berhasil dievakuasi oleh Tim SAR Gabungan dalam keadaan selamat dan mendapatkan perawatan medis di RSUD Boyolali.',
                'is_approved' => true,
            ],
            [
                'reporter_name' => 'Petrus Da Silva',
                'reporter_phone' => '081399887766',
                'victim_name' => 'Yohanes Kopong',
                'age' => 58,
                'gender' => 'Laki-laki',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'characteristics' => 'Pria paruh baya, tinggi 165 cm, memakai baju kemeja flanel kotak-kotak biru dan celana training panjang abu-abu. Membawa parang sarung kayu.',
                'volcano_id' => $lewotobi?->id,
                'last_seen_location' => 'Perkebunan lereng Desa Dulipali',
                'last_seen_date' => '2024-11-04',
                'status' => 'Dicari',
                'notes' => 'Warga lokal yang berniat menyelamatkan hewan ternak saat hujan pasir terjadi dan belum kembali ke posko evakuasi pengungsian.',
                'is_approved' => true,
            ],
        ];

        foreach ($missingData as $item) {
            MissingPerson::create($item);
        }

        // 5. Education Contents Dataset
        $educationData = [
            [
                'title' => 'Pengertian Gunung Berapi & Tipe Letusan',
                'category' => 'definisi',
                'content' => 'Gunung berapi adalah rekahan pada kerak bumi tempat magma, gas, dan material piroklastik keluar ke permukaan bumi. Di Indonesia yang terletak pada pertemuan lempeng tektonik (Ring of Fire), mayoritas gunung api bertipe Stratovulkan (kerucut berlapis). Tipe erupsi bervariasi:
- **Erupsi Efusif**: Magma encer mengalir perlahan sebagai lava tanpa ledakan dahsyat (contoh: Kilauea di Hawaii).
- **Erupsi Eksplosif**: Magma kental kaya gas menghasilkan ledakan material piroklastik vertikal tinggi ke atmosfer (contoh: Kelud, Krakatau).
- **Tipe Strombolian**: Letusan ritmis dengan semburan lava pijar (contoh: Anak Krakatau).
- **Tipe Merapi**: Pembentukan kubah lava di puncak yang disusul runtuhnya kubah membentuk awan panas guguran.',
                'video_url' => 'https://www.youtube.com/watch?v=VNGUdObDoLk',
                'thumbnail' => 'https://images.unsplash.com/photo-1544885935-98dd03b09034?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Mengapa Gunung Berapi Bisa Meletus? Mekanisme Tektonik & Gas Magma',
                'category' => 'penyebab',
                'content' => 'Erupsi gunung berapi terjadi akibat akumulasi tekanan internal yang melampaui kekuatan batuan penutup bumi. Faktor utama pemicunya adalah:
1. **Pergerakan Lempeng Benua & Samudra**: Lempeng Indo-Australia yang menunjam ke bawah Lempeng Eurasia mengalami pelelehan batuan menjadi magma baru bersuhu lebih dari 1.000°C.
2. **Akumulasi Gas Terlarut**: Magma mengandung gas seperti uap air (H2O), karbon dioksida (CO2), dan sulfur dioksida (SO2). Saat magma naik, tekanan menurun sehingga gelembung gas berekspansi cepat layaknya mengocok minuman berkarbonasi.
3. **Penyumbatan Jalur Saluran Magma**: Kubah lava beku yang menutupi lubang kepundan kawah menahan gas hingga tekanan mencapai titik kritis sebelum akhirnya meledak menghancurkan penutupnya.',
                'video_url' => 'https://www.youtube.com/watch?v=IAmqNx_wO8k',
                'thumbnail' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Dampak Bencana Erupsi: Ancaman Bahaya vs Manfaat Ekologis',
                'category' => 'dampak',
                'content' => 'Aktivitas vulkanisme membawa dua sisi kontradiktif bagi peradaban manusia:

### Dampak Bahaya (Negatif):
- **Awan Panas Guguran (Pyroclastic Flow)**: Campuran gas dan batuan bersuhu 300°–800°C meluncur dengan kecepatan melebihi 200 km/jam.
- **Lahar Dingin / Hujan**: Aliran lumpur pekat bercampur batu besar saat hujan deras mengguyur endapan material di hulu sungai.
- **Hujan Abu & Pasir Vulkanik**: Mengakibatkan gangguan pernapasan (ISPA), korosi atap bangunan, dan menonaktifkan mesin pesawat terbang.
- **Gas Beracun (Mofet/Solfatara)**: Gas mematikan seperti CO dan H2S tanpa bau tajam di dasar cekungan kawah.

### Manfaat Berkelanjutan (Positif):
- **Tanah Vulkanik yang Sangat Subur**: Abu vulkanik kaya unsur hara fosfor, kalium, dan magnesium yang menopang lumbung pangan Indonesia.
- **Potensi Energi Panas Bumi (Geothermal)**: Sumber energi bersih terbarukan ramah lingkungan.
- **Material Tambang & Konstruksi**: Pasir vulkanik berkualitas tinggi dan batuan andesit bernilai ekonomi tinggi.
- **Pariwisata & Lanskap Alam Spektakuler**: Geowisata seperti Bromo, Rinjani, dan Kelimutu menggerakkan ekonomi lokal.',
                'video_url' => 'https://www.youtube.com/watch?v=WgktM2luLok',
                'thumbnail' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Panduan Mitigasi Lengkap: Pra, Saat, dan Pasca Bencana Erupsi',
                'category' => 'mitigasi',
                'content' => 'Kunci keselamatan menghadapi letusan gunung api adalah kedisiplinan mematuhi radius rekomendasi PVMBG:

### 1. Fase Pra-Bencana (Kesiapsiagaan):
- Kenali zona bahaya (KRB III, II, I) di sekitar tempat tinggal Anda.
- Siapkan **Tas Siaga Bencana (TSB)**: Dokumen penting, obat-obatan pribadi, senter, peluit, air minum 3 hari, makanan instan, dan masker N95.
- Pahami rute jalur evakuasi resmi dan lokasi Titik Kumpul Sementara (TKS) yang telah ditentukan aparat desa/BPBD.

### 2. Fase Saat Bencana (Tanggap Darurat):
- Segera tinggalkan radius bahaya yang ditetapkan PVMBG tanpa menunggu perintah berulang.
- Gunakan masker N95/kain basah serta kacamata goggle untuk melindungi pernapasan dan mata dari serpihan silika tajam abu vulkanik.
- Kenakan pakaian berlengan panjang, celana panjang, dan alas kaki tertutup.
- Hindari berteduh di bantaran sungai yang berhulu di puncak gunung untuk menghindari bahaya lahar dingin.
- Jauhi atap rumah yang mulai tertimbun abu tebal karena berisiko roboh sewaktu-waktu.

### 3. Fase Pasca-Bencana (Pemulihan):
- Jangan tergesa-gesa kembali ke rumah sebelum status gunung dinyatakan aman oleh PVMBG/BNPB.
- Bersihkan abu dari atap secara hati-hati dengan sedikit membasahinya terlebih dahulu agar tidak beterbangan.
- Pastikan sumber air bersih tidak tercemar abu sebelum dikonsumsi.
- Pantau hanya saluran komunikasi resmi BNPB, BPBD, atau aplikasi SI-Berapi.',
                'video_url' => 'https://www.youtube.com/watch?v=3g3gLd8fMsw',
                'thumbnail' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($educationData as $edu) {
            EducationContent::create($edu);
        }
    }
}
