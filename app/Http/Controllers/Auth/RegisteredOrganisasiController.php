<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use App\Models\OrganisasiUnit;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredOrganisasiController extends Controller
{
    public function create(): View
    {
        $kecamatans = Kecamatan::orderBy('nama', 'asc')->get();
        return view('auth.register-organisasi', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Data Organisasi
            'tingkatan' => ['required', 'in:pac,pr'],
            'kecamatan_id' => ['required', 'exists:kecamatans,id'],
            'desa_id' => ['required_if:tingkatan,pr', 'nullable', 'exists:desas,id'],
            'alamat_sekretariat' => ['required', 'string'],
            'notelp_organisasi' => ['required', 'numeric'],
            
            // Data Admin/Ketua
            'nama_ketua' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class], // Email User & Org
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ($request) {
            
            // --- 1. SIAPKAN DATA UNIT ---
            $nama_unit = "";
            $parent_id = null; // Default null / ID 1 (PC)
            $desa_id = null;
            $role_user = "";

            // ID 1 diasumsikan sebagai Pimpinan Cabang (PC) / Root
            $pc_id = 1; 

            if ($request->tingkatan === 'pr') {
                // LOGIKA PR (RANTING)
                $desa = Desa::find($request->desa_id);
                $nama_unit = "PR GP Ansor " . Str::title($desa->nama);
                $desa_id = $request->desa_id;
                $role_user = 'admin_pr';

                // Cari Parent (PAC di Kecamatan ini)
                $parent = OrganisasiUnit::where('level', 'pac')
                            ->where('kecamatan_id', $request->kecamatan_id)
                            ->first();
                
                // Jika PAC ada, jadikan parent. Jika tidak, ikut PC (1)
                $parent_id = $parent ? $parent->id : $pc_id; 

            } else {
                // LOGIKA PAC (ANAK CABANG)
                $kecamatan = Kecamatan::find($request->kecamatan_id);
                $nama_unit = "PAC GP Ansor " . Str::title($kecamatan->nama);
                $desa_id = null;
                $role_user = 'admin_pac';
                
                // Parent PAC adalah PC
                $parent_id = $pc_id;
            }

            // --- 2. SIMPAN ORGANISASI UNIT (LENGKAP) ---
            // Gunakan updateOrCreate agar tidak duplikat jika unit sudah ada
            $unit = OrganisasiUnit::updateOrCreate(
                [
                    'level' => $request->tingkatan,
                    'kecamatan_id' => $request->kecamatan_id,
                    'desa_id' => $desa_id,
                ],
                [
                    'nama' => $nama_unit,
                    'parent_id' => $parent_id, // Terisi otomatis
                    'alamat_sekretariat' => $request->alamat_sekretariat,
                    'email' => $request->email, // Menggunakan email admin sebagai email org
                    'notelp' => $request->notelp_organisasi,
                ]
            );

            // --- 3. SIMPAN USER LOGIN ---
            $user = User::create([
                'nama' => $request->nama_ketua,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role_user,
                'is_active' => true,
                'organisasi_unit_id' => $unit->id,
            ]);

            // --- 4. SIMPAN PROFIL ANGGOTA (KETUA) ---
            Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => 1, // Ketua
                'nama' => $request->nama_ketua,
                'nik' => str_pad(mt_rand(1, 9999999999999999), 16, '0', STR_PAD_LEFT),
                'notelp' => $request->notelp_organisasi, // Pakai no telp org sementara
                'status' => 'aktif',
                // Alamat domisili dianggap sama dengan sekretariat sementara
                'alamat' => $request->alamat_sekretariat, 
                'kecamatan_id' => $request->kecamatan_id,
                'desa_id' => $desa_id,
            ]);

            Auth::login($user);
        });

        return redirect(route('dashboard', absolute: false));
    }
}