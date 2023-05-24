<?php

namespace App\Http\Controllers;

use DateTimeZone;
use App\Models\TiketM;
use App\Models\PesananM;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
// use Carbon\Carbon;


class PesananC extends Controller
{
    // ambil semua data 
    public function getPesanan()
    {
        $dataPesanan = PesananM::join('pelanggan', 'pelanggan.idPelanggan', '=', 'pesanan.idPelanggan')
            ->join('tiket', 'tiket.id', '=', 'pesanan.idTiket')
            ->join('metodeBayar', 'metodeBayar.idMetodebayar', '=', 'pesanan.idMetodeBayar')
            ->get();
        return Response()->json($dataPesanan);
    }

    //ambil berdasarkan idnya
    public function getIdPesanan($id)
    {
        $dataId = PesananM::where('idPesanan', '=', $id)
            ->join('pelanggan', 'pelanggan.idPelanggan', '=', 'pesanan.idPelanggan')
            ->join('tiket', 'tiket.id', '=', 'pesanan.idTiket')
            ->join('metodeBayar', 'metodeBayar.idMetodebayar', '=', 'pesanan.idMetodeBayar')
            ->get();
        return response()->json($dataId);
    }

    // create data 
    public function createPesanan(Request $req)
    {
        $val = Validator::make($req->all(), [
            'idPelanggan' => 'required',
            'idTiket' => 'required',
            'jumlahBeli' => 'required',
            'idMetodeBayar' => 'required',
            'statusPembayaran' => 'required',

        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }

        $tiket = TiketM::find($req->get('idTiket'));

        if ($tiket->stok == 0) {
            return response()->json(['status' => true, 'message' => 'Maaf tiket sudah habis !.']);
        } else if ($tiket->stok < $req->jumlahBeli) {
            return response()->json(['status' => true, 'message' => 'Jumlah tiket tidak mencukupi  !.']);
        } else {
            $tiket->stok -= $req->get('jumlahBeli');
            $tiket->save();
            $create = PesananM::create([
                'idPelanggan' => $req->idPelanggan,
                'idTiket' => $req->get('idTiket'),
                'jumlahBeli' => $req->get('jumlahBeli'),
                'totalBayar' => $tiket->harga * $req->get('jumlahBeli'),
                'idMetodeBayar' => $req->idMetodeBayar,
                // 'tglPembayaran' => $tanggal,
                'tglPembayaran' => $req->tglPembayaran,
                'statusPembayaran' => $req->statusPembayaran,
            ]);
            if ($create) {
                return response()->json(['status' => true, 'message' => 'Pesanan Sukses  !.']);
            } else {
                return response()->json(['status' => false, 'message' => 'Pesanan Gagal  !.']);
            }
        }
    }

    // edit status pembayaran 
    public function editStatusPembayaran(Request $req, $id)
    {

        $val = Validator::make($req->all(), [
            'statusPembayaran' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors()->toJson());
        }
        // $tanggal = Carbon::now()->locale('id_ID');
        $tanggal = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $update = PesananM::where('idPesanan', '=', $id)->update([
            'tglPembayaran' => $tanggal,
            'statusPembayaran' => $req->get('statusPembayaran'),
        ]);

        if ($update) {
            return Response()->json(['status' => true, 'message' => 'Sukses update status pembayaran !']);
        } else {
            return Response()->json(['status' => false, 'message' => 'Gagal update status pembayaran !']);
        }
    }
    // hapus pesanan 
    public function delPesanan($id)
    {
        $del = PesananM::where('idPesanan', $id)->delete();
        if ($del) {
            return response()->json(['status' => true, 'message' => 'Hapus Pesanan Sukses.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Hapus Pesanan Gagal']);
        }
    }
}
