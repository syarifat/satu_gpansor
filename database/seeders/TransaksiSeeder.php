<?php

namespace Database\Seeders;

use App\Models\Surat;
use App\Models\Agenda;
use App\Models\User;
use App\Models\OrganisasiUnit;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil contoh User untuk simulasi
        $adminPc = User::where('role', 'admin_pc')->first();
        $adminPacBoyolangu = User::where('email', 'like', 'pac_boyolangu1%')->first();
        
        if (!$adminPacBoyolangu) return;

        // --- AGENDA (2 Agenda) ---
        Agenda::create([
            'organisasi_unit_id' => $adminPacBoyolangu->organisasi_unit_id,
            'nama' => 'Diklatsar Banser Angkatan X',
            'deskripsi' => 'Pelatihan fisik dan mental Banser di Boyolangu',
            'tanggal_mulai' => now()->addDays(10),
            'lokasi' => 'Lapangan Desa Beji',
            'status' => 'diterima',
        ]);

        Agenda::create([
            'organisasi_unit_id' => $adminPacBoyolangu->organisasi_unit_id,
            'nama' => 'Rijalul Ansor Kec. Boyolangu',
            'deskripsi' => 'Sholawatan rutin',
            'tanggal_mulai' => now()->addDays(5),
            'lokasi' => 'Mushola PAC',
            'status' => 'permintaan',
        ]);

        // --- SURAT MASUK (3 Surat) ---
        // Diasumsikan masuk ke PC dari luar
        for ($i = 1; $i <= 3; $i++) {
            Surat::create([
                'organisasi_unit_id' => $adminPc->organisasi_unit_id,
                'index_surat_id' => 1,
                'nomor_surat' => "0$i/EXT/PW/2026",
                'perihal' => "Instruksi Organisasi ke-$i",
                'jenis_surat' => 'masuk',
                'pengirim' => 'PW Ansor Jawa Timur',
                'tanggal_surat' => now(),
                'status' => 'diterima',
            ]);
        }

        // --- SURAT KELUAR (2 Surat) ---
        // 1. Surat Keluar PAC Boyolangu yang sudah DITERIMA PC
        Surat::create([
            'organisasi_unit_id' => $adminPacBoyolangu->organisasi_unit_id,
            'index_surat_id' => 1,
            'nomor_surat' => "01/PAC-BYL/I/2026",
            'perihal' => 'Pengajuan SK Pengurus PAC',
            'jenis_surat' => 'keluar',
            'penerima' => 'PC GP Ansor Tulungagung',
            'tanggal_surat' => now(),
            'status' => 'diterima',
            'diterima_oleh' => $adminPc->id,
            'dibuat_oleh' => $adminPacBoyolangu->id,
        ]);

        // 2. Surat Keluar PAC Boyolangu yang masih PENDING
        Surat::create([
            'organisasi_unit_id' => $adminPacBoyolangu->organisasi_unit_id,
            'index_surat_id' => 2,
            'nomor_surat' => "02/PAC-BYL/I/2026",
            'perihal' => 'Permohonan Narasumber PKD',
            'jenis_surat' => 'keluar',
            'penerima' => 'Ketua PC Tulungagung',
            'tanggal_surat' => now(),
            'status' => 'pending',
            'dibuat_oleh' => $adminPacBoyolangu->id,
        ]);
    }
}