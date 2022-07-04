<div>
    <div class="row my-2">
        <div class="col-md-4">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <label for="tahun" class="form-label">Tahun</label>
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
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Keterangan</th>
                                    <th>Skor</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_rekap_skor as $key => $skor)
                                    <tr>
                                        <td>{{ $list_rekap_skor->firstItem() + $key }}</td>
                                        <td>{{ date('d M Y', strtotime($skor->tanggal)) }}</td>
                                        <td>{{ $skor->nama_siswa }}</td>
                                        <td>{{ $skor->kelas->nama }}</td>
                                        <td>{{ $skor->skors->keterangan }}</td>
                                        <td>{{ $skor->skor }}</td>
                                        <td>{{ $skor->nama_guru }}</td>
                                        <td>
                                            <a wire:click.prevent="confirm({{ $skor->id }})"
                                                class="badge text-danger" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-2">
                        {{ $list_rekap_skor->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
