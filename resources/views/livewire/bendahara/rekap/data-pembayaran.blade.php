<div>
    <x-card>
        <div class="col-md-6 my-2">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input wire:model.debounce.500ms="search" type="text" class="form-control" placeholder="Pencarian">
            </div>
        </div>
        <div class="table-responsive my-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Gunabayar</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Bendahara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_pembayaran as $key => $pembayaran)
                        <tr>
                            <td>{{ $list_pembayaran->firstItem() + $key }}</td>
                            <td>{{ date('d M Y', strtotime($pembayaran->tanggal)) }}</td>
                            <td>{{ $pembayaran->siswa }}</td>
                            <td>{{ $pembayaran->kelas }}</td>
                            <td>{{ $pembayaran->gunabayar }}</td>
                            <td>{{ $pembayaran->tahun }}</td>
                            <td>{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $pembayaran->bendahara }}</td>
                            <td>
                                <a href="{{ route('bendahara.transaksi.pembayaran-siswa-print', [
                                    'tanggal' => $pembayaran->tanggal,
                                    'nis' => $pembayaran->nis,
                                    'kelas' => $pembayaran->kelas,
                                    'siswa' => $pembayaran->siswa,
                                    'tahun' => $pembayaran->tahun,
                                ]) }}"
                                    class="badge text-success mx-2 my-2" target="__blank"><i
                                        class="fas fa-file-alt"></i></a>
                                <a wire:click.prevent="confirm({{ $pembayaran->id }})" class="badge text-danger"
                                    role="button">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $list_pembayaran->links() }}
        </div>
    </x-card>
</div>
