<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Tambahkan properti ini untuk menangani detail bank saat verifikasi
    protected $fillable = [
        'user_id',
        'doctor_id',
        'amount',
        'method',
        'status',
        'payment_detail', // Tambahkan ini
    ];

    public function user()
    {
        // Asumsi foreign key adalah 'user_id' dan primary key di users adalah 'id_user'
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function doctor()
    {
        // INI BAGIAN YANG DIPERBAIKI: Mengarah ke User::class bukan Doctor::class
        // Asumsi foreign key adalah 'doctor_id' dan primary key di users adalah 'id_user'
        return $this->belongsTo(User::class, 'doctor_id', 'id_user');
    }
}