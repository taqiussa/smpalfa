<div>
     {{-- featured post --}}
        <div class="row mb-2">

            {{-- left --}}
            <div class="col-md-8">
                @foreach ($list_post as $post)
                    <div
                        class="row g-0 border rounded-md shadow overflow-hidden flex-md-row shadow-sm h-md-250 position-relative my-2">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary"><a href="#">{{ $post->user->name }}</a></strong>
                            <h3 class="mb-0">{{ $post->judul }}</h3>
                            <div class="mb-1 text-muted">{{ date('d M Y', strtotime($post->tanggal)) }}</div>
                            <p class="card-text mb-auto">
                                {!! $post->kutipan !!}
                            </div>
                            {{-- div di atas untuk mengatasi input div dari Trix Editor --}}
                            </p>
                            <a href="{{ route('landing.detail',['slug' => $post->slug]) }}">Read More...</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            @if ($post->foto)
                            <img src="{{ asset('storage/'. $post->foto) }}" alt="foto" width="250" height="250" class="img">
                            @else
                            <svg class="bd-placeholder-img" width="250" height="250" xmlns="http://www.w3.org/2000/svg"
                            role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                            focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%"
                            fill="#eceeef" dy=".3em"></text>
                        </svg>
                        @endif
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $list_post->links() }}
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
                                class="text-danger">Instagram <span class="text-dark">SMP Al Musyaffa'</span></a>
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
                        <li class="list-group-item">Tanggal : 1 Januari - 8 Januari 2023</li>
                        <li class="list-group-item">Tanggal : 1 Januari - 8 Januari 2023</li>
                        <li class="list-group-item">Tanggal : 1 Januari - 8 Januari 2023</li>
                    </ol>
                    <ol class="list-group list-group-flush list-group-numbered my-2">
                        <h5 class="my-2">Gelombang II</h5>
                        <li class="list-group-item">Tanggal : 1 Februari - 8 Februari 2023</li>
                        <li class="list-group-item">Tanggal : 1 Februari - 8 Februari 2023</li>
                        <li class="list-group-item">Tanggal : 1 Februari - 8 Februari 2023</li>
                    </ol>
                </div>
                {{-- end infor --}}

                {{-- Info --}}
                <div class="p-4 mb-3 bg-light rounded-md shadow">
                    <h4>Jumlah Siswa Tahun 2022 / 2023</h4>
                    <h6 class="py-2">Kelas 7</h6>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent_kelas7 }}%"
                            aria-valuenow="{{ $percent_kelas7 }}" aria-valuemin="0" aria-valuemax="100">{{ $siswa_kelas7 }}</div>
                    </div>
                    <h6 class="py-2">Kelas 8</h6>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent_kelas8 }}%"
                            aria-valuenow="{{ $percent_kelas8 }}" aria-valuemin="0" aria-valuemax="100">{{ $siswa_kelas8 }}</div>
                    </div>
                    <h6 class="py-2">Kelas 9</h6>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percent_kelas9 }}%" aria-valuenow="{{ $percent_kelas9 }}"
                            aria-valuemin="0" aria-valuemax="100">{{ $siswa_kelas9 }}</div>
                    </div>
                </div>
                {{-- end infor --}}

            </div>
        </div>
        {{-- end sidebar --}}
        </div>

</div>
