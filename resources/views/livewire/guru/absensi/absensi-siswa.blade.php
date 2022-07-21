<div>
    <x-slot name='header'>
        <h4>

            Absensi Siswa
        </h4>
    </x-slot>
    <div class="card rounded-md">
        <div class="card-body">
            <div class="row my-2">
                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input wire:model='tanggal' type="date" class="form-control" id="tanggal">
                    @error('tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="jam" class="form-label">Jam</label>
                    <select wire:model='jam' id="jam" class="form-select">
                        <option value="">Pilih Jam</option>
                        <option value="1-2">1-2</option>
                        <option value="3-4">3-4</option>
                        <option value="5-6">5-6</option>
                        <option value="7-8">7-8</option>
                    </select>
                    @error('jam')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
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
                <div class="col-md-3">
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
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">#</th>
                            <th>Nama</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_siswa as $key => $siswa)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    {{ $siswa->name }}
                                </td>
                                <td>
                                    <select wire:model.defer='kehadiran.{{ $key }}.kehadiran'
                                        wire:key="{{ $key }}" class="form-select">
                                        <option value="">Pilih Kehadiran</option>
                                        @foreach ($list_kehadiran as $kehadiran)
                                            <option value='{{ $kehadiran->id }}'>{{ $kehadiran->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kehadiran.' . $key . '.kehadiran')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!blank($list_siswa))
                <div class="row my-2 justify-content-end px-3">
                    <button wire:loading.class="disabled" wire:click.prevent="simpan" class="btn btn-primary w-auto">
                        Simpan
                        <i wire:loading wire:target="simpan" class="fas fa-spinner fa-spin"></i>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
