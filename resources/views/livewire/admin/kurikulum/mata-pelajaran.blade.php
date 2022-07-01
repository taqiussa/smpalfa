<div>
    <x-slot name="header">
        Mata Pelajaran Kurikulum
    </x-slot>
    <div class="row my-2">
        <div class="col-md-8">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <label for="kurikulum" class="form-label">Kurikulum</label>
                            <select wire:model="kurikulum" id="kurikulum" class="form-select">
                                @foreach ($list_kurikulum as $kurikulum)
                                    <option value="{{ $kurikulum->id }}">{{ $kurikulum->nama }}</option>
                                @endforeach
                            </select>
                            @error('kurikulum')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select wire:model="tahun" id="tahun" class="form-select">
                                @for ($i = 2017; $i < gmdate('Y'); $i++)
                                    <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select wire:model="tingkat" id="tingkat" class="form-select">
                                <option value="">Pilih Tingkat</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                            @error('tingkat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-8 my-2">
                            <div class="input-group">
                                <span for="mata_pelajaran" class="input-group-text">Mata Pelajaran</span>
                                <select wire:model="mata_pelajaran" id="mata_pelajaran" class="form-select">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                        <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('mata_pelajaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 my-2">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary w-auto">Tambah <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </div>
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
                                    <th>Mata Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kurikulum_mata_pelajaran as $mata_pelajaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mata_pelajaran->nama }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $mata_pelajaran->id }})"
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
