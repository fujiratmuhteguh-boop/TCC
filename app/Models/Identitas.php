<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;

    protected $table = 'identitas';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'email',
    ];

    public function user()
    {
        // Menghubungkan identitas ke user berdasarkan email
        return $this->hasOne(User::class, 'email', 'email');
    }
}
