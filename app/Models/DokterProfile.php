<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokterProfile extends Model
{
    protected $fillable = [
        'user_id', 'tanggal_lahir', 'jenis_kelamin',
        'pengalaman', 'jumlah_konseling', 'no_hp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
