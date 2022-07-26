<div>
    <x-slot name="header">
        <h4>Hasil Penilaian Siswa</h4>
    </x-slot>
    <div class="my-2">
        <x-card>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mata Pelajaran</th>
                            @foreach ($list_penilaian as $penilaian)
                            <th>{{ $penilaian->jenis_penilaian->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_mata_pelajaran as $mata_pelajaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mata_pelajaran->mapel->nama }}</td>
                                @foreach ($list_penilaian as $penilaian)
                                <td style="text-align: center">
                                    @php
                                    $nilai = App\Models\Penilaian::where('tahun', $tahun)
                                    ->where('semester', $semester)
                                    ->where('nis', auth()->user()->nis)
                                    ->where('jenis_penilaian_id', $penilaian->jenis_penilaian_id)
                                    ->value('nilai');    
                                    @endphp
                                    {{ $nilai }}
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</div>
