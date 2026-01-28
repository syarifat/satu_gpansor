<x-guest-layout>
    {{-- CARD LOGIN: Padding dikurangi jadi py-10 px-8 (sebelumnya py-12 px-10) --}}
    {{-- Lebar dikunci max-w-[400px] agar tetap ramping --}}
    <div class="w-full sm:max-w-[400px] bg-white shadow-2xl overflow-hidden rounded-[2rem] px-8 py-10 border border-gray-100 relative">
        
        {{-- 1. LOGO & HEADER (Lebih Ramping) --}}
        <div class="mb-6 text-center"> {{-- Margin bawah dikurangi jadi 6 --}}
            <div class="flex justify-center mb-4"> {{-- Margin bawah dikurangi jadi 4 --}}
                <a href="/" class="transition-transform hover:scale-105 duration-300">
                    {{-- Logo diperkecil jadi h-20 (sebelumnya h-24) --}}
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Satu Ansor" class="h-20 w-auto drop-shadow-md object-contain">
                </a>
            </div>
            
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
            <p class="text-xs text-slate-500 mt-1.5 font-medium">Silakan masuk ke Satu Ansor System</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Spasi form dikurangi jadi space-y-5 --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- 2. EMAIL / USERNAME --}}
            <div class="space-y-1">
                <label class="block font-bold text-xs text-slate-700 ml-1" for="email">
                    Email / Username
                </label>
                {{-- Input lebih pendek (py-3) --}}
                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm transition-all duration-200 font-medium placeholder:text-slate-400" 
                       id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                       placeholder="Masukkan email Anda">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs font-bold text-rose-500" />
            </div>

            {{-- 3. PASSWORD (Vanilla JS Toggle) --}}
            <div class="space-y-1">
                <div class="flex justify-between items-center ml-1">
                    <label class="block font-bold text-xs text-slate-700" for="password">
                        Password
                    </label>
                </div>

                <div class="relative">
                    {{-- Input Password lebih pendek (py-3) --}}
                    <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 pr-12 text-sm transition-all duration-200 font-medium placeholder:text-slate-400" 
                           id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password" 
                           placeholder="••••••••">
                    
                    {{-- Tombol Mata --}}
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-emerald-600 transition-colors cursor-pointer focus:outline-none">
                        
                        {{-- Icon Mata Terbuka --}}
                        <svg id="icon-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>

                        {{-- Icon Mata Coret --}}
                        <svg id="icon-hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs font-bold text-rose-500" />
            </div>

            {{-- 4. REMEMBER ME --}}
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                    <input id="remember_me" type="checkbox" class="rounded-[0.4rem] border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 w-4 h-4 cursor-pointer transition-all" name="remember">
                    <span class="ms-2.5 text-xs text-slate-600 font-bold group-hover:text-emerald-600 transition-colors">Ingat saya</span>
                </label>
            </div>

            {{-- 5. TOMBOL MASUK --}}
            <div class="pt-2">
                {{-- Padding tombol dikurangi jadi py-3.5 --}}
                <button type="submit" class="w-full justify-center py-3.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl text-xs font-black uppercase tracking-[0.15em] transition-all duration-300 shadow-lg shadow-emerald-100 hover:shadow-xl hover:shadow-emerald-200 transform hover:-translate-y-0.5 active:scale-95">
                    MASUK SEKARANG
                </button>
            </div>
            
            {{-- 6. FOOTER --}}
            <div class="text-center pt-4">
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] opacity-70 cursor-default">
                    SATU ANSOR SYSTEM © {{ date('Y') }}
                </p>
            </div>
        </form>
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
</x-guest-layout>