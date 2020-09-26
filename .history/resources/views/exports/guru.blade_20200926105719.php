<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>NIP</th>
            <th>NIK</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>'{{ $user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
