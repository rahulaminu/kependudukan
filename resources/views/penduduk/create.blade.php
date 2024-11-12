@extends('layout.menu')

@section('konten')
    <h1>Tambah Penduduk</h1>
    <form action="{{ route('penduduk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
            @error('nik')
            <div class="alert alert-danger">{{ $message }}</div> <!-- Menampilkan pesan error -->
            @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
        </div>

        <div class="form-group">
            <label for="agama">Agama:</label>
            <select name="agama" id="agama" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Kawin" {{ old('status') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Belum Kawin" {{ old('status') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
            </select>
        </div>

        <div class="form-group">
        <label for="pekerjaan">Pekerjaan:</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
        </div>
        
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            @error('foto')
            <div class="alert alert-danger">{{ $message }}</div> <!-- Menampilkan pesan error -->
            @enderror
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection 