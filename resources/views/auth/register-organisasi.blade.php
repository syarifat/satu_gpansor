<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registrasi Organisasi - {{ config('app.name', 'Satu Ansor') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', sans-serif; }
        /* Custom Scrollbar untuk textarea */
        textarea::-webkit-scrollbar { width: 8px; }
        textarea::-webkit-scrollbar-track { background: #f1f1f1; }
        textarea::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        textarea::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        
        {{-- CARD WIDE: Lebar max-5xl agar muat 2 kolom --}}
        <div class="w-full sm:max-w-5xl bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">
            
            {{-- HEADER with Logo --}}
            <div class="pt-10 pb-6 px-8 text-center border-b border-gray-100 bg-white relative z-10">
                <div class="flex justify-center mb-4">
                    <a href="/" class="transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Satu Ansor" class="h-16 w-auto drop-shadow-md object-contain">
                    </a>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Registrasi Organisasi</h2>
                <p class="text-xs text-slate-500 mt-1.5 font-medium">Formulir Pendaftaran Unit Baru (PAC / Ranting)</p>
            </div>

            <form method="POST" action="{{ route('register.organisasi') }}" class="p-8 md:p-10 bg-white">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    {{-- KOLOM KIRI: DATA WILAYAH & ORGANISASI --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">1. Data Wilayah Organisasi</h3>
                        </div>

                        {{-- TINGKATAN --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Tingkatan Organisasi</label>
                            <select id="tingkatan" name="tingkatan" onchange="toggleWilayah()" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                <option value="" selected disabled>Pilih Tingkatan...</option>
                                <option value="pac">Pimpinan Anak Cabang (Kecamatan)</option>
                                <option value="pr">Pimpinan Ranting (Desa)</option>
                            </select>
                            @error('tingkatan') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- KECAMATAN --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan_id" onchange="fetchDesa(this.value)" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                <option value="" selected disabled>Pilih Kecamatan...</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec->id }}">Kecamatan {{ Str::title($kec->nama) }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- DESA (Hidden by Default) --}}
                        <div id="wrapper_desa" class="space-y-1.5 hidden">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Desa / Kelurahan</label>
                            <select id="desa" name="desa_id" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                <option value="" selected disabled>Pilih Kecamatan Dulu...</option>
                            </select>
                            @error('desa_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- INFO BOX --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mt-4">
                            <p class="text-xs text-blue-600 leading-relaxed font-medium">
                                <strong>Catatan:</strong> Nama Unit Organisasi akan dibuat otomatis sesuai wilayah yang dipilih (Contoh: <em>PAC GP Ansor Kauman</em>).
                            </p>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: DATA SEKRETARIAT & ADMIN --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">2. Kontak & Akun Admin</h3>
                        </div>

                        {{-- ALAMAT SEKRETARIAT --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Alamat Lengkap Sekretariat</label>
                            <textarea name="alamat_sekretariat" rows="3" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all placeholder:text-slate-400" placeholder="Jalan, RT/RW, Dusun (Tanpa Nama Desa/Kecamatan)" required>{{ old('alamat_sekretariat') }}</textarea>
                            @error('alamat_sekretariat') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{-- NO TELP --}}
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">No. Telp/WA Resmi</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="number" name="notelp_organisasi" value="{{ old('notelp_organisasi') }}" required placeholder="08xxxxxxxxxx">
                                @error('notelp_organisasi') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            {{-- NAMA KETUA --}}
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Nama Ketua / Admin</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="text" name="nama_ketua" value="{{ old('nama_ketua') }}" required placeholder="Nama Lengkap">
                                @error('nama_ketua') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- EMAIL LOGIN --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Email (Untuk Login)</label>
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                   type="email" name="email" value="{{ old('email') }}" required placeholder="admin.unit@ansor.or.id">
                            @error('email') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Password</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="password" name="password" required placeholder="••••••••">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Konfirmasi</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="password" name="password_confirmation" required placeholder="••••••••">
                            </div>
                        </div>
                        @error('password') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror

                    </div>
                </div>

                {{-- FOOTER BUTTONS --}}
                <div class="pt-8 mt-4 border-t border-gray-100 flex flex-col items-center gap-4">
                    <button type="submit" class="w-full sm:w-1/2 justify-center py-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-2xl text-sm font-black uppercase tracking-[0.15em] shadow-lg shadow-emerald-100 hover:shadow-xl hover:shadow-emerald-200 transform hover:-translate-y-1 active:scale-95 transition-all duration-300">
                        Daftarkan Unit Sekarang
                    </button>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-bold transition-colors">
                            Bukan Admin? Daftar sebagai <span class="underline decoration-2 decoration-emerald-200 underline-offset-4">Anggota Biasa di sini</span>
                        </a>
                    </div>
                </div>

                {{-- COPYRIGHT --}}
                <div class="text-center pt-6">
                    <p class="text-[9px] text-slate-300 font-bold uppercase tracking-[0.2em]">
                        {{ config('app.name') }} © {{ date('Y') }}
                    </p>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function toggleWilayah() {
            const tingkatan = document.getElementById('tingkatan').value;
            const wrapperDesa = document.getElementById('wrapper_desa');
            const selectDesa = document.getElementById('desa');

            if (tingkatan === 'pr') {
                wrapperDesa.classList.remove('hidden');
                selectDesa.setAttribute('required', 'required');
            } else {
                wrapperDesa.classList.add('hidden');
                selectDesa.removeAttribute('required');
            }
        }

        async function fetchDesa(kecamatanId) {
            const selectDesa = document.getElementById('desa');
            selectDesa.innerHTML = '<option>Loading...</option>';
            try {
                // Pastikan Route ini tersedia di routes/web.php atau routes/api.php
                const res = await fetch(`/desa/${kecamatanId}`);
                const data = await res.json();
                
                selectDesa.innerHTML = '<option value="" selected disabled>Pilih Desa...</option>';
                data.forEach(d => {
                    let opt = document.createElement('option');
                    opt.value = d.id;
                    opt.text = toTitleCase(d.nama);
                    selectDesa.add(opt);
                });
            } catch (err) {
                console.error(err);
                selectDesa.innerHTML = '<option>Gagal memuat data</option>';
            }
        }

        function toTitleCase(str) {
            return str.replace(/\w\S*/g, function(txt){ return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); });
        }
    </script>
</body>
</html>