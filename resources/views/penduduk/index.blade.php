@extends('layout.menu')

@section('konten')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Data Penduduk</title>
    </head>
    <body>
        <h1>Data Penduduk</h1>
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
                @foreach($penduduks as $penduduk)
                <tr>
                    <td>{{ $penduduk->id }}</td>
                    <td>{{ $penduduk->nik }}</td>
                    <td>{{ $penduduk->nama }}</td>
                    <td>{{ $penduduk->tanggal_lahir }}</td>
                    <td>{{ $penduduk->jenis_kelamin }}</td>
                    <td>{{ $penduduk->alamat }}</td>
                    <td>{{ $penduduk->agama }}</td>
                    <td>{{ $penduduk->status }}</td>
                    <td>{{ $penduduk->pekerjaan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
@endsection 