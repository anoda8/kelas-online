<table>
    <thead>
        <tr>
            <th>Name</th>
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
