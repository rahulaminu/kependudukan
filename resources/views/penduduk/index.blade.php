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
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penduduk as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->tanggal_lahir }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->agama }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
@endsection 