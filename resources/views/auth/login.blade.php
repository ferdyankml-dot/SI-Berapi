@extends('layouts.app')

@section('title', 'Login Petugas - SI-Berapi')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full clean-card p-8 space-y-6">
        <div class="text-center space-y-1">
            <div class="w-10 h-10 mx-auto rounded-xl bg-orange-700 text-white flex items-center justify-center shadow-sm mb-3">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Login Administrator</h1>
            <p class="text-xs text-slate-500">Akses modul kendali dan moderasi data SI-Berapi</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email', 'admin@siberapi.id') }}" required 
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600" 
                           placeholder="nama@siberapi.id">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" value="admin123" required 
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 text-xs text-slate-900 focus:outline-none focus:bg-white focus:border-orange-600 focus:ring-1 focus:ring-orange-600" 
                           placeholder="••••••••">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-orange-700 focus:ring-orange-600">
                    <span>Ingat sesi saya</span>
                </label>
                <span class="text-slate-400 text-[11px]">Koneksi terenkripsi</span>
            </div>

            <button type="submit" 
                    class="w-full py-3 rounded-xl bg-orange-700 hover:bg-orange-800 text-white font-semibold text-xs uppercase tracking-wider shadow-sm transition flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-4 h-4"></i> Masuk ke Dashboard
            </button>
        </form>

        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-500 text-center">
            <span class="text-[10px] uppercase font-semibold text-orange-700 block mb-0.5">Kredensial Demo:</span>
            Email: <strong class="text-slate-800">admin@siberapi.id</strong> • Sandi: <strong class="text-slate-800">admin123</strong>
        </div>
    </div>
</div>
@endsection
