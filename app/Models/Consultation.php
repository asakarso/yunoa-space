<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';
    
    protected $primaryKey = 'id_konsul';

    protected $fillable = ['id_konsul', 'id_user', 'id_dokter', 'tanggal_konsultasi', 'jam_mulai', 'jam_selesai', 'status', 'laporan_hasil'];
}
