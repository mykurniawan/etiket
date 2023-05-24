<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganM extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primarykey = 'idPelanggan';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'noTelpon',
        'username',
        'password'
    ];
    
}
