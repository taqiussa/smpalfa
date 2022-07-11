<div>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-4">
                        <label for="kategori" class="form-label">Kategori Pemasukan</label>
                        <select wire:model="kategori" id="kategori" class="form-select">
                            <option value="">Pilih Kategori</option>
                            @foreach ($list_kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                        </select>
                        @error('kategori')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="gunabayar" class="form-label">Gunabayar</label>
                        <input wire:model.defer="gunabayar" type="text" class="form-control">
                        @error('gunabayar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="semester" class="form-label">Semester (khusus SPP)</label>
                        <select wire:model.defer="semester" id="semester" class="form-select">
                            <option value="">Pilih Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori Pemasukan</th>
                                <th>Gunabayar</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_gunabayar as $key => $gunabayar)
                                <tr>
                                    <td>{{ $list_gunabayar->firstItem() + $key }}</td>
                                    <td>{{ $gunabayar->kategori->nama }}</td>
                                    <td>{{ $gunabayar->nama }}</td>
                                    <td>{{ $gunabayar->semester }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $gunabayar->id }})" class="badge text-primary mx-2 my-2" role="button">
                                        <i class="fas fa-edit"></i></a>
                                        <a wire:click.prevent="confirm({{ $gunabayar->id }})" class="badge text-danger mx-2 my-2" role="button">
                                        <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $list_gunabayar->links() }}
                </div>
            </x-card>
        </div>
    </div>
</div>
