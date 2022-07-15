<table>
    <thead>
        <tr>
            <td>No</td>
            <td>NIS</td>
            <td>Nama</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_siswa as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>