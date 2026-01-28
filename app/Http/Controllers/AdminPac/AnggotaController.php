<?php

namespace App\Http\Controllers\AdminPac;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\OrganisasiUnit;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $unitId = Auth::user()->organisasi_unit_id;
        $unitIds = OrganisasiUnit::where('parent_id', $unitId)->pluck('id')->push($unitId);

        $query = Anggota::with(['organisasiUnit', 'jabatan'])->whereIn('organisasi_unit_id', $unitIds);

        if ($request->search) {
            $query->where('nama', 'like', "%{$request->search}%")->orWhere('nik', 'like', "%{$request->search}%");
        }

        $anggotas = $query->latest()->paginate(10)->withQueryString();
        return view('admin_pac.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        $unitId = Auth::user()->organisasi_unit_id;
        $rantings = OrganisasiUnit::where('parent_id', $unitId)->get();
        $jabatans = Jabatan::whereIn('level_akses', ['pac', 'pr', 'all'])->get();
        
        return view('admin_pac.anggota.create', compact('rantings', 'jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:anggotas,nik',
            'email' => 'required|email|unique:users,email',
            'organisasi_unit_id' => 'required',
            'jabatan_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make('ansor123'),
                'role' => 'anggota',
                'organisasi_unit_id' => $request->organisasi_unit_id,
            ]);

            Anggota::create($request->all() + ['user_id' => $user->id]);
        });

        return redirect()->route('admin_pac.anggota.index')->with('success', 'Kader baru berhasil didaftarkan.');
    }

    public function edit(Anggota $anggota)
    {
        $unitId = Auth::user()->organisasi_unit_id;
        $rantings = OrganisasiUnit::where('parent_id', $unitId)->get();
        $jabatans = Jabatan::whereIn('level_akses', ['pac', 'pr', 'all'])->get();
        
        return view('admin_pac.anggota.edit', compact('anggota', 'rantings', 'jabatans'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|numeric|digits:16|unique:anggotas,nik,' . $anggota->id,
        ]);

        $anggota->update($request->all());
        $anggota->user->update(['nama' => $request->nama]);

        return redirect()->route('admin_pac.anggota.index')->with('success', 'Data kader diperbarui.');
    }
}