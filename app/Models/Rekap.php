<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;

    // Tentukan kolom primary key
    protected $primaryKey = 'id_rekap';

    // Nama tabel (jika berbeda dengan nama model, gunakan ini)
    protected $table = 'rekaps';

    // Menonaktifkan timestamps
    public $timestamps = false;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'rekap_selesai',
        'rekap_total',
        'total_target',
        'total_diterima',
        'tanggal_rekap',
        'id_tim',  // Foreign key yang merujuk ke tim
    ];

    // Relasi dengan model Tim (satu rekap berhubungan dengan satu tim)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan'); // Pastikan id_kegiatan adalah kolom foreign key yang sesuai
    }

    // Relasi dengan Tim
    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim'); // Pastikan id_tim adalah kolom foreign key yang sesuai
    }
}
