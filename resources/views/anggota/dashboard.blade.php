<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="w-2 h-6 bg-emerald-600 rounded-full"></div>
            <h2 class="font-black text-xl text-slate-800 leading-tight uppercase tracking-tight">
                {{ __('Dashboard Anggota') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- HERO: mengikuti style PC (gradient, rounded, watermark, shadow) --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-700 to-emerald-900 p-10 md:p-16 rounded-[3.5rem] shadow-2xl text-white border-b-8 border-emerald-800/50">
                <div class="relative z-10 max-w-3xl">
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4 inline-block border border-white/30">
                        Kartu Tanda Anggota
                    </span>

                    <h3 class="text-3xl md:text-5xl font-black mb-3 tracking-tighter">
                        Selamat Datang, <br>
                        Sahabat <span class="text-yellow-300">{{ $anggota->nama }}</span>!
                    </h3>

                    <p class="text-emerald-50 font-bold italic text-sm">
                        Ini adalah KTA digital Anda. Simpan atau unduh untuk keperluan administrasi.
                    </p>
                </div>

                <div class="absolute right-[-40px] bottom-[-60px] opacity-10 text-[18rem] font-black rotate-12 select-none pointer-events-none tracking-tighter">
                    ANSOR
                </div>
            </div>

            {{-- MAIN GRID: kiri KTA digital (besar) - kanan detail (white card) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                {{-- KTA DIGITAL --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-[0.3em] mb-4">Kartu Tanda Anggota Digital</h4>

                    <div class="relative w-full aspect-[1.586/1] rounded-[2rem] overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-300">
                        {{-- Background Gradient matching PC hero palette --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-800 via-emerald-600 to-emerald-900"></div>

                        {{-- Optional subtle texture/pattern --}}
                        <div class="absolute inset-0 opacity-8 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>

                        {{-- Content --}}
                        <div class="relative z-10 p-8 flex flex-col justify-between h-full text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h5 class="font-black text-xl uppercase tracking-tighter italic">Satu Ansor</h5>
                                    <p class="text-[10px] uppercase tracking-widest opacity-80">Kartu Tanda Anggota</p>
                                </div>

                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                                    <span class="font-bold text-sm">GP</span>
                                </div>
                            </div>

                            <div class="flex items-end gap-6">
                                <div class="w-24 h-24 bg-white rounded-xl shadow-lg border-2 border-white/50 flex items-center justify-center text-slate-300">
                                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>

                                <div class="space-y-1 mb-1">
                                    <p class="text-2xl font-black uppercase tracking-tight leading-none">{{ $anggota->nama }}</p>
                                    <p class="text-xs font-medium opacity-80 uppercase tracking-widest">{{ optional($anggota->jabatan)->nama ?? '-' }}</p>
                                    <div class="h-px w-10 bg-yellow-400 my-2"></div>
                                    <p class="text-[10px] font-bold uppercase">{{ optional($anggota->organisasiUnit)->nama ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-end mt-4">
                                <div>
                                    <p class="text-[8px] uppercase tracking-widest opacity-60">Nomor Induk Anggota</p>
                                    <p class="font-mono font-bold text-lg tracking-widest text-yellow-300">{{ $anggota->nik }}</p>
                                </div>

                                <div class="w-14 h-14 bg-white rounded-lg p-1 flex items-center justify-center">
                                    {{-- simple QR placeholder --}}
                                    <div class="w-full h-full bg-slate-900 opacity-80"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 flex justify-center">
                        <button onclick="window.print()" class="px-6 py-2 bg-slate-800 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Download KTA
                        </button>
                    </div>
                </div>

                {{-- DETAIL INFORMASI (white card: pakai style card PC) --}}
                <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-gray-100 h-fit">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.3em] mb-8">Informasi Keanggotaan</h3>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4 pb-6 border-b border-gray-50">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">👤</div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase mb-1">Nama Lengkap</p>
                                <p class="font-bold text-slate-800">{{ $anggota->nama }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pb-6 border-b border-gray-50">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">🏢</div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase mb-1">Unit Organisasi</p>
                                <p class="font-bold text-slate-800 uppercase">{{ optional($anggota->organisasiUnit)->nama ?? '-' }}</p>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded uppercase">Level: {{ optional($anggota->organisasiUnit)->level ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pb-6 border-b border-gray-50">
                            <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold">👔</div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase mb-1">Jabatan</p>
                                <p class="font-bold text-slate-800 uppercase">{{ optional($anggota->jabatan)->nama ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('profile.edit') }}" class="block w-full py-3 border-2 border-slate-100 text-slate-500 rounded-2xl text-[10px] font-black uppercase text-center tracking-widest hover:bg-slate-50 transition-all">
                                Edit Data Akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>