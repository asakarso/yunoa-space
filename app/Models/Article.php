<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'id_review';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul_artikel',
        'tanggal_artikel',
        'waktu_artikel',
        'operator_id',
        'konten_artikel',
        'gambar_cover',
        'status',
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id_user');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }
}
