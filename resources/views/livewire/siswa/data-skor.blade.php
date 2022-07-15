<div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <h5 class="my-2">Saldo Skor : {{ $saldo }}</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Skor</th>
                                <th>Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_skor as $skor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($skor->tanggal)) }}</td>
                                    <td>{{ $skor->skors->keterangan }}</td>
                                    <td>{{ $skor->skor }}</td>
                                    <td>{{ $skor->nama_guru }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
