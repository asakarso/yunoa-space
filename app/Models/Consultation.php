<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Consultation extends Model
{
    protected $table = 'consultations';

    protected $primaryKey = 'id_konsul';

    // Set timestamps to false jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    protected $fillable = [
        'id_konsul',
        'id_user',
        'id_dokter',
        'tanggal_konsultasi',
        'jam_mulai',
        'jam_selesai',
        'status',
        'laporan_hasil'
    ];

    // Akses custom untuk format tanggal
    public function getTanggalKonsultasiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_konsultasi)->format('d M Y');
    }

    // Relasi ke model Review
    public function review()
    {
        return $this->hasOne(Review::class, 'id_konsul', 'id_konsul');
    }

    // Relasi ke dokter (User)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id_user');
    }

    // Relasi ke user (pasien)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
