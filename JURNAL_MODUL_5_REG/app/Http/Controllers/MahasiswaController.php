<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    //TODO ( Praktikan Nomor Urut 1 )
    // Tambahkan fungsi index yang akan menampilkan List Data Mahasiswa
    // dan fungsi show yang akan menampilkan Detail Data Mahasiswa yang dipilih
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diambil', $mahasiswa);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return new MahasiswaResource(false, 'Data Mahasiswa Tidak Ditemukan', null);
        }
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diambil', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 2 )
    // Tambahkan fungsi store yang akan menyimpan data Mahasiswa baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::create($request->all());
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 3 )
    // Tambahkan fungsi update yang mengubah data Mahasiswa yang dipilih
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'string|unique:mahasiswas,nim,' . $id,
            'nama' => 'string',
            'alamat' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return new MahasiswaResource(false, 'Data Mahasiswa Tidak Ditemukan', null);
        }

        $mahasiswa->update($request->only(['nim', 'nama', 'alamat']));
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 4 )
    // Tambahkan fungsi destroy yang akan menghapus data Mahasiswa yang dipilih
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return new MahasiswaResource(false, 'Data Mahasiswa Tidak Ditemukan', null);
        }

        $mahasiswa->delete();
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}

