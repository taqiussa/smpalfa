<table>
    <thead>
        <tr>
            <td>tahun</td>
            <td>semester</td>
            <td>mata_pelajaran_id</td>
            <td>kategori_nilai_id</td>
            <td>jenis_penilaian_id</td>
            <td>kelas_id</td>
            <td>no</td>
            <td>nis</td>
            <td>nama</td>
            <td>no_1</td>
            <td>no_2</td>
            <td>no_3</td>
            <td>no_4</td>
            <td>no_5</td>
            <td>no_6</td>
            <td>no_7</td>
            <td>no_8</td>
            <td>no_9</td>
            <td>no_10</td>
            <td>skor</td>
            <td>nilai</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_siswa as $siswa)
            <tr>
                <td>{{ $tahun }}</td>
                <td>{{ $semester }}</td>
                <td>{{ $mata_pelajaran_id }}</td>
                <td>{{ $kategori_nilai_id }}</td>
                <td>{{ $jenis_penilaian_id }}</td>
                <td>{{ $kelas_id }}</td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->name }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Skor</td>
                <td>1</td>
            </tr>
        @endforeach
    </tbody>
</table>
