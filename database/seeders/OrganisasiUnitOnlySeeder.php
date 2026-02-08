<?php

namespace Database\Seeders;

use App\Models\OrganisasiUnit;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisasiUnitOnlySeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama unit organisasi
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        OrganisasiUnit::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // BUAT UNIT PC (Pusat Cabang)
        $pc = OrganisasiUnit::create([
            'nama' => 'PC GP Ansor Tulungagung',
            'level' => 'pc',
            'parent_id' => null,
            'kecamatan_id' => null,
            'desa_id' => null,
            'alamat_sekretariat' => 'Jl. KH. Abdul Fattah No. 12, Tulungagung',
            'email' => 'pc.tulungagung@ansor.or.id',
            'notelp' => '0355321000',
        ]);

        // BUAT PAC (Pimpinan Anak Cabang) per Kecamatan
        $kecamatans = Kecamatan::all();

        foreach ($kecamatans as $kec) {
            $pac = OrganisasiUnit::create([
                'nama' => 'PAC GP Ansor ' . $kec->nama,
                'level' => 'pac',
                'parent_id' => $pc->id,
                'kecamatan_id' => $kec->id,
                'desa_id' => null,
                'alamat_sekretariat' => 'Jl. Raya Kecamatan ' . $kec->nama . ' No. ' . rand(1, 50),
                'email' => 'pac.' . strtolower(str_replace(' ', '', $kec->nama)) . '@ansor.or.id',
                'notelp' => '0812' . rand(10000000, 99999999),
            ]);

            // BUAT PR (Pimpinan Ranting) per Desa
            $desas = Desa::where('kecamatan_id', $kec->id)->get();

            foreach ($desas as $desa) {
                OrganisasiUnit::create([
                    'nama' => 'PR GP Ansor ' . $desa->nama,
                    'level' => 'pr',
                    'parent_id' => $pac->id,
                    'kecamatan_id' => $kec->id,
                    'desa_id' => $desa->id,
                    'alamat_sekretariat' => 'Jl. Desa ' . $desa->nama . ' RT 01 RW 01',
                    'email' => 'pr.' . strtolower(str_replace(' ', '', $desa->nama)) . '@ansor.or.id',
                    'notelp' => '0857' . rand(10000000, 99999999),
                ]);
            }
        }

        $this->command->info('Unit Organisasi berhasil di-seed! (PC, PAC, PR)');
    }
}
