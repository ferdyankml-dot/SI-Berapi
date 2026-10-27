<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SI-Berapi') - Sistem Informasi Bencana Gunung Berapi</title>
    <meta name="description" content="@yield('meta_description', 'Sistem Informasi Bencana Gunung Berapi Nasional terpadu untuk monitoring status gunung api, mitigasi bencana, pelaporan orang hilang, dan edukasi vulkanologi.')">
    <meta name="theme-color" content="#C2410C">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Tailwind CSS (Clean Light Theme Configuration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        terracotta: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c', // Primary Accent
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc; /* bg-slate-50 */
            color: #0f172a; /* text-slate-900 */
        }
        .leaflet-popup-content-wrapper {
            background-color: #ffffff;
            color: #0f172a;
            border-radius: 1rem;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.1);
        }
        .leaflet-popup-tip {
            background-color: #ffffff;
        }
        .clean-card {
            background-color: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease-in-out;
        }
        .clean-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.06);
            border-color: rgba(203, 213, 225, 0.9);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col antialiased selection:bg-orange-100 selection:text-orange-900" x-data="{ mobileMenuOpen: false }">

    <!-- Subtle Minimalist Status Banner -->
    <div class="bg-orange-50/70 border-b border-orange-200/60 text-orange-950 text-xs py-2 px-4 font-medium">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 overflow-hidden">
                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-orange-100 text-orange-800 shrink-0">
                    Peringatan
                </span>
                <p class="truncate text-slate-700 text-xs">
                    PVMBG menetapkan <strong>Gunung Lewotobi Laki-laki</strong> & <strong>Gunung Ibu</strong> pada <strong>Level IV (AWAS)</strong>. Masyarakat diimbau mematuhi radius sektoral aman.
                </p>
            </div>
            <div class="hidden md:flex items-center gap-3 shrink-0 text-xs text-slate-500">
                <a href="tel:117" class="hover:text-orange-700 flex items-center gap-1 font-semibold transition">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-orange-700"></i> Hotline BNPB: 117
                </a>
                <span>•</span>
                <span>Pembaruan Real-Time</span>
            </div>
        </div>
    </div>

    <!-- Floating Sticky Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/85 border-b border-slate-200/80 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 py-3.5">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-orange-700 text-white flex items-center justify-center shadow-sm group-hover:bg-orange-800 transition">
                        <i data-lucide="mountain" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-bold tracking-tight text-slate-900 group-hover:text-orange-700 transition">
                                SI-Berapi
                            </span>
                            <span class="hidden sm:inline-block px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider bg-orange-50 border border-orange-200/70 text-orange-700 rounded-full">
                                Monitoring
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-normal hidden sm:block">
                            Sistem Informasi Bencana Gunung Berapi
                        </p>
                    </div>
                </a>

                <!-- Desktop Menu Links -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Beranda
                    </a>
                    <a href="{{ route('volcanoes.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('volcanoes.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Gunung Rawan
                    </a>
                    <a href="{{ route('missing_persons.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('missing_persons.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Orang Hilang
                    </a>
                    <a href="{{ route('education.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('education.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Edukasi Mitigasi
                    </a>
                    <a href="{{ route('disasters.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('disasters.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Riwayat Erupsi
                    </a>
                    <a href="{{ route('contact.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('contact.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        Kontak Darurat
                    </a>
                </nav>

                <!-- Desktop Action CTA -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('missing_persons.index') }}#laporkan" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs tracking-wide shadow-sm transition">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Lapor Korban</span>
                    </a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 transition" title="Dashboard Admin">
                            <i data-lucide="layout-dashboard" class="w-4 h-4 text-orange-700"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Login Petugas">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center gap-2 lg:hidden">
                    <a href="{{ route('missing_persons.index') }}#laporkan" 
                       class="px-3 py-1.5 rounded-lg bg-orange-700 text-white font-semibold text-xs flex items-center gap-1 shadow-sm">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Lapor
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            type="button" 
                            class="p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none"
                            aria-label="Menu">
                        <i data-lucide="menu" class="w-5 h-5" x-show="!mobileMenuOpen"></i>
                        <i data-lucide="x" class="w-5 h-5" x-show="mobileMenuOpen" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-b border-slate-200 bg-white px-4 pt-3 pb-6 space-y-1 shadow-lg"
             style="display: none;">
            
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="home" class="w-4 h-4"></i> Beranda
            </a>
            <a href="{{ route('volcanoes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('volcanoes.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="mountain" class="w-4 h-4"></i> Gunung Rawan Bencana
            </a>
            <a href="{{ route('missing_persons.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('missing_persons.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="users" class="w-4 h-4"></i> Laporan Orang Hilang
            </a>
            <a href="{{ route('education.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('education.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="book-open" class="w-4 h-4"></i> Edukasi & Mitigasi
            </a>
            <a href="{{ route('disasters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('disasters.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="history" class="w-4 h-4"></i> Riwayat Erupsi
            </a>
            <a href="{{ route('contact.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('contact.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">
                <i data-lucide="phone" class="w-4 h-4"></i> Kontak Darurat
            </a>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="font-semibold text-orange-700 flex items-center gap-1.5 py-1">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-medium hover:text-slate-900 flex items-center gap-1.5 py-1">
                        <i data-lucide="lock" class="w-4 h-4"></i> Login Petugas
                    </a>
                @endauth
                <a href="tel:117" class="font-semibold text-slate-700 flex items-center gap-1">
                    Hotline BNPB: 117
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Minimalist Light Footer -->
    <footer class="bg-white border-t border-slate-200 text-slate-600 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Brand & Overview -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-orange-700 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="mountain" class="w-4 h-4"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">SI-Berapi</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Sistem Informasi Bencana Gunung Berapi Republik Indonesia. Portal pemantauan tingkat status vulkanik, sebaran peta geospasial, dan koordinasi informasi orang hilang.
                    </p>
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Pemantauan Terintegrasi 24/7</span>
                    </div>
                </div>

                <!-- Col 2: Navigasi -->
                <div>
                    <h3 class="text-slate-900 font-semibold text-xs uppercase tracking-wider mb-4">
                        Navigasi Layanan
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-600">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-700 transition">Beranda & Status Terkini</a></li>
                        <li><a href="{{ route('volcanoes.index') }}" class="hover:text-orange-700 transition">Peta Sebaran Gunung Api</a></li>
                        <li><a href="{{ route('missing_persons.index') }}" class="hover:text-orange-700 transition">Laporan Orang Hilang</a></li>
                        <li><a href="{{ route('education.index') }}" class="hover:text-orange-700 transition">Panduan Edukasi & Mitigasi</a></li>
                        <li><a href="{{ route('disasters.index') }}" class="hover:text-orange-700 transition">Arsip Riwayat Letusan</a></li>
                    </ul>
                </div>

                <!-- Col 3: Emergency Hotlines -->
                <div>
                    <h3 class="text-slate-900 font-semibold text-xs uppercase tracking-wider mb-4">
                        Nomor Darurat Nasional
                    </h3>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li class="flex items-center justify-between py-1.5 border-b border-slate-100">
                            <span>BNPB Pusat</span>
                            <a href="tel:117" class="text-orange-700 font-semibold hover:underline">117</a>
                        </li>
                        <li class="flex items-center justify-between py-1.5 border-b border-slate-100">
                            <span>BASARNAS (SAR)</span>
                            <a href="tel:115" class="text-orange-700 font-semibold hover:underline">115</a>
                        </li>
                        <li class="flex items-center justify-between py-1.5 border-b border-slate-100">
                            <span>PVMBG Bandung</span>
                            <a href="tel:0227272606" class="text-slate-800 font-medium hover:underline">(022) 7272606</a>
                        </li>
                        <li class="flex items-center justify-between py-1.5">
                            <span>Ambulans Darurat</span>
                            <a href="tel:119" class="text-slate-800 font-medium hover:underline">119</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Sumber Rujukan -->
                <div>
                    <h3 class="text-slate-900 font-semibold text-xs uppercase tracking-wider mb-4">
                        Sumber Data Resmi
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">
                        Data pemantauan visual, seismisitas, dan rekomendasi radius bahaya diselaraskan dengan rilis resmi PVMBG dan Badan Geologi Kementerian ESDM.
                    </p>
                    <div class="p-3 rounded-xl bg-orange-50/60 border border-orange-200/70 text-xs text-orange-950">
                        Patuhi rekomendasi radius steril dan hindari menerobos zona merah saat status gunung dinaikkan.
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Auth Link -->
            <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>© {{ date('Y') }} SI-Berapi. Hak Cipta Terlindungi.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('contact.index') }}" class="hover:text-slate-600 transition">Kontak Layanan</a>
                    <span>•</span>
                    <a href="{{ route('education.index') }}" class="hover:text-slate-600 transition">Mitigasi Bencana</a>
                    <span>•</span>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-orange-700 font-medium hover:underline">Dashboard ({{ Auth::user()->name }})</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-slate-600 transition">Akses Petugas</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Lucide init -->
    <script>
        lucide.createIcons();
    </script>

    <!-- SweetAlert Flash Handler -->
    @if(session('flash_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil',
                    text: "{{ session('flash_success') }}",
                    icon: 'success',
                    confirmButtonText: 'Selesai',
                    confirmButtonColor: '#C2410C',
                    background: '#ffffff',
                    color: '#0f172a',
                    customClass: {
                        popup: 'rounded-2xl border border-slate-200 shadow-xl'
                    }
                });
            });
        </script>
    @endif

    @if(session('flash_error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Perhatian',
                    text: "{{ session('flash_error') }}",
                    icon: 'error',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#C2410C',
                    background: '#ffffff',
                    color: '#0f172a',
                    customClass: {
                        popup: 'rounded-2xl border border-slate-200 shadow-xl'
                    }
                });
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
