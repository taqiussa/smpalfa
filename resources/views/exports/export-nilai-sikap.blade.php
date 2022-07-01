<table>
    <thead>
        <tr>
            <td>tahun</td>
            <td>semester</td>
            <td>kelas_id</td>
            <td>mata_pelajaran_id</td>
            <td>kategori_sikap_id</td>
            <td>jenis_sikap_id</td>
            <td>kategori</td>
            <td>mapel</td>
            <td>nis</td>
            <td>nama</td>
            <td>jenis</td>
            <td>nilai</td>
            <td>tindak_lanjut</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_siswa as $siswa)
            @foreach ($list_jenis as $jenis)
                <tr>
                    <td>{{ $tahun }}</td>
                    <td>{{ $semester }}</td>
                    <td>{{ $siswa->kelas_id }}</td>
                    <td>{{ $mata_pelajaran_id }}</td>
                    <td>{{ $jenis->kategori->id }}</td>
                    <td>{{ $jenis->id }}</td>
                    <td>{{ $jenis->kategori->nama }}</td>
                    <td>{{ $nama_mapel }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $jenis->nama }}</td>
                    <td>1</td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
