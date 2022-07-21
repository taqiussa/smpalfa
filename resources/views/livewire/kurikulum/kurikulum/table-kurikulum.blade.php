<div>
    <x-slot name="header">
        
        <h4>
            Table Kurikulum
            </h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" class="btn btn-primary" wire:loading.class="disabled" wire:target="$toggle"><i class="fas fa-plus-circle"></i> Tambah Kurikulum
                        <i wire:loading class="fas fa-spin fa-spinner" wire:target="$toggle"></i></button>
                    @if ($show)
                        <form wire:submit.prevent="simpan">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Kurikulum</label>
                                <input wire:model.defer="nama" type="text" class="form-control">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button wire:click.prevent="simpan" class="btn btn-primary" wire:loading.class="disabled" wire:target="simpan">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                            </div>
                        </form>
                    @endif
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
                                    <th>Nama Kurikulum</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kurikulum as $key => $kurikulum)
                                <tr>
                                    <td>{{ $list_kurikulum->firstItem() + $key }}</td>
                                    <td>{{ $kurikulum->nama }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $kurikulum->id }})" role="button" class="badge text-primary mx-1 my-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a wire:click.prevent="confirm({{ $kurikulum->id }})" role="button" class="badge text-danger mx-1 my-1"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_kurikulum->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
