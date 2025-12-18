<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Gabungkan semua field di sini, jangan ada $fillable lain di bawahnya
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Cukup satu deklarasi di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function absensis() {
        return $this->hasMany(Absensi::class);
    }
}