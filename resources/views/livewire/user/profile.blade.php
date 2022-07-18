<div>
    <div class="row">
        <div class="col-md-6">
            <x-card>
                <form wire:submit.prevent="simpan" method="POST">
                    @csrf
                <div class="row my-2">
                    <div class="col-md-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input wire:model.defer="nama" id="nama" type="text" class="form-control">
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="row my-2">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input wire:model.defer="password" id="password" type="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="passwor_confirmationd" class="form-label">Password</label>
                        <input wire:model.defer="password_confirmation" id="password_confirmation" type="password"
                            class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                        class="btn btn-primary" type="submit">Simpan <i wire:loading wire:target="simpan"
                            class="fas fa-spin fa-spinner"></i></button>
                </div>
            </form>
            </x-card>
        </div>
    </div>
</div>
