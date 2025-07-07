<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'id_review';
    
    protected $fillable = ['id_review', 'id_user', 'id_dokter', 'id_konsul', 'tanggal_review', 'waktu_review', 'rating', 'deskripsi_review', 'created_at', 'updated_at'];

    public function konsultasi()
    {
        return $this->belongsTo(Consultation::class, 'id_konsul', 'id_konsul');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
