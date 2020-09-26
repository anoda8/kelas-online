<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
        </tr>
    </thead>
    <tbody>
    @foreach($siswas  as $siswa)
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>'{{ $siswa->nis }}</td>
            <td>'{{ $siswa->jenkel }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
