<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangans';
    protected $primaryKey = 'laporan_id';

    protected $fillable = [
        'user_id',
        'total_pengeluaran',
        'total_pemasukan',
        'saldo_akhir',
        'bulan_tahun',
    ];

    protected $casts = [
        'total_pengeluaran' => 'decimal:2',
        'total_pemasukan' => 'decimal:2',
        'saldo_akhir' => 'decimal:2',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
