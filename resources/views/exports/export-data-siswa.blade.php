<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Ayah</th>
            <th>Ibu</th>
            <th>Wali</th>
            <th>Kontak</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_data_siswa as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->user->name }}</td>
                <td>{{ $siswa->orangtua->nama_ayah }}</td>
                <td>{{ $siswa->orangtua->nama_ibu }}</td>
                <td>{{ $siswa->wali->nama_wali ?? '-' }}</td>
                <td>{{ $siswa->biodata->telepon }}</td>
            </tr>
        @endforeach
    </tbody>
</table>