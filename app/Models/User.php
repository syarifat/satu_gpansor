<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Jika pakai API

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 
        'organisasi_unit_id', 'role', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi
    public function organisasiUnit()
    {
        return $this->belongsTo(OrganisasiUnit::class);
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }
}