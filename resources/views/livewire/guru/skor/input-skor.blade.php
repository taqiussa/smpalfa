<div>
    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model.defer="tanggal" type="date" class="form-control">
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select wire:model.defer="semester" id="" class="form-select">
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                            @error('semester')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select wire:model="kelas" id="kelas" class="form-select">
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
                    <div class="row my-2">
                        <div class="col-md-4">
                            <label for="siswa" class="form-label">Siswa</label>
                            <select wire:model.defer="siswa" id="siswa" class="form-select">
                                <option value="">Pilih Siswa</option>
                                @foreach ($list_siswa as $siswa)
                                    <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                @endforeach
                            </select>
                            @error('siswa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div wire:ignore class="col-md-8">
                            <label for="keterangan" class="form-label">Keterangan Skor</label>
                            <select id="keterangan" class="form-select">
                                <option value="">Pilih Skor</option>
                                @foreach ($list_skor as $skor)
                                    <option value="{{ $skor->id }}">{{ $skor->keterangan }}</option>
                                @endforeach
                            </select>
                            @error('skor')
                                <small class="text-danger"></small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan"
                            class="btn btn-primary">Simpan <i wire:loading wire:target="simpan"
                                class="fas fa-spin fa-spinner"></i></button>
                    </div>
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
                                @foreach ($list_nilai_skor as $skor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d M Y', strtotime($skor->tanggal)) }}</td>
                                        <td>{{ $skor->nama_siswa }}</td>
                                        <td>{{ $skor->kelas->nama }}</td>
                                        <td>{{ $skor->skors->keterangan }}</td>
                                        <td>{{ $skor->skor }}</td>
                                        <td>{{ $skor->nama_guru }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#keterangan').select2({
                    theme: "bootstrap-5"
                });
                $('#keterangan').on('change', function(e) {
                    var data = $('#keterangan').select2("val");
                    @this.set('skor', data);
                });
            });
        </script>
    @endpush
</div>
