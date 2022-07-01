<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model='tahun' id="tahun" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2017; $i < gmdate('Y'); $i++)
                                        <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                            {{ $i + 1 . ' / ' . ($i + 2) }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <select wire:model.defer="mata_pelajaran" id="mata_pelajaran" class="form-select">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($list_mata_pelajaran as $mata_pelajaran)
                                        <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mata_pelajaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="kkm" class="form-label">KKM</label>
                                <input wire:model.defer="kkm" type="number" class="form-control">
                                @error('kkm')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2 d-flex justify-content-end px-3">
                            <button wire:click.prevent="simpan" class="btn btn-primary w-auto">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tahun</th>
                                    <th>Tingkat</th>
                                    <th>KKM</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($list_kkm as $key => $kkm)
                                    <tr>
                                        <td>{{ $list_kkm->firstItem() + $key }}</td>
                                        <td>{{ $kkm->tahun }}</td>
                                        <td>{{ $kkm->tingkat }}</td>
                                        <td>{{ $kkm->mapel->nama }}</td>
                                        <td>{{ $kkm->kkm }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $kkm->id }})"
                                                class="badge text-danger" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                @foreach ($list_mapel as $key => $mapel)
                                    <tr>
                                        <td>{{ $list_mapel->firstItem() + $key }}</td>
                                        <td>{{ $mapel->nama }}</td>
                                        <td class="text-nowrap">
                                            {{ $tahun }}
                                        </td>
                                        <td class="text-center">
                                            @foreach ($mapel->kkm as $kkm)
                                                <li>
                                                    {{ $kkm->tingkat }}
                                                </li>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach ($mapel->kkm as $kkm)
                                                <li>
                                                    {{ $kkm->kkm }}
                                                </li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($mapel->kkm as $kkm)
                                                <li>
                                                    <a wire:click.prevent="confirm({{ $kkm->id }})"
                                                        class="badge text-danger" role="button"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </li>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $list_mapel->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
