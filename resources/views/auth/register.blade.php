<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota Baru - {{ config('app.name', 'Satu Ansor') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Figtree', sans-serif; } </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        
        <div class="w-full sm:max-w-md bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 text-center p-10 relative">
            
            {{-- Strip Hiasan Atas --}}
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>

            <div class="mb-6 flex justify-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 w-auto drop-shadow-md object-contain">
            </div>

            <h2 class="text-2xl font-black text-slate-800 mb-2 tracking-tight">Registrasi Anggota</h2>
            <p class="text-sm text-slate-500 mb-8 px-4 leading-relaxed">
                Untuk menjamin keamanan dan validitas data, pendaftaran anggota baru <strong>wajib menggunakan akun Google</strong>.
            </p>

            {{-- TOMBOL DAFTAR VIA GOOGLE --}}
            <a href="{{ route('auth.google') }}" class="group relative w-full flex items-center justify-center gap-3 py-4 bg-white border-2 border-emerald-100 hover:border-emerald-500 text-slate-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1 mb-6">
                <svg class="w-6 h-6 transition-transform group-hover:scale-110" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" /><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" /><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" /><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" /></svg>
                <span class="font-bold text-sm uppercase tracking-wide group-hover:text-emerald-700">Lanjut dengan Google</span>
            </a>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-xs text-slate-400">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:underline text-sm mt-1 inline-block">Login disini</a>
            </div>
        </div>
    </div>
</body>
</html>