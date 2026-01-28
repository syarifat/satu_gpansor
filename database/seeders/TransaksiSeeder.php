<?php

namespace Database\Seeders;

use App\Models\Surat;
use App\Models\Agenda;
use App\Models\User;
use App\Models\OrganisasiUnit;
use App\Models\IndexSurat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Surat::truncate();
        Agenda::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil data referensi
        $adminPc = User::where('role', 'admin_pc')->first();
        $indexSk = IndexSurat::where('kode', 'A-I')->first() ?? IndexSurat::first();
        $indexUndangan = IndexSurat::where('kode', 'B-I')->first() ?? IndexSurat::first();
        
        $allUnits = OrganisasiUnit::all();

        $this->command->info('Memulai seeding transaksi untuk ' . $allUnits->count() . ' unit...');

        foreach ($allUnits as $unit) {
            // --- SEED AGENDA (2 Per Unit) ---
            Agenda::create([
                'organisasi_unit_id' => $unit->id,
                'nama' => 'Rapat Rutin ' . $unit->nama,
                'deskripsi' => 'Pembahasan program kerja bulanan',
                'tanggal_mulai' => now()->addDays(rand(1, 30)),
                'lokasi' => 'Kantor ' . $unit->nama,
                'status' => 'diterima',
            ]);

            Agenda::create([
                'organisasi_unit_id' => $unit->id,
                'nama' => 'Kaderisasi Angkatan I ' . $unit->nama,
                'deskripsi' => 'Pelatihan kepemimpinan tingkat dasar',
                'tanggal_mulai' => now()->addDays(rand(31, 60)),
                'lokasi' => 'Aula Serbaguna',
                'status' => 'permintaan', // Menunggu approval
            ]);

            // --- SEED SURAT (Hanya untuk PAC dan PR untuk di-approve PC) ---
            if ($unit->level !== 'pc') {
                // 1. Surat Keluar PENDING (Untuk dicoba di-approve PC)
                Surat::create([
                    'organisasi_unit_id' => $unit->id,
                    'index_surat_id' => $indexSk->id,
                    'nomor_surat' => '001/OUT/' . $unit->id . '/2026',
                    'perihal' => 'Permohonan Pengesahan SK ' . $unit->nama,
                    'jenis_surat' => 'keluar',
                    'penerima' => 'PC GP Ansor Tulungagung',
                    'tanggal_surat' => now(),
                    'status' => 'pending',
                    'dibuat_oleh' => User::where('organisasi_unit_id', $unit->id)->first()->id,
                ]);

                // 2. Surat Keluar DITERIMA
                Surat::create([
                    'organisasi_unit_id' => $unit->id,
                    'index_surat_id' => $indexUndangan->id,
                    'nomor_surat' => '002/OUT/' . $unit->id . '/2026',
                    'perihal' => 'Undangan Silaturahmi ' . $unit->nama,
                    'jenis_surat' => 'keluar',
                    'penerima' => 'Tokoh Masyarakat',
                    'tanggal_surat' => now()->subDays(5),
                    'status' => 'diterima',
                    'diterima_oleh' => $adminPc->id,
                    'dibuat_oleh' => User::where('organisasi_unit_id', $unit->id)->first()->id,
                ]);
            }
        }

        // --- KHUSUS PC: Surat Masuk (3 Surat sesuai request) ---
        for ($i = 1; $i <= 3; $i++) {
            Surat::create([
                'organisasi_unit_id' => $pcId = OrganisasiUnit::where('level', 'pc')->first()->id,
                'index_surat_id' => $indexSk->id,
                'nomor_surat' => "00$i/IN/PW/2026",
                'perihal' => "Instruksi PW Jawa Timur Ke-$i",
                'jenis_surat' => 'masuk',
                'pengirim' => 'PW GP Ansor Jawa Timur',
                'tanggal_surat' => now()->subDays($i),
                'status' => 'diterima',
            ]);
        }
    }
}