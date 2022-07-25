<div>
    <x-slot name="header">
        <h4>Penilaian Juz 'Amma Bil Ghoib</h4>
    </x-slot>
    <div class="row my-2">
        <x-card>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Surah</td>
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
                                <td class="nowrap">{{ $list_guru[$key] }}</td>
                                <td class="nowrap">{{ $list_tanggal[$key] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
