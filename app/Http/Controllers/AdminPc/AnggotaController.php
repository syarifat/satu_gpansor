<?php

namespace App\Http\Controllers\AdminPc;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\OrganisasiUnit;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::with(['user', 'organisasiUnit', 'jabatan']);

        // Filter Pencarian Nama/NIK
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                  ->orWhere('nik', 'like', "%{$request->search}%");
            });
        }

        // Filter Berdasarkan Unit (PAC/PR)
        if ($request->unit_id) {
            $query->where('organisasi_unit_id', $request->unit_id);
        }

        $anggotas = $query->latest()->paginate(10)->withQueryString();
        
        // Data untuk Dropdown Filter
        $pacs = OrganisasiUnit::where('level', 'pac')->orderBy('nama', 'asc')->get();

        return view('admin_pc.anggota.index', compact('anggotas', 'pacs'));
    }

    public function create()
    {
        $jabatans = Jabatan::whereIn('level_akses', ['pc', 'all'])->orderBy('nama', 'asc')->get();
        $units = OrganisasiUnit::orderBy('level', 'asc')->get();
        return view('admin_pc.anggota.create', compact('jabatans', 'units'));
    }

    public function show(Anggota $anggota)
    {
        return view('admin_pc.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        $jabatans = Jabatan::orderBy('nama', 'asc')->get();
        $units = OrganisasiUnit::orderBy('level', 'asc')->get();
        return view('admin_pc.anggota.edit', compact('anggota', 'jabatans', 'units'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:anggotas,nik,' . $anggota->id,
            'jabatan_id' => 'required|exists:jabatans,id',
            'organisasi_unit_id' => 'required|exists:organisasi_units,id',
            'kelamin' => 'required|in:L,P',
        ]);

        $anggota->update($request->all());

        // Update nama di tabel Users juga agar sinkron
        $anggota->user->update(['nama' => $request->nama]);

        return redirect()->route('admin_pc.anggota.index')
                        ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        // Hapus User-nya juga (Cascade)
        $user = $anggota->user;
        $anggota->delete();
        $user->delete();

        return redirect()->route('admin_pc.anggota.index')
                        ->with('success', 'Anggota dan akun login berhasil dihapus.');
    }
}