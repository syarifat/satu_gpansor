<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\OrganisasiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Support\Facades\DB; // Import DB

class CompleteProfileController extends Controller
{
    public function create()
    {
        return view('auth.complete-profile');
    }

    public function store(Request $request)
    {
        // 1. LOGGING AWAL: Cek data apa yang dikirim user
        Log::info('Mulai Proses Complete Profile', $request->except('password', 'password_confirmation'));

        $user = Auth::user();

        // 2. VALIDASI
        try {
            $validated = $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'nik' => ['required', 'digits:16', 'unique:anggotas,nik'],
                'notelp' => ['required', 'numeric'],
                'alamat' => ['required', 'string'],
                'kecamatan_id' => ['required'], 
                'desa_id' => ['required'], 
                'tingkatan_organisasi' => ['required', 'in:pac,pr'],
                'kelamin' => ['required', 'in:L,P'], // Validasi tambahan
                'tempat_lahir' => ['required'],
                'tanggal_lahir' => ['required', 'date'],
                
                // Validasi kondisional
                'unit_kecamatan_id' => 'required_if:tingkatan_organisasi,pac',
                'unit_desa_id' => 'required_if:tingkatan_organisasi,pr',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log jika validasi gagal
            Log::error('Validasi Gagal:', $e->errors());
            throw $e; // Lempar kembali error ke view
        }

        DB::beginTransaction(); // Pakai Transaksi Database biar aman

        try {
            // 3. CARI UNIT ORGANISASI
            $unit = null;
            if ($request->tingkatan_organisasi === 'pac') {
                $unit = OrganisasiUnit::where('level', 'pac')
                            ->where('kecamatan_id', $request->unit_kecamatan_id)
                            ->first();
                Log::info("Mencari PAC dengan Kec ID: " . $request->unit_kecamatan_id);
            } else {
                $unit = OrganisasiUnit::where('level', 'pr')
                            ->where('desa_id', $request->unit_desa_id)
                            ->first();
                Log::info("Mencari PR dengan Desa ID: " . $request->unit_desa_id);
            }

            if (!$unit) {
                Log::error("Unit Organisasi tidak ditemukan di database.");
                return back()->withErrors(['tingkatan_organisasi' => 'Unit Organisasi belum terdaftar di database master.'])->withInput();
            }

            Log::info("Unit Ditemukan: ID " . $unit->id . " - " . $unit->nama);

            // 4. UPDATE USER
            $user->update([
                'password' => Hash::make($request->password),
                'organisasi_unit_id' => $unit->id,
                'is_active' => false,
            ]);

            // 5. SIMPAN ANGGOTA
            $anggota = Anggota::create([
                'user_id' => $user->id,
                'organisasi_unit_id' => $unit->id,
                'jabatan_id' => 10, // Pastikan ID 10 ada di tabel jabatans
                'nik' => $request->nik,
                'nia_ansor' => $request->nia,
                'nama' => $user->nama, // Ambil dari User (Google)
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
            ]);

            DB::commit(); // Simpan permanen jika sukses
            
            Log::info("Sukses menyimpan anggota ID: " . $anggota->id);

            Auth::logout();
            return redirect()->route('login')->with('status', 'Pendaftaran Berhasil! Silakan tunggu verifikasi Admin.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            Log::error("ERROR SYSTEM SAAT MENYIMPAN: " . $e->getMessage());
            
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }
}