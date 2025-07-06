<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id_review'; // Sesuai dengan migrasi Anda
    protected $fillable = [
        'judul_artikel',
        'tanggal_artikel',
        'waktu_artikel',
        'operator_id',
        'konten_artikel',
        'gambar_cover',
    ];

    public function operator()
    {
        // Relasi ke user (operator)
        return $this->belongsTo(User::class, 'operator_id', 'id_user');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }
}
