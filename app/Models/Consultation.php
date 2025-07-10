<?php

namespace App\Models;

use App\Models\Pesan;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Consultation extends Model
{
    protected $table = 'consultations';

    protected $primaryKey = 'id_konsul';

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

    /**
     * =================================================================
     * KODE YANG SALAH TELAH DIGANTI DENGAN YANG INI
     * =================================================================
     * Relasi ini "menjembatani" tabel consultations -> doctors -> users
     * untuk mendapatkan data User dari seorang dokter.
     */
    public function dokter()
    {
        return $this->hasOneThrough(
            User::class,    // Model tujuan yang ingin kita ambil datanya (User).
            Doctor::class,  // Model perantara yang harus dilewati (Doctor).
            'id',           // Foreign key di tabel perantara `doctors` (doctors.id).
            'id_user',      // Foreign key di tabel tujuan `users` (users.id_user).
            'id_dokter',    // Local key di tabel awal `consultations` (consultations.id_dokter).
            'user_id'       // Local key di tabel perantara `doctors` (doctors.user_id).
        );
    }

    // Relasi ke user (pasien) - Ini sudah benar
    public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}
    
    // Relasi ke pesan terakhir - Ini sudah benar
    public function pesan_terakhir()
{
    return $this->hasOne(Pesan::class, 'id_konsultasi', 'id_konsul')->latestOfMany();
}

    public function pesans()
{
    return $this->hasMany(\App\Models\Pesan::class, 'id_konsultasi', 'id_konsul')->orderBy('created_at');
}

}