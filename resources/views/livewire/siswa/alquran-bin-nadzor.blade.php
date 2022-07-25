<div>
    <x-slot name="header">
        <h4>Penilaian Al-Qur'an Bin Nadzor</h4>
    </x-slot>
    <div class="row my-2">
        <x-card>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
