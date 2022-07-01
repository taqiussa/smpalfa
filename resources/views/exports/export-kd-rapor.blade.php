<table>
    <thead>
        <tr>
            <td>mata_pelajaran_id</td>
            <td>kategori_nilai_id</td>
            <td>jenis_penilaian_id</td>
            <td>tahun</td>
            <td>semester</td>
            <td>tingkat</td>
            <td>mata_pelajaran</td>
            <td>kategori</td>
            <td>jenis_penilaian</td>
            <td>kd</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_mata_pelajaran as $mata_pelajaran)
            @foreach ($list_jenis_penilaian as $penilaian)
                <tr>
                    <td>{{ $mata_pelajaran->id }}</td>
                    <td>{{ $kategori_nilai_id }}</td>
                    <td>{{ $penilaian->id }}</td>
                    <td>{{ $tahun }}</td>
                    <td>{{ $semester }}</td>
                    <td>{{ $tingkat }}</td>
                    <td>{{ $mata_pelajaran->nama }}</td>
                    <td>{{ $nama_kategori }}</td>
                    <td>{{ $penilaian->nama }}</td>
                    <td>Silahkan Isi KD Disini</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
