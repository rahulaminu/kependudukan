@extends('layout.menu')
@section('konten')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Data Penduduk</title>
    </head>
    <body>
        <h1>Data Penduduk</h1>
        <a href="{{ route('penduduk.create') }}" class="btn btn-primary mb-3">
            <i class="fa fa-plus"></i> &nbsp;Tambah Data
        </a>
        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Pekerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penduduk as $p)
                <tr>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->tanggal_lahir }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->agama }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>
                        <a href="{{ route('penduduk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('penduduk.destroy', $p->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
@endsection 