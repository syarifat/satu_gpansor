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

                {{-- REGISTRATION TYPE SELECTION --}}
                <div class="space-y-4">
                    {{-- REGISTER AS ANGGOTA --}}
                    <a href="{{ route('auth.google.register', ['type' => 'anggota']) }}"
                        class="flex items-center justify-between w-full py-4 px-6 bg-emerald-600 hover:bg-emerald-700 rounded-2xl transition-all duration-200 group shadow-md hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="block text-sm font-bold text-white">Daftar sebagai Anggota</span>
                                <span class="block text-[10px] text-emerald-100">Kader GP Ansor Tulungagung</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    {{-- REGISTER AS ADMIN --}}
                    <a href="{{ route('auth.google.register', ['type' => 'admin']) }}"
                        class="flex items-center justify-between w-full py-4 px-6 bg-slate-700 hover:bg-slate-800 rounded-2xl transition-all duration-200 group shadow-md hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="block text-sm font-bold text-white">Daftar sebagai Admin Unit</span>
                                <span class="block text-[10px] text-slate-300">Admin PAC / PR (1 per unit)</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                {{-- DIVIDER --}}
                <div class="relative flex py-6 items-center">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink-0 mx-4 text-[10px] text-slate-300 font-bold uppercase tracking-widest">INFO</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                {{-- INFO BOX --}}
                <div class="space-y-3">
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-[11px] text-emerald-700 font-medium leading-relaxed">
                                <strong>Anggota:</strong> Daftar sebagai kader GP Ansor untuk mendapatkan KTA Digital.
                            </p>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-[11px] text-slate-600 font-medium leading-relaxed">
                                <strong>Admin Unit:</strong> Kelola unit PAC/PR Anda. Setiap unit hanya boleh 1 admin.
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