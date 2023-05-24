<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tesK extends Model
{
    use HasFactory;
    protected $table = 'karcis';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'stok'
    ];

    public static function kurangiStok($id, $jumlah)
{
    tesK::where('id', $id)->decrement('stok', $jumlah);
}

    // public function decrementStock($quantity)
    // {
    //     $this->stok -= $quantity;
    //     $this->save();
    // }
}
