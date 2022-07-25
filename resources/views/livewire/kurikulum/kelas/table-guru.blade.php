<div>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model='tahun' id="tahun" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2017; $i < gmdate('Y'); $i++)
                                <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="guru" class="form-label">Guru</label>
                        <select wire:model="guru" id="guru" class="form-select">
                            <option value="">Pilih Guru</option>
                            @foreach ($list_guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select wire:model='kelas' id="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            @foreach ($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div>
                    <span wire:loading wire:target="tahun">Memuat Data ... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="kelas">Memuat Data ... <i class="fas fa-spin fa-spinner"></i></span>
                    <span wire:loading wire:target="guru">Memuat Data ... <i class="fas fa-spin fa-spinner"></i></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                        class="btn btn-primary">Simpan <i wire:loading wire:target="simpan"
                            class="fas fa-spin fa-spinner"></i></button>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kelas Mengajar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_guru_kelas as $key => $guru)
                                <tr>
                                    <td>{{ $list_guru_kelas->firstItem() + $key }}</td>
                                    <td class="text-nowrap">{{ $guru->name }}</td>
                                    <td class="text-nowrap">
                                        <ol class="list-group list-group-numbered list-group-flush">
                                            @foreach ($guru->kelas as $kelas)
                                                <li class="list-group-item">{{ $kelas->nama }} 
                                                    <a wire:click.prevent="delete({{  $guru->id }}, {{ $kelas->id }})" class="text-danger mx-1" role="button">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $list_guru_kelas->links() }}
                </div>
            </x-card>
        </div>
    </div>
</div>
