<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Http\Resources\MatakuliahResource;
use Illuminate\Support\Facades\Validator;

class MatakuliahController extends Controller
{
    //TODO ( Praktikan Nomor Urut 5 )
    // Tambahkan fungsi index yang akan menampilkan List Data Matakuliah
    // dan fungsi show yang akan menampilkan Detail Data Mahasiswa yang dipilih
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Diambil', $matakuliah);
    }

    public function show($id)
    {
        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return new MatakuliahResource(false, 'Data Matakuliah Tidak Ditemukan', null);
        }
        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Diambil', $matakuliah);
    }

    //TODO ( Praktikan Nomor Urut 6 )
    // Tambahkan fungsi store yang akan menyimpan data MataKuliah baruurn new MatakuliahResource(true, 'Data Matakuliah Berhasil Ditambahkan!', $matakuliah)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|unique:mata_kuliahs,kode',
            'nama' => 'required|string',
            'sks' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah = MataKuliah::create($request->all());
        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Ditambahkan!', $matakuliah);
    }

    //TODO ( Praktikan Nomor Urut 7 )
    // Tambahkan fungsi update yang mengubah data MataKuliah yang dipilih
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'string|unique:mata_kuliahs,kode,' . $id,
            'nama' => 'string',
            'sks' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return new MatakuliahResource(false, 'Data Matakuliah Tidak Ditemukan', null);
        }

        $matakuliah->update($request->only(['kode', 'nama', 'sks']));
        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Diubah!', $matakuliah);
    }

    //TODO ( Praktikan Nomor Urut 8 )
    // Tambahkan fungsi destroy yang akan menghapus data MataKuliah yang dipilih
    public function destroy($id)
    {
        $matakuliah = MataKuliah::find($id);
        if (!$matakuliah) {
            return new MatakuliahResource(false, 'Data Matakuliah Tidak Ditemukan', null);
        }

        $matakuliah->delete();
        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Dihapus!', null);
    }
}

