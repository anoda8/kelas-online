<table>
    <thead>
        <tr>
            <th>Nama Mapel</th>
            <th>Nama Guru</th>
            <th>Guru Id [Jangan Dihapus]</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gurus as $guru)
        <tr>
            <td></td>
            <td>{{ $guru->nama }}</td>
            <td>{{ $guru->id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
