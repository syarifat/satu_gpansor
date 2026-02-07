<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama', 
        'email', 
        'password', 
        'organisasi_unit_id', 
        'role', 
        'is_active',
        'google_id', // TAMBAHAN BARU
        'avatar',    // TAMBAHAN BARU
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // --- RELASI ---

    public function organisasiUnit()
    {
        return $this->belongsTo(OrganisasiUnit::class);
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }

    // --- HELPER ROLE ---

    // Cek apakah user adalah Admin PC
    public function isAdminPc() {
        return $this->role === 'admin_pc';
    }

    // Cek apakah user adalah Admin PAC
    public function isAdminPac() {
        return $this->role === 'admin_pac';
    }

    // Cek apakah user adalah Admin PR
    public function isAdminPr() {
        return $this->role === 'admin_pr';
    }
}