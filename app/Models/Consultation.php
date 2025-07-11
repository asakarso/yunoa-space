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
        'id_payment',
        'tanggal_konsultasi',
        'jam_mulai',
        'jam_selesai',
        'status',
        'laporan_hasil'
    ];

    public function getTanggalKonsultasiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_konsultasi)->format('d M Y');
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

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment', 'id');
    }
    
    public function pesan_terakhir()
{
    return $this->hasOne(Pesan::class, 'id_konsultasi', 'id_konsul')->latestOfMany();
}

    public function pesans()
{
    return $this->hasMany(\App\Models\Pesan::class, 'id_konsultasi', 'id_konsul')->orderBy('created_at');
}

}