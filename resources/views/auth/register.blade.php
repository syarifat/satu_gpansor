<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar Anggota Baru - {{ config('app.name', 'Satu Ansor') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', sans-serif; }
        /* Custom scrollbar untuk textarea */
        textarea::-webkit-scrollbar { width: 8px; }
        textarea::-webkit-scrollbar-track { background: #f1f1f1; }
        textarea::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        textarea::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        
        {{-- CARD REGISTER: Lebar max-5xl agar muat 2 kolom --}}
        <div class="w-full sm:max-w-5xl bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">
            
            {{-- HEADER --}}
            <div class="pt-10 pb-6 px-8 text-center border-b border-gray-100 bg-white">
                <div class="flex justify-center mb-4">
                    <a href="/" class="transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 w-auto drop-shadow-md object-contain">
                    </a>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Formulir Anggota Baru</h2>
                <p class="text-xs text-slate-500 mt-1.5 font-medium">Lengkapi biodata diri Anda secara lengkap dan valid</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-8 md:p-10 bg-white space-y-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    {{-- KOLOM KIRI: DATA PRIBADI --}}
                    <div class="space-y-5">
                        <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">1. Data Akun & Pribadi</h3>
                        </div>

                        {{-- Nama --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Nama Lengkap (Sesuai KTP)</label>
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                   type="text" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Nama Lengkap">
                            @error('nama') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">NIK (16 Digit)</label>
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                   type="number" name="nik" value="{{ old('nik') }}" required placeholder="Nomor Induk Kependudukan">
                            @error('nik') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIA --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">NIA (Nomor Induk Anggota)</label>
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                   type="text" name="nia" value="{{ old('nia') }}" placeholder="Contoh: 12.05.03.xxxx">
                            <p class="text-[10px] text-slate-400 ml-1 font-medium italic">*Bagi yang sudah punya. Kosongi bila belum punya.</p>
                            @error('nia') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- TTL --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tempat Lahir</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required placeholder="Kota Lahir">
                                @error('tempat_lahir') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tanggal Lahir</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Kelamin & Status --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Jenis Kelamin</label>
                                <select name="kelamin" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Status Kawin</label>
                                <select name="status_kawin" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                    <option value="belum_kawin">Belum Kawin</option>
                                    <option value="kawin">Kawin</option>
                                    <option value="cerai_hidup">Cerai Hidup</option>
                                    <option value="cerai_mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Email (Untuk Login)</label>
                            <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                   type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
                            @error('email') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="grid grid-cols-2 gap-4">
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

                    {{-- KOLOM KANAN: KONTAK, ALAMAT, ORGANISASI --}}
                    <div class="space-y-8">
                        
                        {{-- KONTAK & DOMISILI --}}
                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">2. Kontak & Domisili</h3>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">No. WhatsApp / HP</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="number" name="notelp" value="{{ old('notelp') }}" required placeholder="08xxxxxxxxxx">
                                @error('notelp') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" placeholder="Jalan / Dusun / RT / RW">{{ old('alamat') }}</textarea>
                                @error('alamat') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Kecamatan Domisili</label>
                                    <select id="domisili_kecamatan" name="kecamatan_id" onchange="fetchDesa('domisili_desa', this.value)" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                        <option value="" selected disabled>Pilih...</option>
                                        @foreach(\App\Models\Kecamatan::orderBy('nama')->get() as $kec)
                                            <option value="{{ $kec->id }}">{{ Str::title($kec->nama) }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Desa Domisili</label>
                                    <select id="domisili_desa" name="desa_id" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                        <option value="" selected disabled>Pilih Kecamatan dulu</option>
                                    </select>
                                    @error('desa_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- SATUAN ORGANISASI --}}
                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">3. Satuan Organisasi (Keanggotaan)</h3>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tingkatan Organisasi</label>
                                <select id="tingkatan_organisasi" name="tingkatan_organisasi" onchange="toggleSatuan()" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                    <option value="" selected disabled>Pilih Tingkatan...</option>
                                    <option value="pac">Pimpinan Anak Cabang (Kecamatan)</option>
                                    <option value="pr">Pimpinan Ranting (Desa)</option>
                                </select>
                                @error('tingkatan_organisasi') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Pilih PAC --}}
                                <div id="wrapper_pac" class="hidden space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pilih PAC (Kecamatan)</label>
                                    <select id="unit_kecamatan" name="unit_kecamatan_id" onchange="fetchDesa('unit_desa', this.value, true)" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                        <option value="" selected disabled>Pilih PAC...</option>
                                        @foreach(\App\Models\Kecamatan::orderBy('nama')->get() as $kec)
                                            <option value="{{ $kec->id }}">PAC GP Ansor {{ Str::title($kec->nama) }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_kecamatan_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                                </div>

                                {{-- Pilih PR --}}
                                <div id="wrapper_pr" class="hidden space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pilih PR (Desa)</label>
                                    <select id="unit_desa" name="unit_desa_id" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                        <option value="" selected disabled>Pilih PAC Dulu...</option>
                                    </select>
                                    @error('unit_desa_id') <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- PENDIDIKAN & PEKERJAAN --}}
                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">4. Pendidikan & Pekerjaan</h3>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pendidikan Terakhir</label>
                                    <select name="last_education" class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all cursor-pointer">
                                        <option value="SMA">SMA/Sederajat</option>
                                        <option value="D3">Diploma (D3)</option>
                                        <option value="S1">Sarjana (S1)</option>
                                        <option value="S2">Magister (S2)</option>
                                        <option value="Pesantren">Pesantren</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pekerjaan Utama</label>
                                    <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                           type="text" name="job_title" value="{{ old('job_title') }}" placeholder="Guru, Petani, dll">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Alamat Kantor/Usaha (Opsional)</label>
                                <input class="block w-full border-gray-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 rounded-xl shadow-sm py-3 px-4 text-sm font-medium transition-all" 
                                       type="text" name="job_address" value="{{ old('job_address') }}" placeholder="Kota atau Alamat Tempat Bekerja">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- FOOTER BUTTONS --}}
                <div class="pt-8 border-t border-gray-100 flex flex-col items-center gap-4 mt-4">
                    <button type="submit" class="w-full sm:w-1/2 justify-center py-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg shadow-emerald-100 hover:shadow-xl hover:shadow-emerald-200 transform hover:-translate-y-1 active:scale-95 transition-all duration-300">
                        Simpan Data & Daftar
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-bold transition-colors">
                            Sudah punya akun? <span class="underline decoration-2 decoration-emerald-200 underline-offset-4">Masuk di sini</span>
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

    {{-- SCRIPT LOGIC --}}
    <script>
        function toggleSatuan() {
            const tingkatan = document.getElementById('tingkatan_organisasi').value;
            const wrapperPac = document.getElementById('wrapper_pac');
            const wrapperPr = document.getElementById('wrapper_pr');
            const selectPac = document.getElementById('unit_kecamatan');
            const selectPr = document.getElementById('unit_desa');

            // Reset tampilan & required
            wrapperPac.classList.add('hidden');
            wrapperPr.classList.add('hidden');
            selectPac.removeAttribute('required');
            selectPr.removeAttribute('required');

            if (tingkatan === 'pac') {
                wrapperPac.classList.remove('hidden');
                selectPac.setAttribute('required', 'required');
            } else if (tingkatan === 'pr') {
                wrapperPac.classList.remove('hidden');
                wrapperPr.classList.remove('hidden');
                selectPac.setAttribute('required', 'required');
                selectPr.setAttribute('required', 'required');
            }
        }

        async function fetchDesa(targetId, kecamatanId, isUnit = false) {
            const selectTarget = document.getElementById(targetId);
            selectTarget.innerHTML = '<option>Loading...</option>';
            
            try {
                // Pastikan route API: /desa/{id} tersedia
                const res = await fetch(`/desa/${kecamatanId}`); 
                const data = await res.json();
                
                selectTarget.innerHTML = isUnit 
                    ? '<option value="" selected disabled>Pilih Ranting (PR)...</option>' 
                    : '<option value="" selected disabled>Pilih Desa...</option>';

                data.forEach(d => {
                    let opt = document.createElement('option');
                    opt.value = d.id;
                    let namaWilayah = toTitleCase(d.nama);
                    // Format nama khusus untuk Unit PR
                    opt.text = isUnit ? `PR GP Ansor ${namaWilayah}` : namaWilayah;
                    selectTarget.add(opt);
                });
            } catch (err) {
                console.error(err);
                selectTarget.innerHTML = '<option>Gagal memuat data</option>';
            }
        }

        function toTitleCase(str) {
            return str.replace(/\w\S*/g, function(txt){
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }
    </script>
</body>
</html>