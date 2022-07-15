<div>
    <div class="row my-2">
        <div class="col">
            <x-card>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pembayaran</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_gunabayar as $key => $gunabayar)
                                <tr>
                                    <td>{{ $gunabayar->nama }}</td>
                                    <td class="text-nowrap">{{ 'Rp ' . number_format($sumjumlah[$key], 0, ',', '.') }}</td>
                                    {{-- <td class="text-nowrap">{{ $keterangan[$key] }}</td> --}}
                                </tr>
                            @endforeach
                            <tr>
                                <td><b class="text-success">Total Pembayaran</b></td>
                                <td class="text-nowrap"><b class="text-success">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</b></td>

                            </tr>
                            <tr>
                                <td><b class="text-danger">Jumlah Wajib Bayar</b></td>
                                <td class="text-nowrap"><b class="text-danger">{{ 'Rp ' . number_format($wajibbayar, 0, ',', '.') }}</b></td>

                            </tr>
                            <tr>
                                <td><b class="text-primary">Jumlah Kurang Bayar</b></td>
                                <td class="text-nowrap"><b class="text-primary">{{ 'Rp ' . number_format($kurangbayar, 0, ',', '.') }}</b></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</div>
