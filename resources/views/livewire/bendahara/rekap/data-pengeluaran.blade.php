<div>
    <x-slot name="header">
        <h4>Data Pengeluaran</h4>
    </x-slot>
    <x-card>
        <div class="col-md-6 my-2">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input wire:model.debounce.500ms="search" type="text" class="form-control" placeholder="Pencarian">
            </div>
            <div>
                <span wire:loading wire:target="search">Memuat Data... <i class="fas fa-spin fa-spinner"></i></span>
            </div>
        </div>
        <div class="table-responsive my-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kategori Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Tanggal Nota</th>
                        <th>Jumlah</th>
                        <th>Bendahara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_pengeluaran as $key => $pengeluaran)
                        <tr>
                            <td>{{ $list_pengeluaran->firstItem() + $key }}</td>
                            <td>{{ date('d M Y', strtotime($pengeluaran->tanggal)) }}</td>
                            <td>{{ $pengeluaran->kategori }}</td>
                            <td>{{ $pengeluaran->keterangan }}</td>
                            <td>{{ date('d M Y', strtotime($pengeluaran->tanggal_nota)) }}</td>
                            <td>{{ 'Rp ' . number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $pengeluaran->name }}</td>
                            <td>
                                <a wire:click.prevent="confirm({{ $pengeluaran->id }})" class="badge text-danger"
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
            {{ $list_pengeluaran->links() }}
        </div>
    </x-card>
</div>
