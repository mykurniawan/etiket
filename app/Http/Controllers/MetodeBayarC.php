<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayarM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetodeBayarC extends Controller
{
    // ambil semua data 
    public function getMetodeBayar()
    {
        $dataTiket = MetodeBayarM::get();
        return response()->json($dataTiket);
    }

    //ambil berdasarkan idnya
    public function getIdMetodeBayar($id)
    {
        $dataId = MetodeBayarM::where('idMetodeBayar', '=', $id)->get();
        return response()->json($dataId);
    }

    // create data 
    public function createMetodeBayar(Request $req)
    {
        $val = Validator::make($req->all(), [
            'idMetodeBayar' => 'required',
            'jenis' => 'required',
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $create = MetodeBayarM::create([
            'idMetodeBayar' => $req->idMetodeBayar,
            'jenis' => $req->jenis
        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan metode pembayaran baru !.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan metode pembayaran baru !.']);
        }
    }

    // update 
    public function editMetodePembayaran(Request $req, $id)
    {
        $val = Validator::make($req->all(), [
            'jenis' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $update = MetodeBayarM::where('idMetodeBayar', '=', $id)->update([
            'jenis' => $req->get('jenis'),
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses update metode pembayaran !']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal update metode pembayaran !']);
        }
    }

    // delete 
    public function delMetodeBayar($id)
    {
        $del = MetodeBayarM::where('idMetodeBayar', $id)->delete();
        if ($del) {
            return response()->json(['status' => true, 'message' => 'Sukses hapus metode pembayaran !.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal hapus metode pembayaran !.']);
        }
    }
}
