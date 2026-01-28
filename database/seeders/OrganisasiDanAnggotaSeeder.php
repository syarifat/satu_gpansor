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
        // 1. Bersihkan data lama dengan mematikan foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Anggota::truncate();
        OrganisasiUnit::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $password = Hash::make('password');

        // 2. BUAT UNIT PC (Pusat Cabang)
        $pc = OrganisasiUnit::create([
            'nama' => 'PC GP Ansor Tulungagung',
            'level' => 'pc',
        ]);
        
        // Email prefix: pc_1@ansor.com
        $this->createMembers($pc, 'pc_', 'admin_pc', $password);

        // 3. AMBIL SEMUA KECAMATAN UNTUK BUAT PAC
        $kecamatans = Kecamatan::all();

        foreach ($kecamatans as $kec) {
            $pac = OrganisasiUnit::create([
                'nama' => 'PAC GP Ansor ' . $kec->nama,
                'level' => 'pac',
                'parent_id' => $pc->id,
                'kecamatan_id' => $kec->id,
            ]);

            // Gunakan ID Kecamatan agar email 100% unik
            // Contoh: pac_350401_1@ansor.com
            $emailPrefixPac = 'pac_' . $kec->id . '_';
            $this->createMembers($pac, $emailPrefixPac, 'admin_pac', $password);

            // 4. BUAT PR (Pimpinan Ranting) DI SETIAP PAC
            $desas = Desa::where('kecamatan_id', $kec->id)->get();

            foreach ($desas as $desa) {
                $pr = OrganisasiUnit::create([
                    'nama' => 'PR GP Ansor ' . $desa->nama,
                    'level' => 'pr',
                    'parent_id' => $pac->id,
                    'kecamatan_id' => $kec->id,
                    'desa_id' => $desa->id,
                ]);

                // Gunakan ID Desa agar email unik (menghindari duplikat nama desa seperti Kauman/Wates)
                // Contoh: pr_3504012001_1@ansor.com
                $emailPrefixPr = 'pr_' . $desa->id . '_';
                $this->createMembers($pr, $emailPrefixPr, 'admin_pr', $password);
            }
        }
    }

    /**
     * Helper Function untuk membuat 5 anggota per unit
     * Otomatis membuat User (untuk Login) dan Profil Anggota
     */
    private function createMembers($unit, $emailPrefix, $role, $password)
    {
        for ($i = 1; $i <= 5; $i++) {
            // Buat Akun User
            $user = User::create([
                'nama' => "Pengurus $i " . $unit->nama,
                'email' => $emailPrefix . $i . "@ansor.com",
                'password' => $password,
                'organisasi_unit_id' => $unit->id,
                'role' => $role, // Role: admin_pc, admin_pac, atau admin_pr
                'is_active' => true,
            ]);

            // Generate NIK 16 digit yang unik
            $nikRandom = substr(str_shuffle("12345678901234567890"), 0, 16);

            // Buat Profil Anggota
            Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => ($i == 1) ? 1 : 10, // ID 1 = Ketua, ID 10 = Anggota (Sesuai MasterDataSeeder)
                'nik' => $nikRandom,
                'nama' => $user->nama,
                'kelamin' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}