<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {
        $kategories = Kategori::all();
        return ResponseHelper::jsonResponse(true, 'Data kategori berhasil diambil', $kategories, 200);
    }

    public function store(Request $request) {
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->tipe_kategori = $request->tipe_kategori;
        $kategori->save();
        return ResponseHelper::jsonResponse(true, 'Kategori berhasil ditambahkan', $kategori, 201);
    }

    public function show(string $id) {
        $kategori = Kategori::find($id);
        if($kategori) {
            return ResponseHelper::jsonResponse(true, 'Data kategori berhasil diambil', $kategori, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data kategori tidak ditemukan', null, 404);
        }
    }

    public function update(Request $request, string $id) {
        $kategori = Kategori::find($id);
        if($kategori) {
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->tipe_kategori = $request->tipe_kategori;
            $kategori->save();
            return ResponseHelper::jsonResponse(true, 'Kategori berhasil diupdate', $kategori, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data kategori tidak ditemukan', null, 404);
        }
    }

    public function destroy(string $id) {
        $kategori = Kategori::find($id);
        if($kategori) {
            $kategori->delete();
            return ResponseHelper::jsonResponse(true, 'Kategori berhasil dihapus', null, 200);
        } else {
            return ResponseHelper::jsonResponse(false, 'Data kategori tidak ditemukan', null, 404);
        }
    }
}
