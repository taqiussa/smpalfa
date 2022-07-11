<div>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <form wire:submit.prevent="simpan">
                    <div class="row my-2">
                        <div class="col">
                            <label for="kategori" class="form-label">Kategori Pemasukan</label>
                            <input wire:model.defer="kategori" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            type="submit" class="btn btn-primary mx-2 my-2">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                        @if ($is_edit)
                            <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal"
                                type="submit" class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal"
                                    class="fas fa-spin fa-spinner"></i></button>
                        @endif
                    </div>
                </form>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Kategori</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kategori as $key => $kategori)
                                <tr>
                                    <td>{{ $list_kategori->firstItem() + $key }}</td>
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
                <div>
                    {{ $list_kategori->links() }}
                </div>
            </x-card>
        </div>
    </div>
</div>
