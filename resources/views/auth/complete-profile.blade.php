<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Biodata - {{ config('app.name', 'Satu Ansor') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> 
        body { font-family: 'Figtree', sans-serif; } 
        textarea::-webkit-scrollbar { width: 8px; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        
        <div class="w-full sm:max-w-5xl bg-white shadow-2xl overflow-hidden rounded-[2.5rem] border border-gray-100 relative">
            
            {{-- HEADER --}}
            <div class="pt-10 pb-6 px-8 text-center border-b border-gray-100 bg-white">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 w-auto drop-shadow-md object-contain">
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Lengkapi Biodata Anggota</h2>
                <div class="mt-3 inline-flex items-center gap-2 bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-widest">Verifikasi Google Berhasil</p>
                </div>
            </div>

            {{-- !!! AREA PESAN ERROR (DEBUGGING) !!! --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-8 mb-0 rounded-r-xl">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-red-800">Ada kesalahan pada input Anda:</h3>
                            <ul class="mt-2 list-disc list-inside text-xs text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-8 mb-0">
                    <strong class="font-bold">Error System!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('complete.profile.store') }}" class="p-8 md:p-10 bg-white space-y-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    {{-- KOLOM KIRI --}}
                    <div class="space-y-5">
                        <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">1. Data Akun</h3>
                        </div>

                        {{-- Nama & Email Readonly --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Nama Lengkap</label>
                            <input class="block w-full bg-gray-100 text-gray-500 rounded-xl py-3 px-4 text-sm font-bold" type="text" value="{{ auth()->user()->nama }}" readonly>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">Email</label>
                            <input class="block w-full bg-gray-100 text-gray-500 rounded-xl py-3 px-4 text-sm font-bold" type="email" value="{{ auth()->user()->email }}" readonly>
                        </div>

                        {{-- Password --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Password Baru</label>
                                <input class="block w-full border-gray-200 bg-white focus:border-emerald-500 rounded-xl py-3 px-4 text-sm" type="password" name="password" required>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Ulangi Password</label>
                                <input class="block w-full border-gray-200 bg-white focus:border-emerald-500 rounded-xl py-3 px-4 text-sm" type="password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4 mt-6">
                            <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">2. Identitas</h3>
                        </div>

                        {{-- NIK & NIA --}}
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">NIK (16 Digit)</label>
                            <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="number" name="nik" value="{{ old('nik') }}" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block font-bold text-xs text-slate-700 ml-1">NIA (Opsional)</label>
                            <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="text" name="nia" value="{{ old('nia') }}">
                        </div>

                        {{-- TTL --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tempat Lahir</label>
                                <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tanggal Lahir</label>
                                <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                        </div>

                        {{-- Kelamin & Status --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Jenis Kelamin</label>
                                <select name="kelamin" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm cursor-pointer">
                                    <option value="L" {{ old('kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Status Kawin</label>
                                <select name="status_kawin" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm cursor-pointer">
                                    <option value="belum_kawin">Belum Kawin</option>
                                    <option value="kawin">Kawin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="space-y-8">
                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">3. Kontak & Domisili</h3>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">No. HP / WA</label>
                                <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="number" name="notelp" value="{{ old('notelp') }}" required>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" required>{{ old('alamat') }}</textarea>
                            </div>
                            
                            {{-- Domisili Dropdown --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Kecamatan</label>
                                    <select id="domisili_kecamatan" name="kecamatan_id" onchange="fetchDesa('domisili_desa', this.value)" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm">
                                        <option value="" selected disabled>Pilih...</option>
                                        @foreach(\App\Models\Kecamatan::orderBy('nama')->get() as $kec)
                                            <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>{{ Str::title($kec->nama) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Desa</label>
                                    <select id="domisili_desa" name="desa_id" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm">
                                        <option value="" selected disabled>Pilih Kec. dulu</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">4. Satuan Organisasi</h3>
                            </div>
                            
                            {{-- Tingkatan --}}
                            <div class="space-y-1.5">
                                <label class="block font-bold text-xs text-slate-700 ml-1">Tingkatan Organisasi</label>
                                <select id="tingkatan_organisasi" name="tingkatan_organisasi" onchange="toggleSatuan()" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm cursor-pointer">
                                    <option value="" selected disabled>Pilih Tingkatan...</option>
                                    <option value="pac" {{ old('tingkatan_organisasi') == 'pac' ? 'selected' : '' }}>Pimpinan Anak Cabang (Kecamatan)</option>
                                    <option value="pr" {{ old('tingkatan_organisasi') == 'pr' ? 'selected' : '' }}>Pimpinan Ranting (Desa)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Pilih PAC --}}
                                <div id="wrapper_pac" class="hidden space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pilih PAC</label>
                                    <select id="unit_kecamatan" name="unit_kecamatan_id" onchange="fetchDesa('unit_desa', this.value, true)" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm">
                                        <option value="" selected disabled>Pilih PAC...</option>
                                        @foreach(\App\Models\Kecamatan::orderBy('nama')->get() as $kec)
                                            <option value="{{ $kec->id }}" {{ old('unit_kecamatan_id') == $kec->id ? 'selected' : '' }}>PAC {{ Str::title($kec->nama) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Pilih Ranting --}}
                                <div id="wrapper_pr" class="hidden space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pilih Ranting</label>
                                    <select id="unit_desa" name="unit_desa_id" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm">
                                        <option value="" selected disabled>Pilih PAC Dulu...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- PENDIDIKAN --}}
                        <div class="space-y-5">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-2 mb-4">
                                <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">5. Info Lain</h3>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pendidikan</label>
                                    <select name="last_education" class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm">
                                        <option value="SMA">SMA/Sederajat</option>
                                        <option value="S1">Sarjana (S1)</option>
                                        <option value="Pesantren">Pesantren</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block font-bold text-xs text-slate-700 ml-1">Pekerjaan</label>
                                    <input class="block w-full border-gray-200 rounded-xl py-3 px-4 text-sm" type="text" name="job_title" value="{{ old('job_title') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-100 flex justify-center mt-4">
                    <button type="submit" class="w-full sm:w-1/2 justify-center py-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg transition-all transform hover:-translate-y-1">
                        SIMPAN BIODATA SAYA
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        // Trigger toggle saat halaman load (untuk handling error validation redirect)
        document.addEventListener("DOMContentLoaded", function() {
            toggleSatuan();
        });

        function toggleSatuan() {
            const tingkatan = document.getElementById('tingkatan_organisasi').value;
            const wrapperPac = document.getElementById('wrapper_pac');
            const wrapperPr = document.getElementById('wrapper_pr');
            const selectPac = document.getElementById('unit_kecamatan');
            const selectPr = document.getElementById('unit_desa');

            wrapperPac.classList.add('hidden');
            wrapperPr.classList.add('hidden');
            
            // Jangan remove 'required' via JS secara agresif jika ingin backend validation bekerja
            // Tapi untuk UX, kita atur visibility dulu

            if (tingkatan === 'pac') {
                wrapperPac.classList.remove('hidden');
            } else if (tingkatan === 'pr') {
                wrapperPac.classList.remove('hidden');
                wrapperPr.classList.remove('hidden');
            }
        }

        async function fetchDesa(targetId, kecamatanId, isUnit = false) {
            if(!kecamatanId) return;
            const selectTarget = document.getElementById(targetId);
            selectTarget.innerHTML = '<option>Loading...</option>';
            try {
                const res = await fetch(`/desa/${kecamatanId}`); 
                const data = await res.json();
                selectTarget.innerHTML = isUnit 
                    ? '<option value="" selected disabled>Pilih Ranting (PR)...</option>' 
                    : '<option value="" selected disabled>Pilih Desa...</option>';
                data.forEach(d => {
                    let opt = document.createElement('option');
                    opt.value = d.id;
                    opt.text = isUnit ? `PR GP Ansor ${toTitleCase(d.nama)}` : toTitleCase(d.nama);
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