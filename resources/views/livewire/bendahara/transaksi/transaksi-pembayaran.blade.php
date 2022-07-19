<div>
    <div class="row my-2">
        <div class="col-md-6">
            <x-card>
                <div class="row my-2">
                    <div class="col">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select wire:model="tahun" id="tahun" class="form-select">
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
                <div class="row my-2">
                    <div wire:ignore class="col">
                        <label for="nis" class="form-label">Siswa</label>
                        <select id="nis" class="form-select">
                            <option value="">Pilih Siswa</option>
                            @foreach ($list_siswa as $siswa)
                                <option value="{{ $siswa->nis }}">
                                    {{ $siswa->user->name . ' - ' . $siswa->kelas->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-end">
                    <button wire:click.prevent="pilih" class="btn btn-primary">Pilih Siswa</button>
                </div> --}}
                <div class="my-2">
                    <small class="text-danger">{{ $nis }}</small>
                </div>
                <div class="table-responsive">
                    <h5>Data Siswa</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Desa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_siswa as $siswa)
                                <tr>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->user->name }}</td>
                                    <td>{{ $siswa->kelas->nama }}</td>
                                    <td>{{ $siswa->alamat->desa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Guna Bayar</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_transaksi as $key => $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $list_transaksi[$key]['gunabayar'] }}
                                    </td>
                                    <td>
                                        {{ $list_transaksi[$key]['format_jumlah'] }}
                                    </td>
                                    <td>
                                        <a wire:click.prevent="hapus({{ $key }})" class="badge text-danger">
                                            <i class="fas fa-trash-alt" role="button"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">Total</th>
                                <td>{{ $format_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpanz"
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
                        <tr>
                            <th>#</th>
                            <th>Semester</th>
                            <th>Guna Bayar</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Bendahara</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            @foreach ($list_gunabayar as $key => $bayar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bayar->semester }}</td>
                                    <td>{{ $bayar->nama }}</td>
                                    <td>{{ $list_jumlah[$key] ?? '' }}</td>
                                    <td>{{ $list_tanggal[$key] ?? '' }}</td>
                                    <td>{{ $list_bendahara[$key] ?? '' }}</td>
                                    <td>
                                        @if (!empty($list_jumlah[$key]))
                                            <span class="badge text-success"><i class="fas fa-check-circle"></i></span>
                                        @else
                                            <a wire:click.prevent="tambah({{ $bayar->id }})"
                                                class="badge text-primary" role="button">
                                                <i class="fas fa-plus"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Jumlah</th>
                                <th>Bendahara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_data_pembayaran as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d M Y', strtotime($pembayaran->tanggal)) }}</td>
                                <td>{{ $pembayaran->siswa }}</td>
                                <td>{{ $pembayaran->kelas }}</td>
                                <td>{{ 'Rp ' . number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $pembayaran->bendahara }}</td>
                                <td>
                                    <a href="{{ route('bendahara.transaksi.pembayaran-siswa-print', [
                                        'id' => $pembayaran->id,
                                        'tanggal' => $pembayaran->tanggal,
                                        'nis' => $pembayaran->nis,
                                        'kelas' => $pembayaran->kelas,
                                        'siswa' => $pembayaran->siswa,
                                        'tahun' => $pembayaran->tahun,
                                    ]) }}"
                                        class="badge text-success mx-2 my-2" target="__blank"><i
                                            class="fas fa-file-alt"></i></a>
                                    {{-- <a wire:click.prevent="confirm({{ $pembayaran->id }})" class="badge text-danger"
                                        role="button">
                                        <i class="fas fa-trash-alt"></i> --}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#nis').select2({
                    theme: "bootstrap-5"
                });
                $('#nis').on('change', function(e) {
                    var data = $('#nis').select2("val");
                    // var data = $(e.currentTarget).val();
                    @this.set('siswa', data);
                });
            });
        </script>
    @endpush
</div>
