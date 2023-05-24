<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeBayarM extends Model
{
    use HasFactory;
    protected $table = 'metodeBayar';
    protected $primarykey = 'idMetodeBayar';
    public $timestamps = false;
    protected $fillable = [
        'idMetodeBayar',
        'jenis',
    ];
}
