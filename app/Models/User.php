<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 
        'organisasi_unit_id', 'role', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
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