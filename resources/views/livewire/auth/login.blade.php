<div class="card bg-transparent border border-dark">
    <div class="card-body">
        <div class="col">
            <form wire:submit.prevent="proses_login">
                @csrf
                <div class="row my-2">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Username</span>
                        <input wire:model.lazy="username" id="username" type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input wire:model.lazy="password" id="password" type="password" class="form-control">
                    </div>
                    @error('username')
                        <small class="text-danger my-2 bg-light">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-end my-2">
                    <button wire:loading.class="disabled" wire:target="proses_login" class="btn btn-primary mx-2"
                        type="submit">
                        <span wire:loading wire:target="proses_login">Proses</span> Login
                        <i wire:loading wire:target="proses_login" class="fas fa-spin fa-spinner"></i>
                    </button>
                    <a wire:loading.class="disabled" wire:target="proses_login" href="{{ route('landing') }}"
                        class="btn btn-secondary mx-2" role="button">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
