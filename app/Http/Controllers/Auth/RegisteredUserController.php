<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use App\Models\OrganisasiUnit;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik' => ['required', 'digits:16', 'unique:anggotas,nik'],
            'nia' => ['nullable', 'string', 'max:50'], // VALIDASI NIA
            
            // Satuan Organisasi Logic
            'tingkatan_organisasi' => ['required', 'in:pac,pr'],
            'unit_kecamatan_id' => ['required', 'exists:kecamatans,id'],
            'unit_desa_id' => ['required_if:tingkatan_organisasi,pr', 'nullable', 'exists:desas,id'],
            
            // Pekerjaan (Opsional)
            'job_title' => ['nullable', 'string'],
            'job_address' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($request) {
            
            // 1. UNIT ORGANISASI
            $unit = null;
            $nama_unit_otomatis = "";

            if ($request->tingkatan_organisasi === 'pr') {
                $desa = Desa::find($request->unit_desa_id);
                $nama_unit_otomatis = "PR GP Ansor " . Str::title($desa->nama);
                
                $unit = OrganisasiUnit::firstOrCreate(
                    ['desa_id' => $request->unit_desa_id, 'level' => 'pr'],
                    ['nama' => $nama_unit_otomatis, 'kecamatan_id' => $request->unit_kecamatan_id]
                );
            } else {
                $kecamatan = Kecamatan::find($request->unit_kecamatan_id);
                $nama_unit_otomatis = "PAC GP Ansor " . Str::title($kecamatan->nama);

                $unit = OrganisasiUnit::firstOrCreate(
                    ['kecamatan_id' => $request->unit_kecamatan_id, 'level' => 'pac', 'desa_id' => null],
                    ['nama' => $nama_unit_otomatis]
                );
            }

            // 2. SIMPAN USER
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'anggota',
                'is_active' => true,
                'organisasi_unit_id' => $unit->id,
            ]);

            // 3. SIMPAN ANGGOTA
            Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => 10,
                'nik' => $request->nik,
                'nia_ansor' => $request->nia, // SIMPAN NIA DISINI
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelamin' => $request->kelamin,
                'status_kawin' => $request->status_kawin,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
                'kecamatan_id' => $request->kecamatan_id, 
                'desa_id' => $request->desa_id,           
                'last_education' => $request->last_education,
                'job_title' => $request->job_title,
                'job_address' => $request->job_address,
                'status' => 'pending',
            ]);

            event(new Registered($user));
            Auth::login($user);
        });

        return redirect(route('dashboard', absolute: false));
    }
}