<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';
    protected $primaryKey = 'id_konsul';
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

    // === FUNGSI BARU YANG DITAMBAHKAN ===
    
    /**
     * Mendefinisikan relasi ke model User (sebagai pasien).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Mendefinisikan relasi ke model User (sebagai dokter).
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id_user');
    }
}