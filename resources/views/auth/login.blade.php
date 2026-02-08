<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - {{ config('app.name', 'SATRIA TULUNGAGUNG') }}</title>
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

        {{-- CARD LOGIN --}}
        <div class="w-full sm:max-w-md bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">

            {{-- HEADER --}}
            <div class="pt-10 pb-6 px-8 text-center bg-white">
                <div class="flex justify-center mb-4">
                    <a href="/" class="transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo SATRIA TULUNGAGUNG" class="h-20 w-auto drop-shadow-md object-contain">
                    </a>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Sistem Administrasi Terpadu GP Ansor</p>
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
                <a href="{{ route('auth.google') }}"
                    class="flex items-center justify-center gap-3 w-full py-4 px-6 bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 rounded-2xl transition-all duration-200 group shadow-sm hover:shadow-md">

                    {{-- Google Icon --}}
                    <svg class="w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                    </svg>

                    <span class="text-base font-bold text-gray-700 group-hover:text-gray-900 transition-colors">
                        Masuk dengan Google
                    </span>
                </a>

                {{-- DIVIDER --}}
                <div class="relative flex py-6 items-center">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink-0 mx-4 text-[10px] text-slate-300 font-bold uppercase tracking-widest">Informasi</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                {{-- INFO BOX --}}
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 font-medium leading-relaxed">
                                Gunakan akun Google Anda untuk masuk atau mendaftar secara otomatis.
                                Jika ini pertama kali, Anda akan diminta melengkapi data profil.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- REGISTER LINK --}}
                <div class="text-center pt-6">
                    <p class="text-sm text-slate-500">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                            Daftar di sini
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