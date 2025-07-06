<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'specialization',
        'schedule',
        'consultation_price',
    ];

    /**
     * Mendapatkan data user yang memiliki profil dokter ini.
     * relasi inverse dari One-to-One (belongsTo).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}