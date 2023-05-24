<?php

namespace App\Http\Controllers;

use App\Models\PelangganM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganC extends Controller
{
    // ambil semua data 
    public function getPelanggan()
    {
        $dataPelanggan = PelangganM::get();
        return response()->json($dataPelanggan);
    }

    //ambil berdasarkan idnya
    public function getIdPelanggan($id)
    {
        $dataId = PelangganM::where('idPelanggan', '=', $id)->get();
        return response()->json($dataId);
    }

    // create data 
    public function creatPelanggan(Request $req)
    {
        $val = Validator::make($req->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'noTelpon' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $create = PelangganM::create([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'email' => $req->email,
            'noTelpon' => $req->noTelpon,
            'username' => $req->username,
            'password' => $req->password
        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan pelanggan baru.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan pelanggan baru.']);
        }
    }

    // update 
    public function editPelanggan(Request $req, $id)
    {
        $val = Validator::make($req->all(), [
            'nama' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        $update = PelangganM::where('idPelanggan', '=', $id)->update([
            'nama' => $req->get('nama'),
            'alamat' => $req->get('alamat'),
            'email' => $req->get('email'),
            'noTelpon' => $req->get('noTelpon'),
            'username' => $req->get('username'),
            'password' => $req->get('password'),
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses update data pelanggan !']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal update data pelanggan !']);
        }
    }

    // delete 
    public function delPelanggan($id)
    {
        $del = PelangganM::where('idPelanggan', $id)->delete();
        if ($del) {
            return response()->json(['status' => true, 'message' => 'Sukses hapus data pelanggan !.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal hapus data pelanggan !.']);
        }
    }
}
