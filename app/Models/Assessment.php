<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $primaryKey = 'id_assess';

    protected $fillable = [
        'id_user',
        'tanggal_assess',
        'waktu_assess',
        'jam_selesai',
        'skor_hasil'
    ];
}
