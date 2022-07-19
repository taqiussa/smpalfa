<div>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-4 my-2">
                        <div class="input-group">
                            <span class="input-group-text">Tahun</span>
                            <select wire:model='tahun' id="tahun" class="form-select">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2017; $i < gmdate('Y'); $i++)
                                    <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">{{ $i + 1 . ' / ' . ($i + 2) }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="input-group">
                            <span class="input-group-text">Cari</span>
                            <input wire:model.debounce.500ms="search" type="text" class="form-control"
                                placeholder="Cari Siswa...">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Orang Tua</th>
                                <th>Desa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_siswa as $key => $siswa)
                                <tr>
                                    <td>{{ $list_siswa->firstItem() + $key }}</td>
                                    <td>{{ $siswa->user->nis }}</td>
                                    <td>{{ $siswa->user->name }}</td>
                                    <td>{{ $siswa->kelas->nama }}</td>
                                    <td>{{ $siswa->orangtua->nama_ayah }}</td>
                                    <td>{{ $siswa->alamat->desa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-2">
                    {{ $list_siswa->onEachSide(1)->links() }}
                </div>
            </x-card>
        </div>
    </div>
</div>
