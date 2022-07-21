<div>
    <x-slot name="header">
        <h4>Rekap Kehadiran Siswa</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <div class="row my-2">
                    <div class="col-md-6">
                        <label for="tanggalawal" class="form-label">Tanggal Mulai</label>
                        <input wire:model="tanggalawal" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggalakhir" class="form-label">Sampai Dengan Tanggal</label>
                        <input wire:model="tanggalakhir" type="date" class="form-control">
                    </div>
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
                                <th>Hari, Tanggal</th>
                                <th>Jam</th>
                                <th>Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kehadiran as $kehadiran)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($kehadiran->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ $kehadiran->jam }}</td>
                                    <td>{{ $kehadiran->kehadiran->nama }}</td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td>
                                    <table class="table">
                                        @foreach ($list_kehadiran['1-2'] as $kehadiran)
                                            <tr class="text-nowrap">
                                                <td>{{ Carbon\Carbon::parse($kehadiran->tanggal)->translatedFormat('l, d F Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                @foreach ($jam as $jam)
                                    <td>
                                        <table class="table">
                                            @foreach ($list_kehadiran[$jam] as $kehadiran)
                                                <tr class="text-nowrap">
                                                    <td>{{ $kehadiran->kehadiran->nama ?? 'Belum ada absensi' }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                @endforeach
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
