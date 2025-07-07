<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles'; // Nama tabel

    protected $primaryKey = 'id_review'; // Primary key khusus

    public $incrementing = true; // Karena pakai increments di migration

    protected $keyType = 'int'; // Tipe data PK

    protected $fillable = [
        'judul_artikel',
        'tanggal_artikel',
        'waktu_artikel',
        'operator_id',
        'konten_artikel',
        'gambar_cover',
        'status',
    ];

    // Jika ingin relasi ke model User (jika sudah ada)
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id_user');
    }
}
