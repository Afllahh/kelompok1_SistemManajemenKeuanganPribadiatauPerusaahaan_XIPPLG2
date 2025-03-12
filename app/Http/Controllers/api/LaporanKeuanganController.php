<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index() {
        $laporans = LaporanKeuangan::all();
        return ResponseHelper::jsonResponse(true, 'Data laporan keuangan berhasil diambil', $laporans, 200);
    }

    public function store(Request $request) {
        $laporan = new LaporanKeuangan();
        $laporan->user_id = $request->user_id;
        $laporan->total_pengeluaran = $request->total_pengeluaran;
        $laporan->total_pemasukan = $request->total_pemasukan;
        $laporan->saldo_akhir = $request->saldo_akhir;
        $laporan->bulan_tahun = $request->bulan_tahun;
        $laporan->save();
        
        return ResponseHelper::jsonResponse(true, 'Laporan keuangan berhasil ditambahkan', $laporan, 201);
    }

    public function show(string $id) {
        $laporan = LaporanKeuangan::find($id);
        if($laporan) {
            return ResponseHelper::jsonResponse(true, 'Data laporan keuangan berhasil diambil', $laporan, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data laporan keuangan tidak ditemukan', null, 404);
        }
    }

    public function update(Request $request, string $id) {
        $laporan = LaporanKeuangan::find($id);
        if($laporan) {
            $laporan->user_id = $request->user_id;
            $laporan->total_pengeluaran = $request->total_pengeluaran;
            $laporan->total_pemasukan = $request->total_pemasukan;
            $laporan->saldo_akhir = $request->saldo_akhir;
            $laporan->bulan_tahun = $request->bulan_tahun;
            $laporan->save();
            
            return ResponseHelper::jsonResponse(true, 'Laporan keuangan berhasil diupdate', $laporan, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data laporan keuangan tidak ditemukan', null, 404);
        }
    }

    public function destroy(string $id) {
        $laporan = LaporanKeuangan::find($id);
        if($laporan) {
            $laporan->delete();
            return ResponseHelper::jsonResponse(true, 'Laporan keuangan berhasil dihapus', null, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data laporan keuangan tidak ditemukan', null, 404);
        }
    }
}