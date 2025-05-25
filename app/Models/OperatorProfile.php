<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatorProfile extends Model
{
    protected $fillable = ['user_id', 'biografi_penulis', 'artikel_terbit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
