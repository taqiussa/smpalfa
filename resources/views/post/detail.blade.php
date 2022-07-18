@extends('landing')
@section('content')
    {{-- featured post --}}
    <div class="row mb-2">

        {{-- left --}}
        <div class="col-md-8">
            <div
                class="row g-0 border rounded-md shadow overflow-hidden flex-md-row shadow-sm h-md-250 position-relative my-2">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><a href="#">{{ $post->user->name }}</a></strong>
                    <h3 class="mb-0">{{ $post->judul }}</h3>
                    <div class="mb-1 text-muted">{{ date('d M Y', strtotime($post->tanggal)) }}</div>
                    @if($post->foto)
                    <img src="{{ asset('storage/' . $post->foto) }}" alt="gambar" class="img img-thumbnail my-2">
                    @endif
                    <p class="card-text mb-auto">
                        {!! $post->isi !!}
                    </p>
                </div>
                <div class="d-flex justify-content-end p-3">
                    <a href="{{ route('landing') }}"><i class="fas fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        {{-- end left --}}

        {{-- right --}}
        {{-- sidebar --}}
        <div class="col-md-4 my-2">
            <div class="position-sticky" style="top:5rem;">

                {{-- Sosial --}}
                <div class="p-4 mb-3 bg-light rounded-md shadow">
                    <h4>Sosial Media</h4>
                    <ul class="list-unstyled">
                        <li class="text-primary fs-5">
                            <i class="fab fa-facebook"></i>
                            <a target="__blank"
                                href="https://web.facebook.com/SMP-Al-Musyaffa-Kendal-718345841588079">Facebook
                                <span class="text-dark">SMP Al Musyaffa' Kendal</span></a>
                        </li>
                        <li class="text-danger fs-5">
                            <i class="fab fa-instagram"></i>
                            <a target="__blank" href="https://www.instagram.com/smp_almusyaffa/"
                                class="text-danger">Instagram
                                <span class="text-dark">SMP Al Musyaffa'</span></a>
                        </li>
                    </ul>

                </div>
                {{-- end sosial --}}

                {{-- Info --}}
                <div class="p-4 mb-3 bg-light rounded-md shadow">
                    <h4>Informasi Pendaftaran Siswa Baru</h4>
                    <h5>Tahun Ajaran 2023 / 2024</h5>
                    <ol class="list-group list-group-flush list-group-numbered my-2">
                        <h5 class="my-2">Gelombang I</h5>
                        <li class="list-group-item">Tanggal : -</li>
                        <li class="list-group-item">Tanggal : -</li>
                        <li class="list-group-item">Tanggal : -</li>
                    </ol>
                    <ol class="list-group list-group-flush list-group-numbered my-2">
                        <h5 class="my-2">Gelombang II</h5>
                        <li class="list-group-item">Tanggal : -</li>
                        <li class="list-group-item">Tanggal : -</li>
                        <li class="list-group-item">Tanggal : -</li>
                    </ol>
                </div>
                {{-- end infor --}}

                {{-- Info --}}
                <div class="p-4 mb-3 bg-light rounded-md shadow">
                    <h4>Jumlah Siswa Tahun 2022 / 2023</h4>
                    <h6 class="py-2">Kelas 7</h6>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent_kelas7 }}%"
                            aria-valuenow="{{ $percent_kelas7 }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $siswa_kelas7 }}
                        </div>
                    </div>
                    <h6 class="py-2">Kelas 8</h6>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent_kelas8 }}%"
                            aria-valuenow="{{ $percent_kelas8 }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $siswa_kelas8 }}
                        </div>
                    </div>
                    <h6 class="py-2">Kelas 9</h6>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percent_kelas9 }}%"
                            aria-valuenow="{{ $percent_kelas9 }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $siswa_kelas9 }}</div>
                    </div>
                </div>
                {{-- end infor --}}

            </div>
        </div>
        {{-- end sidebar --}}
    </div>
@endsection
