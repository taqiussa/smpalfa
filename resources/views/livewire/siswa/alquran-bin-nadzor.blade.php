<div>
    <x-slot name="header">
        <h4>Penilaian Al-Qur'an Bin Nadzor</h4>
    </x-slot>
    <div class="row my-2">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Juz</td>
                        <td>Nilai</td>
                        <td>Guru</td>
                        <td>Tanggal</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_jenis as $key => $jenis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jenis->nama }}</td>
                        <td>{{ $list_nilai[$key] }}</td>
                        <td>{{ $list_guru[$key] }}</td>
                        <td>{{ $list_tanggal[$key] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
