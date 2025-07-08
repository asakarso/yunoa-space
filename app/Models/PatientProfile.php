<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'tanggal_lahir',
        'jenis_kelamin',
        'aktivitas_utama',
        'tujuan_menggunakan',
        'jam_tidur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
