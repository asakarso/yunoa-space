<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user',
        'email_user',
        'pass_user',
        'nomor_telepon',
        'total_konseling',
        'foto_profil'
    ];

    protected $hidden = [ 'pass_user' ];
    protected $casts = [ 'total_konseling' => 'integer' ];

    public function getAuthPassword()
    {
        return $this->pass_user;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'id_user', 'id_role');
    }

    // === FUNGSI BARU YANG DITAMBAHKAN ===
    
    /**
     * Mendefinisikan relasi ke model Profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'id_user', 'id_user');
    }
}