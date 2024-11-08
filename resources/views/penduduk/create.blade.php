@extends('layout.menu')

@section('konten')
    <h1>Tambah Penduduk</h1>
    <form action="{{ route('penduduk.store') }}" method="POST">
        @csrf
        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" required>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <br>
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
        <br>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required>
        <br>
        <label for="agama">Agama:</label>
        <input type="text" id="agama" name="agama" required>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required>
        <br>
        <label for="pekerjaan">Pekerjaan:</label>
        <input type="text" id="pekerjaan" name="pekerjaan" required>
        <br>
        <button type="submit">Simpan</button>
    </form>
@endsection 