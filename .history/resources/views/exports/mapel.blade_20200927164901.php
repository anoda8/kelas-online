<table>
    <thead>
        <tr>
            <th>Nama Mapel</th>

        </tr>
    </thead>
    <tbody>
    @foreach($siswas as $siswa)
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>'{{ $siswa->nis }}</td>
            <td>{{ $siswa->jenkel }}</td>
            <td>'{{ $siswa->tgl_lahir }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
