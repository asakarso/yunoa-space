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
        'nomor_telepon',
        'total_konseling',
        'foto_profil',
    ];

    protected $hidden = [
        'pass_user',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', 
    ];

    public function getAuthPassword()
    {
        return $this->pass_user;
    }

    /**
     * Mendefinisikan relasi Many-to-Many ke Role.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'id_user', 'id_role');
    }

    /**
     * Mendapatkan profil dokter yang terhubung dengan user ini.
     * relasi One-to-One (hasOne).
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id', 'id_user');
    }

    public function doctorProfile() {
    return $this->hasOne(Doctor::class, 'id_user', 'id_user');
}

    public function patientProfile()
    {
        // Gunakan hasOne jika satu user hanya punya satu profil
        return $this->hasOne(PatientProfile::class, 'id_user', 'id_user'); 
    }

}