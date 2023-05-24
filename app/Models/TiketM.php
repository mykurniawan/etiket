<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketM extends Model
{
    use HasFactory;
    protected $table = 'tiket';
    // protected $primarykey = 'id';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        // 'id',
        'namaTiket',
        'jenisTiket',
        'harga',
        'tempat',
        'waktuPertandingan',
        'tgl',
        'stok'
    ];
}


