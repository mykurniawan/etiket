<?php

namespace App\Http\Controllers;

use App\Models\TiketM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TiketC extends Controller
{
    // ambil semua data 
    public function getTiket()
    {
        $dataTiket = TiketM::get();
        return response()->json($dataTiket);
    }

    //ambil berdasarkan idnya
    public function getIdTiket($id)
    {
        $dataId = TiketM::where('id', '=', $id)->get();
        return response()->json($dataId);
    }

    // create data 
    public function createTiket(Request $req)
    {
        $val = Validator::make($req->all(), [
            'namaTiket' => 'required',
            'jenisTiket' => 'required',
            'harga' => 'required',
            'tempat' => 'required',
           
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }

        $create = TiketM::create([
            'namaTiket' => $req->namaTiket,
            'jenisTiket' => $req->jenisTiket,
            'harga' => $req->harga,
            'tempat' => $req->tempat,
            'waktuPertandingan' => $req->waktuPertandingan,
            'tgl' =>$req->tgl,
            'stok' => $req->stok
        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses membuat tiket !.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal membuat tiket !.']);
        }
    }

    // edit tiket 
    public function editTiket(Request $req, $id)
    {
        $val = Validator::make($req->all(), [
            'namaTiket' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
      
        //edit tanggalnya disini 
        $update = TiketM::where('id', '=', $id)->update([
            'namaTiket' => $req->get('namaTiket'),
            'jenisTiket' => $req->get('jenisTiket'),
            'harga' => $req->get('harga'),
            'tempat' => $req->get('tempat'),
            'waktuPertandingan' => $req->get('waktuPertandingan'),
            'tgl' => $req->get('tgl'),
            'stok' => $req->get('stok')
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses update data Tiket !']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal update data Tiket !']);
        }
    }

    // hapus tiket 
    public function delTiket($id)
    {
        $del = TiketM::where('id', $id)->delete();
        if ($del) {
            return response()->json(['status' => true, 'message' => 'Sukses hapus Tiket !.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal hapus Tiket !.']);
        }
    }

}

