<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:kependudukan',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }
}