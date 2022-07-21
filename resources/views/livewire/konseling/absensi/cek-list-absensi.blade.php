<div>
    <x-slot name="header">
        <h4>Cek Absensi Per Hari</h4>
    </x-slot>
    <div class="row my-2">
        <div class="col-md-4">
            <x-card>
                <div class="row">
                    <div class="col">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input wire:model="tanggal" type="date" class="form-control">
                    </div>
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
                                <th>Kelas</th>
                                <th>1-2</th>
                                <th>3-4</th>
                                <th>5-6</th>
                                <th>7-8</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kelas as $key => $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelas->nama }}</td>
                                    <td>
                                        @if (!$list_check[$key]['1-2']->isEmpty())
                                            <span class="text-success"><i class="fas fa-check-circle fa-lg"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$list_check[$key]['3-4']->isEmpty())
                                            <span class="text-success"><i class="fas fa-check-circle fa-lg"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$list_check[$key]['5-6']->isEmpty())
                                            <span class="text-success"><i class="fas fa-check-circle fa-lg"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$list_check[$key]['7-8']->isEmpty())
                                            <span class="text-success"><i class="fas fa-check-circle fa-lg"></i></span>
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
</div>
