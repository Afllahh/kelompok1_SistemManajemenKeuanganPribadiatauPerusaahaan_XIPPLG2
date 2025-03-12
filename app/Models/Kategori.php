<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama_kategori',
        'tipe_kategori',
    ];

     // Relasi dengan Transaksi
     public function transaksi()
     {
         return $this->hasMany(Transaksi::class, 'kategori_id', 'kategori_id');
     }
 
     // Relasi dengan Anggaran
     public function anggaran()
     {
         return $this->hasMany(Anggaran::class, 'kategori_id', 'kategori_id');
     }
}
