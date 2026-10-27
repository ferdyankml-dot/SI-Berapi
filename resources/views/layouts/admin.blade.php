<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SI-Berapi</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        terracotta: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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
            background-color: #f8fafc;
            color: #0f172a;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden"
         style="display: none;"></div>

    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-200 lg:translate-x-0 lg:static lg:inset-auto flex flex-col justify-between">
        
        <div>
            <!-- Admin Brand -->
            <div class="h-16 flex items-center px-6 border-b border-slate-100 gap-3">
                <div class="w-8 h-8 rounded-lg bg-orange-700 text-white flex items-center justify-center shadow-sm">
                    <i data-lucide="mountain" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="font-bold text-base text-slate-900 tracking-tight">SI-Berapi</h2>
                    <span class="text-[10px] text-orange-700 font-semibold uppercase tracking-wider block">Admin Panel</span>
                </div>
            </div>

            <!-- Admin Navigation -->
            <nav class="p-3 space-y-1 text-xs">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1.5 px-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                    Kelola Informasi
                </div>

                <a href="{{ route('admin.volcanoes.index') }}" 
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.volcanoes.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <i data-lucide="mountain" class="w-4 h-4"></i>
                    <span>Data Gunung Berapi</span>
                </a>

                <a href="{{ route('admin.missing.index') }}" 
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.missing.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Moderasi Orang Hilang</span>
                </a>

                <a href="{{ route('admin.histories.index') }}" 
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.histories.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Riwayat Letusan</span>
                </a>

                <a href="{{ route('admin.education.index') }}" 
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.education.*') ? 'bg-orange-50 text-orange-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    <span>Konten Edukasi & Video</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom Footer -->
        <div class="p-3 border-t border-slate-100 space-y-1 text-xs">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
                <i data-lucide="external-link" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Lihat Web Publik</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 transition text-left">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Admin Header -->
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="text-base font-semibold text-slate-900">@yield('page_title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <div class="text-xs font-semibold text-slate-900">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-slate-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-700 flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="p-4 sm:p-8 flex-1">
            @yield('content')
        </main>
    </div>

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
                    color: '#0f172a'
                });
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
