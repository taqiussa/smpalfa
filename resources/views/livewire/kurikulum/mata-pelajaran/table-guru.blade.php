<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-4 my-2">
                            <div class="input-group">
                                <span class="input-group-text">Guru</span>
                                <select wire:model="guru" class="form-select">
                                    <option value="">Pilih Guru</option>
                                    @foreach ($list_guru as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('guru')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-5 my-2">
                            <div class="input-group">
                                <span class="input-group-text">Mata Pelajaran</span>
                                <select wire:model="mata_pelajaran" class="form-select">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($list_mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('mata_pelajaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 my-2">
                            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                                class="btn btn-primary w-auto">Set <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </div>
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
                                    <th>Mata Pelajaran</th>
                                    <th>Nama Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $mata_pelajaran->nama }}
                                        </td>
                                        <td>
                                            @foreach ($mata_pelajaran->guru as $guru)
                                                <li>{{ $guru->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($mata_pelajaran->guru as $guru)
                                            <li><a wire:click.prevent="delete({{ $mata_pelajaran->id }},{{ $guru->id }})" role="button" class="badge text-danger"><i class="fas fa-trash-alt"></i></a></li>
                                        @endforeach
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
