<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';
    
    protected $primaryKey = 'id_konsul';

    protected $fillable = ['id_konsul', 'id_user', 'id_dokter', 'tanggal_konsultasi', 'jam_mulai', 'jam_selesai', 'status', 'laporan_hasil'];

    public function getTanggalKonsultasiFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tanggal_konsultasi'])->format('d M Y');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'id_konsul', 'id_konsul');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
