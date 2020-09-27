<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIS</th>
        </tr>
    </thead>
    <tbody>
    @foreach($siswas as $siswa)
        <tr>
            <td>{{ $siswa->nama }}</td>
            <td>'{{ $siswa->nis }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
