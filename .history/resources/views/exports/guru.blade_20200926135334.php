<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIP</th>
            <th>NIK</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gurus as $guru)
        <tr>
            <td>{{ $guru->nama }}</td>
            <td>'{{ $guru->nik }}</td>
            <td>'{{ $guru->nip }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
