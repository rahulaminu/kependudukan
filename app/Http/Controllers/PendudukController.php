<?php

namespace App\Http\Controllers;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendudukController extends Controller
{
    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:penduduk',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/penduduk'), $nama_foto);
            $validatedData['foto'] = 'uploads/penduduk/' . $nama_foto;
        }

        Penduduk::create($validatedData);
        return redirect()->route('penduduk.index');
    }

    public function index()
    {
        $penduduk = Penduduk::all(); // Mengambil semua data penduduk
        return view('penduduk.index', compact('penduduk')); // Mengirim data ke view
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);
        
        // Validasi request
        $rules = [
            'nik' => [
                'required',
                'string',
                'max:16',
                Rule::unique('penduduk')->ignore($penduduk->id)
            ],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'status' => 'required|string',
            'pekerjaan' => 'required|string',
        ];

        // Tambah validasi foto hanya jika ada file yang diupload
        if ($request->hasFile('foto')) {
            $rules['foto'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validatedData = $request->validate($rules);

        // Proses upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($penduduk->foto && file_exists(public_path($penduduk->foto))) {
                unlink(public_path($penduduk->foto));
            }

            // Upload foto baru
            $foto = $request->file('foto');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/penduduk'), $nama_foto);
            $validatedData['foto'] = 'uploads/penduduk/' . $nama_foto;
        }

        $penduduk->update($validatedData);
        return redirect()->route('penduduk.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus');
    }
}