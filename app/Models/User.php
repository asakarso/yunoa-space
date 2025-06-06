<?php

// namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var list<string>
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'role_id', // Relasi ke table roles
//         'verified', // Untuk dokter
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var list<string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//             'verified' => 'boolean', // Untuk dokter
//         ];
//     }

//     public function role()
//     {
//         return $this->belongsTo(Role::class);
//     }

//     public function dokterProfile()
//     {
//         return $this->hasOne(DokterProfile::class);
//     }

//     public function operatorProfile()
//     {
//         return $this->hasOne(OperatorProfile::class);
//     }


// }

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
    ];

    protected $hidden = [
        'pass_user',
    ];

    protected $casts = [
        'total_konseling' => 'integer',
    ];

    public function getAuthPassword()
    {
        return $this->pass_user;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'id_user', 'id_role');
    }
}