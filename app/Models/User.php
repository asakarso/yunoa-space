<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $rememberTokenName = null;

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

    public function getAuthPassword()
    {
        return $this->pass_user;
    }

    public function username()
    {
        return 'email_user';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'id_user', 'id_role');
    }
}
