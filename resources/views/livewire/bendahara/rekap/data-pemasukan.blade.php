<div>
    <x-slot name="header">
        <h4>Data Pemasukan</h4>
    </x-slot>
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
                        <th>Kategori Pemasukan</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Bendahara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_pemasukan as $key => $pemasukan)
                        <tr>
                            <td>{{ $list_pemasukan->firstItem() + $key }}</td>
                            <td>{{ date('d M Y', strtotime($pemasukan->tanggal)) }}</td>
                            <td>{{ $pemasukan->kategori }}</td>
                            <td>{{ $pemasukan->keterangan }}</td>
                            <td>{{ 'Rp ' . number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $pemasukan->name }}</td>
                            <td>
                                <a wire:click.prevent="confirm({{ $pemasukan->id }})" class="badge text-danger"
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
            {{ $list_pemasukan->links() }}
        </div>
    </x-card>
</div>
