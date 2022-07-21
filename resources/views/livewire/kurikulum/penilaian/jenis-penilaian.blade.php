<div>
    <x-slot name="header">
        <h4>List Jenis Penilaian</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-12">
                            <button wire:click.prevent="$toggle('show')" wire:loading.class="disabled"
                                wire:target="$toggle" class="btn btn-primary w-auto"><i class="fas fa-plus-circle"></i>
                                Tambah <i wire:loading class="fas fa-spin fa-spinner" wire:target="$toggle"></i></button>
                        </div>
                    </div>
                    @if ($show)
                        <form wire:submit.prevent="simpan">
                            <div class="row my-2">
                                <div class="input-group">
                                    <span class="input-group-text">Jenis Penilaian</span>
                                    <input wire:model.defer="jenis_penilaian" type="text" class="form-control">
                                </div>
                                @error('jenis_penilaian')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row my-2 d-flex justify-content-end">
                                <button wire:click.prevent="simpan" wire:loading.class="disabled"
                                    wire:target="simpan" class="btn btn-primary w-auto">Simpan <i wire:loading
                                        wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
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
                                    <th>Jenis Penilaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_jenis_penilaian as $key => $jenis_penilaian)
                                <tr>
                                    <td>{{ $list_jenis_penilaian->firstItem() + $key }}</td>
                                    <td>{{ $jenis_penilaian->nama }}</td>
                                    <td>
                                        <a wire:click.prevent="confirm({{ $jenis_penilaian->id }})" class="badge text-danger" role="button"><i class="fas fa-trash-alt"></i></a>
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
        {{ $list_jenis_penilaian->links() }}
    </div>
</div>
