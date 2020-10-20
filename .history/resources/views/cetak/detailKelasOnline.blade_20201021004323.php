<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['kelon']->kelas->nama }} - {{ $data['kelon']->materi }}</title>
    <style>
        .text-center{
            text-align: center;
        }
        #table-presensi > tbody > tr > td{
            padding: 7px;
            margin: 0;
        }
        #table-presensi > tbody > tr > td:first-child{
            font-weight: bold;
            width: 200px;
        }
        #table-presensi > tbody > tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #table-presensi {
            border-collapse: collapse;
            width: 100%;
        }
        #table-ttd{
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        #table-ttd > tbody > tr > td{
            /* border: solid 1px; */
        }
    </style>
</head>
<body>
    <div class="text-center"><h2>Jurnal Harian Pembelajaran</h2></div>
    <br><br><br>
    <table id="table-presensi">
        <tbody>
            <tr>
                <td>Tanggal / Waktu</td>
                <td width="5px">:</td>
                <td>{{ $data['kelon']->wkt_masuk->format("d-m-Y") }} - {{ $data['kelon']->wkt_masuk->format("H:i") }} s/d {{ $data['kelon']->wkt_selesai->format("H:i") }}</td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td>:</td>
                <td>{{ $data['kelon']->mapel->nama }}</td>
            </tr>
            <tr>
                <td>Guru Mapel</td>
                <td>:</td>
                <td>{{ $data['kelon']->author->name }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $data['kelon']->kelas->nama }}</td>
            </tr>
            <tr>
                <td>Metode Pembelajaran</td>
                <td>:</td>
                <td>Website Daring </td>
            </tr>
            <tr>
                <td>Media yang digunakan </td>
                <td>:</td>
                <td>Komputer/Laptop/Gawai </td>
            </tr>
            <tr>
                <td>Materi </td>
                <td>:</td>
                <td>{{ $data['kelon']->materi }} </td>
            </tr>
            <tr>
                <td>Jumlah </td>
                <td>:</td>
                <td>Siswa Dalam Kelas {{ $kelas->siswa->count() }} <br> Siswa Hadir {{ $data['kelon']->log->count() }} <br> Tidak Hadir {{ $kelas->siswa->count() - $data['kelon']->log->count() }}</td>
            </tr>
            <tr>
                <td>Siswa Hadir </td>
                <td>:</td>
                <td>
                    @php
                        $shadir = [];
                    @endphp
                    @foreach ($data['kelon']->log as $log)
                        {{ ucwords(strtolower($log->user->name)) }},
                        @php
                            $shadir = array_merge($shadir, [$log->user->email]);
                        @endphp
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Siswa Tidak Hadir </td>
                <td>:</td>
                <td>
                    @php
                        $siswa_kelas = [];
                        foreach ($kelas->siswa as $siswa) {
                            $siswa_kelas[$siswa->nis] = $siswa->nama;
                        }
                        $skelas = collect($siswa_kelas);
                        $sabsen = $skelas->forget($shadir);
                    @endphp
                    @foreach ($sabsen as $absen)
                        {{ ucwords(strtolower($absen))}},
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    <table id="table-ttd">
        <tbody>
            <tr>
                <td>Mengetahui, <br> Kepala SMA Bintang Angkasa</td>
                <td width="150px">&nbsp;</td>
                <td>Pekalongan {{ date("d-m-Y") }} <br> Guru Mata Pelajaran</td>
            </tr>
            <tr>
                <td height="100px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Drs. Megure, PhD <br> NIP : 19760808 199407 1 009</td>
                <td></td>
                <td>{{ $data['kelon']->author->name }} <br> {{ $data['kelon']->author->email }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
