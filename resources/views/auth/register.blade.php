<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar - {{ config('app.name', 'SATRIA TULUNGAGUNG') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">

        {{-- CARD REGISTER --}}
        <div class="w-full sm:max-w-md bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">

            {{-- HEADER --}}
            <div class="pt-10 pb-6 px-8 text-center bg-white">
                <div class="flex justify-center mb-4">
                    <a href="/" class="transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo SATRIA TULUNGAGUNG" class="h-20 w-auto drop-shadow-md object-contain">
                    </a>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Daftar Akun Baru</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Bergabung dengan GP Ansor Tulungagung</p>
            </div>

            <div class="p-8 md:p-10 bg-white">

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl">
                    @foreach ($errors->all() as $error)
                    <p class="text-rose-600 text-sm font-medium">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                {{-- SESSION STATUS --}}
                @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <p class="text-emerald-600 text-sm font-medium">{{ session('status') }}</p>
                </div>
                @endif

                {{-- GOOGLE LOGIN BUTTON --}}
                <div class="space-y-4">
                    <a href="{{ route('auth.google.register') }}" class="flex items-center justify-center w-full py-4 px-6 bg-white border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-slate-700 hover:text-emerald-700 rounded-2xl transition-all duration-300 group shadow-sm hover:shadow-lg transform hover:-translate-y-0.5">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-6 h-6 mr-3" alt="Google Logo">
                        <span class="text-sm font-black tracking-wide uppercase">Masuk dengan Google</span>
                    </a>
                </div>

                {{-- INFO DIVIDER --}}
                <div class="relative flex py-8 items-center">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink-0 mx-4 text-[10px] text-slate-400 font-bold uppercase tracking-widest">INFO</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                <div class="bg-emerald-50 rounded-2xl p-5 border border-emerald-100/50">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-emerald-800 uppercase tracking-wide mb-1">Pendaftaran Anggota</h4>
                            <p class="text-[11px] text-slate-600 leading-relaxed">
                                Gunakan akun Google Anda untuk mendaftar sebagai Anggota GP Ansor.
                                <br>Untuk <strong>Admin Unit</strong>, silakan daftar sebagai anggota biasa terlebih dahulu, lalu hubungi Admin PC untuk aktivasi akses admin.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- LOGIN LINK --}}
                <div class="text-center pt-6">
                    <p class="text-sm text-slate-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                {{-- FOOTER --}}
                <div class="text-center pt-6">
                    <p class="text-[9px] text-slate-300 font-bold uppercase tracking-[0.2em] opacity-70 cursor-default">
                        {{ config('app.name') }} © {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>