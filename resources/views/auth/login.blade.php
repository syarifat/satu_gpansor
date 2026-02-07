<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - {{ config('app.name', 'Satu Ansor') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Figtree', sans-serif; } </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        
        <div class="w-full sm:max-w-lg bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">
            
            {{-- HEADER --}}
            <div class="pt-10 pb-6 px-8 text-center border-b border-gray-100 bg-white">
                <div class="flex justify-center mb-4">
                    <a href="/" class="transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 w-auto drop-shadow-md object-contain">
                    </a>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
                <p class="text-xs text-slate-500 mt-1.5 font-medium">Silakan masuk ke Satu Ansor System</p>
            </div>

            <div class="p-8 md:p-10 bg-white">
                
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                @if(session('error'))
                    <div class="mb-4 text-xs font-bold text-rose-600 bg-rose-50 p-3 rounded-xl border border-rose-100">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- 1. EMAIL --}}
                    <div class="space-y-1.5">
                        <label class="block font-bold text-xs text-slate-700 ml-1" for="email">Email / Username</label>
                        <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm transition-all duration-200 font-medium placeholder:text-slate-400" 
                               id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email Anda">
                        @error('email') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    {{-- 2. PASSWORD --}}
                    <div class="space-y-1.5">
                        <label class="block font-bold text-xs text-slate-700 ml-1" for="password">Password</label>
                        <div class="relative">
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 pr-12 text-sm transition-all duration-200 font-medium placeholder:text-slate-400" 
                                   id="password" type="password" name="password" required placeholder="••••••••">
                            
                            {{-- Tombol Mata --}}
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-emerald-600 cursor-pointer focus:outline-none">
                                <svg id="icon-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 hidden"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path></svg>
                                <svg id="icon-hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path></svg>
                            </button>
                        </div>
                    </div>

                    {{-- 3. REMEMBER ME --}}
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                            <input id="remember_me" type="checkbox" class="rounded-[0.4rem] border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 w-4 h-4 cursor-pointer transition-all" name="remember">
                            <span class="ms-2.5 text-xs text-slate-600 font-bold group-hover:text-emerald-600 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    {{-- 4. TOMBOL MASUK --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full justify-center py-3.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl text-xs font-black uppercase tracking-[0.15em] transition-all duration-300 shadow-lg shadow-emerald-100 hover:shadow-xl hover:shadow-emerald-200 transform hover:-translate-y-0.5 active:scale-95">
                            MASUK SEKARANG
                        </button>
                    </div>
                </form>

                {{-- 5. DIVIDER / OPSI GOOGLE --}}
                <div class="pt-4">
                    <div class="relative flex py-2 items-center">
                        <div class="flex-grow border-t border-gray-100"></div>
                        <span class="flex-shrink-0 mx-2 text-[10px] text-slate-300 font-bold uppercase tracking-widest">Atau Akses Cepat</span>
                        <div class="flex-grow border-t border-gray-100"></div>
                    </div>

                    {{-- TOMBOL GOOGLE LOGIN --}}
                    <a href="{{ route('auth.google') }}" class="flex items-center justify-center w-full py-3 bg-white border border-gray-200 hover:border-gray-300 text-slate-600 hover:bg-gray-50 rounded-xl transition-all duration-200 shadow-sm hover:shadow group gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" /><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" /><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" /><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" /></svg>
                        <span class="text-xs font-bold uppercase tracking-wider group-hover:text-slate-800">Masuk dengan Google</span>
                    </a>
                </div>

                {{-- 6. LINK DAFTAR BARU --}}
                <div class="pt-6 text-center">
                    <p class="text-xs text-slate-500 mb-2">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="inline-block px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-colors">
                        Daftar Anggota Baru
                    </a>
                </div>
                
                {{-- FOOTER --}}
                <div class="text-center pt-4">
                    <p class="text-[9px] text-slate-300 font-bold uppercase tracking-[0.2em] opacity-70 cursor-default">
                        {{ config('app.name') }} © {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT TOGGLE PASSWORD --}}
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const iconShow = document.getElementById('icon-show');
            const iconHide = document.getElementById('icon-hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconShow.classList.remove('hidden');
                iconHide.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                iconShow.classList.add('hidden');
                iconHide.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>