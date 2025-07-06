<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'profiles'; 

    /**
     * Primary key untuk model ini.
     * Hapus atau sesuaikan baris ini jika primary key Anda bukan 'id_profile'.
     *
     * @var string
     */
    protected $primaryKey = 'id_profile';

    /**
     * Menunjukkan apakah model harus memiliki timestamps (created_at dan updated_at).
     * Set menjadi 'false' jika tabel Anda tidak memiliki kolom-kolom ini.
     *
     * @var bool
     */
    public $timestamps = false; // Asumsi tabel profiles tidak memiliki timestamps

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user', 
        'specialization', 
        'schedule', 
        'consultation_price'
    ];

    /**
     * Atribut yang harus di-casting ke tipe data tertentu.
     * Sangat direkomendasikan untuk kolom harga.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'consultation_price' => 'decimal:2', // Meng-casting harga menjadi desimal dengan 2 angka di belakang koma
    ];

    /**
     * Mendefinisikan relasi balik ke model User.
     * Ini menyatakan bahwa "satu profil ini dimiliki oleh satu user".
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}