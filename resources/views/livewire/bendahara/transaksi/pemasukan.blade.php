<div>
    <div class="row my-2">
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input wire:model.defer="tanggal" type="date" class="form-control">
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select wire:model='tahun' id="tahun" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = 2017; $i < gmdate('Y'); $i++)
                                        <option value="{{ $i + 1 . ' / ' . ($i + 2) }}">
                                            {{ $i + 1 . ' / ' . ($i + 2) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                        <div class="row my-2">
                            <div class="col-md-8">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select wire:model="siswa" id="siswa" class="form-select">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($list_siswa as $siswa)
                                        <option value="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                    @endforeach
                                </select>
                                @error('siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="pemasukan" class="form-label">Pemasukan</label>
                                <select wire:model.defer="pemasukan" id="pemasukan" class="form-select">
                                    <option value="">Pilih</option>
                                    @foreach ($list_pemasukan as $pemasukan)
                                        <option value="{{ $pemasukan->id }}">{{ $pemasukan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pemasukan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-8">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input wire:model.defer="jumlah" type="numeric" class="form-control">
                                @error('jumlah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="simpan" class="btn btn-primary" wire:loading.class="disabled"
                                wire:target="simpan">Simpan <i wire:loading wire:target="simpan"
                                    class="fas fa-spin fa-spinner"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow rounded-md border-top-0 border-end-0 border-bottom-0 border-3 border-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_pembayaran as $pembayaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d M Y', strtotime($pembayaran->tanggal)) }}</td>
                                        <td>{{ $pembayaran->pembayaran }}</td>
                                        <td>{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ",", ".") }}</td>
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
