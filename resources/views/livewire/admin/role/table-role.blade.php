<div>
    <x-slot name="header">
        Table Role
    </x-slot>
    <div class="row my-2">
        <div class="col-md-4">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="my-2">
                        <button wire:click.prevent="$toggle('show')" class="btn btn-primary w-auto" wire:loading.class="disabled" wire:target="$toggle">Tambah Role <i wire:loading wire:target="$toggle" class="fas fa-spin fa-spinner"></i></button>
                    </div>
                    @if ($show)
                    <form wire:submit.prevent="simpan">
                        <div class="my-2">
                            <label for="name" class="form-label">Role</label>
                            <input wire:model.defer="name" id="name" type="text" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" class="btn btn-secondary" type="submit" wire:loading.class="disabled" wire:target="simpan">Simpan <i wire:loading wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_role as $key => $role)
                                <tr>
                                    <td>
                                        {{ $list_role->firstItem() + $key }}
                                    </td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        <a wire:click.prevent="confirm({{ $role->id }})" class="btn btn-danger" role="button">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_role->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
