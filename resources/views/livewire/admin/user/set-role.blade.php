<div>
    <x-slot name="header">
        Set Role
    </x-slot>
    @if ($user)
        <div class="row my-2">
            <div class="col-md-6">
                <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-primary border-3">
                    <div class="card-body">
                        <label for="role" class="form-label">Set Role : {{ $nama }}</label>
                        @foreach ($list_role as $key => $role)
                            <div class="form-check">
                                <input wire:model.defer="roles_name.{{ $role->name }}"
                                    id="roles_name.{{ $key }}" class="form-check-input" type="checkbox"
                                    value="{{ $role->name }}">
                                <label class="form-check-label" for="roles_name.{{ $key }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                        <div>
                            <button wire:click.prevent="set_role" class="btn btn-primary mx-1"
                                wire:loading.class="disabled" wire:target="set_role">Simpan <i wire:loading
                                    wire:target="set_role" class="fas fa-spin fa-spinner"></i></button>
                            <button wire:click.prevent="$set('user','')" class="btn btn-secondary">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-primary border-3">
                <div class="card-body">
                    <div class="col-md-8">
                        <div class="input-group my-2">
                            <span class="input-group-text">Cari</span>
                            <input wire:model.debounce.500ms="search" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="my-2">
                        <span wire:loading wire:target="search">Memuat Data ... <i class="fas fa-spin fa-spinner"></i></span>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_user as $key => $user)
                                    <tr class="text-nowrap">
                                        <td>
                                            {{ $list_user->firstItem() + $key }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <li>{{ $role->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a wire:click.prevent="show_user_roles({{ $user->id }})" role="button"
                                                class="btn btn-primary" wire:loading.class="disabled"
                                                wire:target="show_user_roles">Set
                                                Role <i wire:loading wire:target="show_user_roles"
                                                    class="fas fa-spin fa-spinner"></i></a>
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
