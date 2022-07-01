<div>
    <div class="row my-2">
        <div class="col-md-5">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-8 my-2">
                            <div class="input-group">
                                <span class="input-group-text">Tahun</span>
                                <select wire:model="tahun" id="tahun" class="form-select">
                                    @for ($i = 2017; $i < gmdate('Y'); $i++)
                                        <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                            {{ $i + 1 . ' / ' . ($i + 2) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 my-2">
                            <button wire:click.prevent="$toggle('show')" class="btn btn-primary w-auto" wire:loading.class="disabled" wire:target="$toggle">Atur <i wire:loading.class="fa-spin" wire:target="$toggle"
                                    class="fas fa-cog"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($show)
        <div class="row my-2">
            <div class="col-md-6">
                <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model.defer="kelas" id="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($list_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="guru" class="form-label">Guru</label>
                                <select wire:model.defer="guru" id="guru" class="form-select">
                                    <option value="">Pilih Guru</option>
                                    @foreach ($list_user as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('guru')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end my-2">
                                <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-primary mx-2 my-2">Simpan <i wire:loading wire:target="simpan" class="fas fa-spinner fa-spin"></i></button>
                                <button wire:click.prevent="batal" wire:loading.class="disabled" wire:target="batal" class="btn btn-secondary mx-2 my-2">Batal <i wire:loading wire:target="batal" class="fas fa-spinner fa-spin"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelas</th>
                                    <th>Tahun</th>
                                    <th>Wali Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_wali_kelas as $wali)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $wali->nama }}</td>
                                        <td>{{ $wali->tahun }}</td>
                                        <td>{{ $wali->name }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $wali->kelas_id }})"
                                                class="badge text-danger" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
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
</div>
