@extends('layouts.app')
@section('content')
    <div class="col-md-3">
        <a href="{{ route('konseling.layanan.rekap-bimbingan') }}" role="button" class="btn btn-primary w-auto"><i class="lni lni-chevron-left"></i> Kembali</a>
    </div>
    <div class="row my-2">
        <div class="col-md-5 my-2">
            <div class="card rounded-md border-end-0 border-top-0 border-bottom-0 border-primary border-3">
                <div class="card-body">
                    <h3>Detail bimbingan </h3>
                    <h4>
                        {{ $detail->user_name }}
                    </h4>
                    <p>
                        Tanggal : {{ $detail->tanggal }}
                    </p>
                    @if ($bk->bentuk_bimbingan == 'Kelompok')
                        <h3>Bimbingan Kelompok </h3>
                        <h5>
                            @foreach ($bk->details as $bkdetail)
                                <a href="{{ route('konseling.layanan.detail-bimbingan', $bkdetail->slug) }}"
                                    class="nav-link text-black-50">{{ $loop->iteration }}. {{ $bkdetail->name }} -
                                    {{ $bkdetail->nama }}</a>
                            @endforeach
                        </h5>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-7 my-2">
            <div class="card rounded-md border-end-0 border-top-0 border-bottom-0 border-primary border-3">
                <div class="card-body">
                    <p>
                        Jenis Bimbingan : {{ $detail->jenis_bimbingan }}
                    </p>
                    <p>
                        Bentuk Bimbingan : {{ $detail->bentuk_bimbingan }}
                    </p>
                    <p>
                        Permasalahan : {{ $detail->permasalahan }}
                    </p>
                    <p>
                        Penyelesaian : {{ $detail->penyelesaian }}
                    </p>
                    <p>
                        Tindak Lanjut : {{ $detail->tindak_lanjut }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        @if ($detail->foto)
            <div class="col-md-6 my-2">
                <h4 class="my-2">Foto :</h4>
                <img src="{{ asset('storage/app/' . $detail->foto) }}" alt="foto" class="img img-thumbnail">
            </div>
        @endif
        @if ($detail->foto_dokumen)
            <div class="col-md-6 my-2">
                <h4 class="my-2">Dokumen:</h4>
                <img src="{{ asset('storage/app/' . $detail->foto_dokumen) }}" alt="foto" class="img img-thumbnail">
            </div>
        @endif
    </div>
@endsection
