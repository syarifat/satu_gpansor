<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Profil Anggota</h2>
            <a href="{{ route('admin_pc.anggota.index') }}" class="text-xs font-black text-slate-400 hover:text-emerald-600 uppercase tracking-widest">&larr; Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-[3rem] border border-gray-100 overflow-hidden relative">
                <div class="h-32 bg-gradient-to-r from-emerald-600 to-indigo-700"></div>
                
                <div class="px-8 pb-12">
                    <div class="relative flex justify-between items-end -mt-16 mb-8">
                        <div class="p-2 bg-white rounded-[2rem] shadow-xl">
                            <div class="w-32 h-32 rounded-[1.8rem] bg-emerald-100 flex items-center justify-center text-4xl font-black text-emerald-700 border-4 border-white">
                                {{ substr($anggota->nama, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex gap-3 mb-4">
                            <a href="{{ route('admin_pc.anggota.edit', $anggota->id) }}" class="px-6 py-2.5 bg-orange-500 text-white rounded-xl text-xs font-bold shadow-lg hover:bg-orange-600 transition">Edit Profil</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-6">
                            <h4 class="text-xs font-black text-emerald-600 uppercase tracking-[0.2em] border-b pb-2">Informasi Pribadi</h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Nama Lengkap</p>
                                    <p class="text-lg font-black text-slate-800">{{ $anggota->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">NIK (KTP)</p>
                                    <p class="font-bold text-slate-700">{{ $anggota->nik }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Email Sistem</p>
                                    <p class="font-bold text-slate-600">{{ $anggota->user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em] border-b pb-2">Status Organisasi</h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Jabatan</p>
                                    <span class="inline-block mt-1 px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-black rounded-lg border border-indigo-100">
                                        {{ $anggota->jabatan->nama }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Penempatan Unit</p>
                                    <p class="font-black text-slate-800">{{ $anggota->organisasiUnit->nama }}</p>
                                    <p class="text-xs text-slate-500 italic">{{ strtoupper($anggota->organisasiUnit->level) }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">Terdaftar Sejak</p>
                                    <p class="font-bold text-slate-700">{{ $anggota->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>