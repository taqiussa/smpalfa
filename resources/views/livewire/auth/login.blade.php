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
                <span wire:loading wire:target="proses_login" class="text-dark bg-light rounded-md px-2 py-2 my-2">
                    Proses Login... <i class="fas fa-spin fa-spinner"></i>
                </span>
                <div class="d-flex justify-content-end my-2">
                    <div class="col-md-4">
                        <button wire:loading.class="disabled" wire:target="proses_login" class="btn btn-primary"
                            type="submit">{{ __('Login') }}</button>
                        <a wire:loading.class="disabled" wire:target="proses_login" href="{{ route('landing') }}"
                            class="btn btn-secondary" role="button">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
