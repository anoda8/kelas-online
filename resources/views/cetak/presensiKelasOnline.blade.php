<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #table-presensi > thead > tr > th{
            padding: 7px;
            margin: 0;
            border: solid 1px;
        }
        #table-presensi > tbody > tr > td{
            padding: 5px;
            margin: 0;
            border: solid 1px;
        }
        #table-presensi > tbody > tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #table-presensi {
            border-collapse: collapse;
            width: 100%;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="text-center"><h2>Daftar Hadir Pembelajaran</h2></div>
    <br><br>
    Kelas &emsp;: <b>{{ $kelas->nama }}</b><br>
    Guru Mapel &emsp;: <b>{{ $kelon->author->name }}</b><br>
    Tanggal &emsp;: <b>{{ $kelon->wkt_masuk->format("d-m-Y") }} - {{ $kelon->wkt_masuk->format("H:i") }} s/d {{ $kelon->wkt_selesai->format("H:i") }}</b><br>
    Materi Pembelajaran &emsp;: <b>{{ $kelon->materi }}</b><br>
    <hr>
    <table id="table-presensi">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Masuk</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelon->log as $index => $siswa)
            <tr>
                <td width="20px" style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ ucwords(strtolower($siswa->user->name)) }}</td>
                <td style="text-align:center;width:100px;">{{ $siswa->created_at->format('H:i') }}</td>
                <td style="text-align:center;width:100px;">{{ $siswa->wkt_keluar ? $siswa->wkt_keluar->format('H:i') : "-" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
