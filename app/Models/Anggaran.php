<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggarans';
    protected $primaryKey = 'anggaran_id';
    
    protected $fillable = [
        'user_id',
        'kategori_id',
        'jumlah_anggaran',
        'periode',
        'status',
    ];

    protected $casts = [
        'jumlah_anggaran' => 'decimal:2',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

}
