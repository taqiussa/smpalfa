<div>
    <x-slot name="header">
        Table User
    </x-slot>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" class="btn btn-primary" wire:loading.class="disabled"
                        wire:target="$toggle"><i class="fas fa-plus-circle"></i> Tambah User <i wire:loading
                            wire:target="$toggle" class="fas fa-spin fa-spinner"></i></button>
                    @if ($show)
                        <form wire:submit.prevent="simpan">
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input wire:model.defer="name" type="text" class="form-control">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input wire:model.defer="username" type="text" class="form-control">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @if ($is_edit)
                            @else
                                <div class="row my-2">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input wire:model.defer="password" type="password" class="form-control">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input wire:model.defer="password_confirmation" type="password"
                                            class="form-control">
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end">
                                <button wire:click.prevent="simpan" type="submit" class="btn btn-primary mx-2 my-2"
                                    wire:loading.class="disabled" wire:target="simpan">Simpan <i wire:loading
                                        wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                                <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal" class="btn btn-secondary mx-2 my-2">Batal <i wire:loading
                                    wire:target="batal" class="fas fa-spin fa-spinner"></i></button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="col-md-6 my-2">
                        <div class="input-group">
                            <span class="input-group-text">Cari</span>
                            <input wire:model.debounce.500ms="search" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="my-2">
                        <span wire:loading wire:target="search">Memuat Data... <i class="fas fa-spin fa-spinner"></i> </span>
                        <span wire:loading wire:target="batal">Memuat Data... <i class="fas fa-spin fa-spinner"></i> </span>
                        <span wire:loading wire:target="edit">Memuat Data... <i class="fas fa-spin fa-spinner"></i> </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_user as $key => $user)
                                    <tr>
                                        <td>{{ $list_user->firstItem() + $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <li>{{ $role->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a wire:click.prevent="edit({{ $user->id }})"
                                                class="badge text-primary mx-1 my-1" role="button"><i
                                                    class="fas fa-user-edit"></i></a>
                                            <a wire:click.prevent="confirm({{ $user->id }})"
                                                class="badge text-danger mx-1 my-1" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
