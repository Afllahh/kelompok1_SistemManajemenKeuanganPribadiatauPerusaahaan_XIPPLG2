<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index() {
        $anggarans = Anggaran::all();
        return ResponseHelper::jsonResponse(true, 'Data anggaran berhasil diambil', $anggarans, 200);
    }

    public function store(Request $request) {
        $anggaran = new Anggaran();
        $anggaran->user_id = $request->user_id;
        $anggaran->kategori_id = $request->kategori_id;
        $anggaran->jumlah_anggaran = $request->jumlah_anggaran;
        $anggaran->periode = $request->periode;
        $anggaran->status = $request->status ?? 'tidak tercapai';
        $anggaran->save();
        
        return ResponseHelper::jsonResponse(true, 'Anggaran berhasil ditambahkan', $anggaran, 201);
    }

    public function show(string $id) {
        $anggaran = Anggaran::find($id);
        if($anggaran) {
            return ResponseHelper::jsonResponse(true, 'Data anggaran berhasil diambil', $anggaran, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data anggaran tidak ditemukan', null, 404);
        }
    }

    public function update(Request $request, string $id) {
        $anggaran = Anggaran::find($id);
        if($anggaran) {
            $anggaran->user_id = $request->user_id ?? $anggaran->user_id;
            $anggaran->kategori_id = $request->kategori_id ?? $anggaran->kategori_id;
            $anggaran->jumlah_anggaran = $request->jumlah_anggaran ?? $anggaran->jumlah_anggaran;
            $anggaran->periode = $request->periode ?? $anggaran->periode;
            $anggaran->status = $request->status ?? $anggaran->status;
            $anggaran->save();
            
            return ResponseHelper::jsonResponse(true, 'Anggaran berhasil diupdate', $anggaran, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data anggaran tidak ditemukan', null, 404);
        }
    }

    public function destroy(string $id) {
        $anggaran = Anggaran::find($id);
        if($anggaran) {
            $anggaran->delete();
            return ResponseHelper::jsonResponse(true, 'Anggaran berhasil dihapus', null, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data anggaran tidak ditemukan', null, 404);
        }
    }
}