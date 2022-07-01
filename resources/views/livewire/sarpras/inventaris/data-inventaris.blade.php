<div>
    <x-slot name="header">
        Data Inventaris
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary shadow">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" class="btn btn-primary w-auto"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                    @if ($show)
                        <form wire:submit.prevent="simpan">
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input wire:model.defer="nama" type="text" class="form-control">
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input wire:model.defer="kode" type="text" class="form-control">
                                    @error('kode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select wire:model.defer="kategori" id="kategori" class="form-select">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Meja">Meja</option>
                                        <option value="Kursi">Kursi</option>
                                        <option value="Almari">Almari</option>
                                        <option value="Brankas">Brankas</option>
                                        <option value="Papan Tulis">Papan Tulis</option>
                                        <option value="Perangkat Komputer">Perangkat Komputer</option>
                                    </select>
                                    @error('kategori')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label for="ruang" class="form-label">Ruang</label>
                                    <input wire:model.defer="ruang" type="text" class="form-control">
                                    @error('ruang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input wire:model.defer="keterangan" type="text" class="form-control">
                                    @error('keterangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input wire:model.defer="jumlah" type="number" class="form-control">
                                    @error('jumlah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button wire:click.prevent="simpan" class="btn btn-primary mx-1"
                                    type="submit">Simpan</button>
                                <button wire:click.prevent="$toggle('show')"
                                    class="btn btn-secondary mx-1">Batal</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Kode</th>
                                    <th>Kategori</th>
                                    <th>Ruang</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_barang as $key => $barang)
                                    <tr>
                                        <td>{{ $list_barang->firstItem() + $key }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->kode }}</td>
                                        <td>{{ $barang->kategori }}</td>
                                        <td>{{ $barang->ruang }}</td>
                                        <td>{{ $barang->keterangan }}</td>
                                        <td>{{ $barang->jumlah }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $barang->id }})" role="button"
                                                class="icon text-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_barang->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
