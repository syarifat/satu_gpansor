<?php

namespace Database\Seeders;

use App\Models\OrganisasiUnit;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrganisasiDanAnggotaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Anggota::truncate();
        OrganisasiUnit::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $password = Hash::make('password');
        $now = now();

        // 1. BUAT PC (Pusat)
        $pc = OrganisasiUnit::create([
            'nama' => 'PC GP Ansor Tulungagung',
            'level' => 'pc',
        ]);
        $this->createMembers($pc, 'pc', 'admin_pc', $password);

        // 2. BUAT 19 PAC (Kecamatan)
        $kecamatans = Kecamatan::all();
        foreach ($kecamatans as $kec) {
            $pac = OrganisasiUnit::create([
                'nama' => 'PAC GP Ansor ' . $kec->nama,
                'level' => 'pac',
                'parent_id' => $pc->id,
                'kecamatan_id' => $kec->id,
            ]);
            $this->createMembers($pac, 'pac_' . strtolower(str_replace(' ', '', $kec->nama)), 'admin_pac', $password);

            // 3. BUAT PR (Desa) - Langsung di dalam Loop PAC agar parent_id sesuai
            $desas = Desa::where('kecamatan_id', $kec->id)->get();
            foreach ($desas as $desa) {
                $pr = OrganisasiUnit::create([
                    'nama' => 'PR GP Ansor ' . $desa->nama,
                    'level' => 'pr',
                    'parent_id' => $pac->id,
                    'kecamatan_id' => $kec->id,
                    'desa_id' => $desa->id,
                ]);
                $emailPrefix = 'pr_' . $desa->id . '_';
                $this->createMembers($pr, $emailPrefix, 'admin_pr', $password);
            }
        }
    }

    // Helper Function untuk membuat 5 anggota per unit
    private function createMembers($unit, $emailPrefix, $role, $password)
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'nama' => "Pengurus $i " . $unit->nama,
                'email' => $emailPrefix . $i . "@ansor.com", // Sekarang email jadi pr_3504012001_1@ansor.com
                'password' => $password,
                'organisasi_unit_id' => $unit->id,
                'role' => $role,
            ]);

            $nikRandom = substr(str_shuffle("12345678901234567890"), 0, 16);

            Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => ($i == 1) ? 1 : 10,
                'nik' => $nikRandom,
                'nama' => $user->nama,
                'kelamin' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}