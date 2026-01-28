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
        // 1. Bersihkan data lama
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

            // Email prefix: pac_id_1@ansor.com
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

                // Email prefix: pr_id_1@ansor.com
                $emailPrefixPr = 'pr_' . $desa->id . '_';
                $this->createMembers($pr, $emailPrefixPr, 'admin_pr', $password);
            }
        }
    }

    /**
     * Helper Function: 1 Admin + 4 Anggota Biasa per Unit
     */
    private function createMembers($unit, $emailPrefix, $adminRole, $password)
    {
        for ($i = 1; $i <= 5; $i++) {
            // LOGIKA UTAMA:
            // Jika $i == 1, maka dia ADMIN dan KETUA.
            // Jika $i > 1, maka dia ANGGOTA BIASA.
            
            $isLeader = ($i == 1);
            
            // Tentukan Role User
            $currentRole = $isLeader ? $adminRole : 'anggota';

            // Tentukan Jabatan ID (Asumsi ID 1 = Ketua, ID 10 = Anggota)
            // Pastikan ID ini sesuai dengan database MasterDataSeeder Sahabat
            $jabatanId = $isLeader ? 1 : 10; 

            // Buat Akun User
            $user = User::create([
                'nama' => ($isLeader ? "Ketua " : "Anggota $i ") . $unit->nama,
                'email' => $emailPrefix . $i . "@ansor.com",
                'password' => $password,
                'organisasi_unit_id' => $unit->id,
                'role' => $currentRole, 
                'is_active' => true,
            ]);

            // Generate NIK unik
            $nikRandom = $this->generateUniqueNik();

            // Buat Profil Anggota
            Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => $jabatanId,
                'nik' => $nikRandom,
                'nama' => $user->nama,
                'kelamin' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Helper simpel untuk generate NIK 16 digit
     */
    private function generateUniqueNik()
    {
        return str_pad(mt_rand(1, 9999999999999999), 16, '0', STR_PAD_LEFT);
    }
}