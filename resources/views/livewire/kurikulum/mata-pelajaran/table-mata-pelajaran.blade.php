<div>
    <x-slot name="header">
        <h4>

            Table Mata Pelajaran
        </h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <button wire:click.prevent="$toggle('show')" class="btn btn-primary"
                        wire:loading.class="disabled" wire:target="$toggle"><i class="fas fa-plus-circle"></i>
                        Tambah Mata Pelajaran <i wire:loading wire:target="$toggle"
                            class="fas fa-spin fa-spinner"></i></button>
                    @if ($show)
                        <form wire:submit.prevent="simpan">
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                                    <input wire:model.defer="nama" type="text" class="form-control">
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="kelompok" class="form-label">Kelompok</label>
                                    <select wire:model.defer="kelompok" id="kelompok" class="form-select">
                                        <option value="">Pilih Kelompok</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    @error('kelompok')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button wire:click.prevent="simpan" type="submit" class="btn btn-primary mx-1"
                                    wire:loading.class="disabled" wire:target="simpan">Simpan <i wire:loading
                                        wire:target="simpan" class="fas fa-spin fa-spinner"></i></button>
                                @if ($is_edit)
                                    <button wire:click.prevent="batal" class="btn btn-secondary mx-1"
                                        wire:loading.class="disabled" wire:target="batal">Batal <i wire:loading
                                            wire:target="batal" class="fas fa-spin fa-spinner"></i></button>
                                @endif
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
                                    <th>ID</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelompok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_mata_pelajaran as $key => $mata_pelajaran)
                                    <tr>
                                        <td>{{ $mata_pelajaran->id }}</td>
                                        {{-- <td>{{ $list_mata_pelajaran->firstItem() + $key }}</td> --}}
                                        <td>{{ $mata_pelajaran->nama }}</td>
                                        <td>{{ $mata_pelajaran->kelompok }}</td>
                                        <td>
                                            <a wire:click.prevent="edit({{ $mata_pelajaran->id }})"
                                                class="badge text-primary mx-1" role="button"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <a wire:click.prevent="confirm({{ $mata_pelajaran->id }})"
                                                class="badge text-danger mx-1" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_mata_pelajaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
