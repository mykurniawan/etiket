<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananM extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primarykey = 'idPesanan';
    public $timestamps = false;
    protected $fillable = [
        // 'idPesanan',
        'idPelanggan',
        'idTiket',
        'jumlahBeli',
        // 'nominalBayar',
        'totalBayar',
        'idMetodeBayar',
        'tglPembayaran',
        'statusPembayaran',
        // 'jumlah'
    ];
}
