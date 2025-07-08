<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'amount',
        'method',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function doctor()
    {
        // relasi ke Doctor model
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
