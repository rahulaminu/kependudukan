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
<<<<<<< HEAD
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
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048|required'
        ]);


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/penduduk'), $nama_foto);
            $validatedData['foto'] = 'uploads/penduduk/' . $nama_foto;
        }
=======
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
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'foto.required' => 'Foto wajib diunggah.', // Pesan error jika foto kosong
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Format foto harus jpeg, png, atau jpg.',
        'foto.max' => 'Ukuran foto maksimal 2MB.'
    ]);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('uploads/penduduk'), $nama_foto);
        $validatedData['foto'] = 'uploads/penduduk/' . $nama_foto;
    }
>>>>>>> f27c9702c51a804fd0aaf5277363408baf73cc44



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

    if ($request->hasFile('foto')) {
        $rules['foto'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
    }

    $validatedData = $request->validate($rules, [
        'foto.required' => 'Foto wajib diunggah.', // Pesan error jika foto kosong
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Format foto harus jpeg, png, atau jpg.',
        'foto.max' => 'Ukuran foto maksimal 2MB.'
    ]);

    if ($request->hasFile('foto')) {
        if ($penduduk->foto && file_exists(public_path($penduduk->foto))) {
            unlink(public_path($penduduk->foto));
        }

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