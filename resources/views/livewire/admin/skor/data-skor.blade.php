<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-10">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea wire:model.defer="keterangan" id="keterangan" rows="2" class="form-control"></textarea>
                                @error('keterangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="skor" class="form-label">Skor</label>
                                <input wire:model.defer="skor" type="number" class="form-control">
                                @error('skor')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary mx-2 my-2">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                            @if ($is_edit)
                                <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal"
                                    class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal"
                                        class="fas fa-spin fa-spinner"></i></button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Keterangan</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_skor as $key => $skor)
                                    <tr>
                                        <td>{{ $list_skor->firstItem() + $key }}</td>
                                        <td>{{ $skor->keterangan }}</td>
                                        <td>{{ $skor->skor }}</td>
                                        <td>
                                            <a wire:click.prevent="edit({{ $skor->id }})"
                                                class="badge text-primary mx-2 my-2" role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a wire:click.prevent="confirm({{ $skor->id }})"
                                                class="badge text-danger mx-2 my-2" role="button">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
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
    <div>
        {{ $list_skor->links() }}
    </div>
</div>
