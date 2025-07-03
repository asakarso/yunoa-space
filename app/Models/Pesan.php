<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = ['id_pengirim', 'id_penerima', 'pesan', 'created_at', 'updated_at', 'id_konsultasi'];

    public function pengirim() {
        return $this->belongsTo(User::class, 'id_pengirim');
    }

    public function penerima() {
        return $this->belongsTo(User::class, 'id_penerima');
    }

    public function consultation() {
        return $this->belongsTo(Consultation::class, 'id_konsul');
    }
}
