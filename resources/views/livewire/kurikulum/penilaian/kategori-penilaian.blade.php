<div>
    <x-slot name="header">
        <h4>List Kategori Penilaian</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row">
                            <div class="col-md-8 my-2">
                                <div class="input-group">
                                    <span class="input-group-text">Kategori</span>
                                    <input wire:model.defer="kategori" type="text" class="form-control">
                                </div>
                                @error('kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 my-2">
                                <button wire:click.prevent="simpan" wire:loading.class="disabled"
                                    wire:target="simpan" class="btn btn-primary" type="submit">
                                    Simpan
                                    <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori Penilaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kategori as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama }}</td>
                                        <td>
                                            <a wire:click.prevent="edit({{ $kategori->id }})"
                                                class="badge text-primary mx-2 my-2" role="button"><i
                                                    class="fas fa-edit"></i></a>
                                            <a wire:click.prevent="confirm({{ $kategori->id }})"
                                                class="badge text-danger mx-2 my-2" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
