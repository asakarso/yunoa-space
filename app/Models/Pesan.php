<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesans';
    protected $primaryKey = 'id'; // <- Sesuaikan dengan struktur tabel
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pengirim',
        'id_penerima',
        'id_konsultasi',
        'pesan'
    ];

    // Relasi ke pengirim (user)
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim', 'id_user');
    }

    // Relasi ke penerima (user)
    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima', 'id_user');
    }

    // Relasi ke konsultasi
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_konsultasi', 'id_konsul');
    }
}
