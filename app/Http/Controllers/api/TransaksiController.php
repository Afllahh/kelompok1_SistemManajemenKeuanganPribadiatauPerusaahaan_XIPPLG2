<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() {
        $transaksis = Transaksi::all();
        return ResponseHelper::jsonResponse(true, 'Data transaksi berhasil diambil', $transaksis, 200);
    }

    public function store(Request $request) {
        $transaksi = new Transaksi();
        $transaksi->user_id = $request->user_id;
        $transaksi->kategori_id = $request->kategori_id;
        $transaksi->jenis_transaksi = $request->jenis_transaksi;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->deskripsi = $request->deskripsi;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();
        
        return ResponseHelper::jsonResponse(true, 'Transaksi berhasil ditambahkan', $transaksi, 201);
    }

    public function show(string $id) {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            return ResponseHelper::jsonResponse(true, 'Data transaksi berhasil diambil', $transaksi, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data transaksi tidak ditemukan', null, 404);
        }
    }

    public function update(Request $request, string $id) {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            $transaksi->user_id = $request->user_id;
            $transaksi->kategori_id = $request->kategori_id;
            $transaksi->jenis_transaksi = $request->jenis_transaksi;
            $transaksi->jumlah = $request->jumlah;
            $transaksi->deskripsi = $request->deskripsi;
            $transaksi->tanggal = $request->tanggal;
            $transaksi->save();
            
            return ResponseHelper::jsonResponse(true, 'Transaksi berhasil diupdate', $transaksi, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data transaksi tidak ditemukan', null, 404);
        }
    }

    public function destroy(string $id) {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            $transaksi->delete();
            return ResponseHelper::jsonResponse(true, 'Transaksi berhasil dihapus', null, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data transaksi tidak ditemukan', null, 404);
        }
    }
}