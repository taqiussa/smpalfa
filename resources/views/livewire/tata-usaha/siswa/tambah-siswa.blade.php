<div>
    <x-slot name="header">
        <h4>Form Tambah Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <form wire:submit.prevent="simpan">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <label for="nis" class="form-label">NIS</label>
                            <input wire:model.defer="nis" type="text" class="form-control">
                            @error('nis')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <input wire:model.defer="nama" type="text" class="form-control">
                            @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</div>
