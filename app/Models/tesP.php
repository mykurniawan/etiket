<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tesP extends Model
{
    use HasFactory;
    protected $table = 'pesan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'namapesan',
        'idK',
        'jumlah'
    ];
}
