<?php

namespace App\Http\Controllers;

use App\Models\tesK;
use App\Models\tesP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class tesPK extends Controller
{
    public function buatPK(Request $req)
    {
        $val = Validator::make($req->all(), [
            'namapesan' => 'required',
            'idK' => 'required',
            'jumlah' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }

        $karcis = tesK::find($req->get('idK'));
        $karcis->stok -= $req->get('jumlah');
        $karcis->save();

        // $barang = tesK::find($req->idK);
        // $stok_sekarang = $barang->stok;
        // $stok_baru = $stok_sekarang - $req->jumlah;
        // $barang->update(['stok' => $stok_baru]); 

        $create = tesP::create([
            'namapesan' => $req->get('namapesan'),
            'idK' => $req->get('idK'),
            'jumlah' => $req->get('jumlah')


        ]);
        // tesK::kurangiStok($id_barang, $jumlah);
        if ($create) {

            return response()->json(['status' => true, 'message' => 'Sukses menambahkan pelanggan baru.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan pelanggan baru.']);
        }
    }
}
 

// property edit tiket 
  // $waktuMain = Date('H:i:s', strtotime('15:00:00'));
        // $tanggal = Carbon::parse('2023-06-08'); 
        // $tanggal = Carbon::now()->toDateString();