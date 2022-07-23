<div>
    <x-slot name="header">
        <h4>Data Bimbingan Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <x-card>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Permasalahan</th>
                            <th>Tindak Lanjut</th>
                            <th>Guru Bk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_rekap as $key => $rekap)
                            <tr>
                                <td>
                                    {{ $list_rekap->firstItem() + $key }}
                                </td>
                                <td>{{ date('d M Y', strtotime($rekap->tanggal)) }}</td>
                                <td>
                                    {{ $rekap->kelas->nama }}
                                </td>
                                <td>
                                    {{ $rekap->siswa->name }}
                                </td>
                                <td>{{ $rekap->permasalahan }}</td>
                                <td>{{ $rekap->tindak_lanjut }}</td>
                                <td>{{ $rekap->guru->name }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('konseling.layanan.detail-bimbingan', $rekap->slug) }}"
                                        class="btn btn-primary mx-1 my-1" role="button">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row my-2">
                {{ $list_rekap->links() }}
            </div>
        </x-card>
    </div>
</div>
