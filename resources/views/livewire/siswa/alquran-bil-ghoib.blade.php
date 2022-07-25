<div>
    <x-slot name="header">
        <h4>Penilaian Juz 'Amma Bil Ghoib</h4>
    </x-slot>
    <div class="row my-2">
        <x-card>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Surah</th>
                            <th>Nilai</th>
                            <th>Guru</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_jenis as $key => $jenis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $jenis->nama }}</td>
                                <td class="text-center">{{ $list_nilai[$key] }}</td>
                                <td class="text-nowrap">{{ $list_guru[$key] }}</td>
                                <td class="text-nowrap">
                                    {{ $list_tanggal[$key] ? Carbon\Carbon::parse($list_tanggal[$key])->translatedFormat('l, d F Y') : '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
