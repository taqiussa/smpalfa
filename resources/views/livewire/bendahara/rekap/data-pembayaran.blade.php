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
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Bendahara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_transaksi as $key => $transaksi)
                        <tr>
                            <td>{{ $list_transaksi->firstItem() + $key }}</td>
                            <td>{{ date('d M Y', strtotime($transaksi->tanggal)) }}</td>
                            <td>{{ $transaksi->siswa }}</td>
                            <td>{{ $transaksi->kelas }}</td>
                            <td>{{ $transaksi->tahun }}</td>
                            <td>{{ 'Rp ' . number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->bendahara }}</td>
                            <td>
                                <a href="{{ route('bendahara.transaksi.pembayaran-siswa-print', [
                                    'id' => $transaksi->id,
                                    'tanggal' => $transaksi->tanggal,
                                    'nis' => $transaksi->nis,
                                    'kelas' => $transaksi->kelas,
                                    'siswa' => $transaksi->siswa,
                                    'tahun' => $transaksi->tahun,
                                    'tingkat' => $transaksi->tingkat
                                ]) }}"
                                    class="badge text-success mx-2 my-2" target="__blank"><i
                                        class="fas fa-file-alt"></i></a>
                                <a wire:click.prevent="confirm({{ $transaksi->id }})" class="badge text-danger"
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
            {{ $list_transaksi->links() }}
        </div>
    </x-card>
</div>
