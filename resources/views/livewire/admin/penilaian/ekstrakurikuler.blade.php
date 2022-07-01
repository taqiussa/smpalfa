<div>
    <div class="row my-2">
        <div class="col-md-4">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" wire:loading.class="disabled" wire:target="$toggle" class="btn btn-primary my-2">
                        <i class="fas fa-plus-circle"></i> Tambah
                        <i wire:loading wire:targe="$toggle" class="fas fa-spin fa-spinner"></i>
                    </button>
                    @if ($show)
                        <form wire:submit.prevent="simpan" class="my-2">
                            <label class="form-label">Nama Ekstrakurikuler</lab>
                                <input wire:model.defer="ekstrakurikuler" type="text" class="form-control">
                                @error('ekstrakurikuler')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="d-flex justify-content-end my-2">
                                    <button wire:click.prevent="simpan" wire:loading.class="disabled"
                                        wire:target="simpan" class="btn btn-primary" type="submit">Simpan <i
                                            wire:loading wire:target="simpan"
                                            class="fas fa-spin fa-spinner"></i></button>
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
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_ekstrakurikuler as $key => $ekstra)
                                <tr>
                                    <td>{{ $list_ekstrakurikuler->firstItem() + $key }}</td>
                                    <td>{{ $ekstra->nama }}</td>
                                    <td>
                                        <a wire:click.prevent="edit({{ $ekstra->id }})" class="badge text-primary mx-2 my-2" role="button">
                                        <i class="fas fa-edit"></i>
                                        </a>
                                        <a wire:click.prevent="confirm({{ $ekstra->id }})" class="badge text-danger mx-2 my-2" role="button">
                                        <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-2">
                        {{ $list_ekstrakurikuler->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
