<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#kurikulum_kurikulum"
            aria-controls="kurikulum_kurikulum" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z" />
                </svg>
            </span>
            <span class="text">Kurikulum</span>
        </a>
        <ul id="kurikulum_kurikulum" class="{{ Request::routeIs('kurikulum.kurikulum.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('kurikulum.kurikulum.table-kurikulum') }}"
                    class="{{ Request::routeIs('kurikulum.kurikulum.table-kurikulum') ? 'active' : '' }}">Table
                    Kurikulum</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.kurikulum.mata-pelajaran') }}"
                    class="{{ Request::routeIs('kurikulum.kurikulum.mata-pelajaran') ? 'active' : '' }}">Mata
                    Pelajaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#kurikulum_mata_pelajaran"
            aria-controls="kurikulum_mata_pelajaran" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>
            </span>
            <span class="text">Mata Pelajaran</span>
        </a>
        <ul id="kurikulum_mata_pelajaran"
            class="{{ Request::routeIs('kurikulum.mata-pelajaran.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('kurikulum.mata-pelajaran.table-guru') }}"
                    class="{{ Request::routeIs('kurikulum.mata-pelajaran.table-guru') ? 'active' : '' }}">Table Guru</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.mata-pelajaran.table-mata-pelajaran') }}"
                    class="{{ Request::routeIs('kurikulum.mata-pelajaran.table-mata-pelajaran') ? 'active' : '' }}">Table
                    Mata Pelajaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#kurikulum_penilaian"
            aria-controls="kurikulum_penilaian" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>
            </span>
            <span class="text">Penilaian</span>
        </a>
        <ul id="kurikulum_penilaian" class="{{ Request::routeIs('kurikulum.penilaian.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('kurikulum.penilaian.ekstrakurikuler') }}"
                    class="{{ Request::routeIs('kurikulum.penilaian.ekstrakurikuler') ? 'active' : '' }}">Ekstrakurikuler</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.penilaian.jenis-penilaian') }}"
                    class="{{ Request::routeIs('kurikulum.penilaian.jenis-penilaian') ? 'active' : '' }}">Jenis
                    Penilaian</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.penilaian.kategori-penilaian') }}"
                    class="{{ Request::routeIs('kurikulum.penilaian.kategori-penilaian') ? 'active' : '' }}">Kategori
                    Penilaian</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#kurikulum_rapor"
            aria-controls="kurikulum_rapor" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 19C12 20.08 12.25 21.09 12.68 22H6C4.89 22 4 21.11 4 20V4C4 2.9 4.89 2 6 2H7V9L9.5 7.5L12 9V2H18C19.1 2 20 2.89 20 4V12.08C19.67 12.03 19.34 12 19 12C15.13 12 12 15.13 12 19M23.8 20.4C23.9 20.4 23.9 20.5 23.8 20.6L22.8 22.3C22.7 22.4 22.6 22.4 22.5 22.4L21.3 22C21 22.2 20.8 22.3 20.5 22.5L20.3 23.8C20.3 23.9 20.2 24 20.1 24H18.1C18 24 17.9 23.9 17.8 23.8L17.6 22.5C17.3 22.4 17 22.2 16.8 22L15.6 22.5C15.5 22.5 15.4 22.5 15.3 22.4L14.3 20.7C14.2 20.6 14.3 20.5 14.4 20.4L15.5 19.6V18.6L14.4 17.8C14.3 17.7 14.3 17.6 14.3 17.5L15.3 15.8C15.4 15.7 15.5 15.7 15.6 15.7L16.8 16.2C17.1 16 17.3 15.9 17.6 15.7L17.8 14.4C17.8 14.3 17.9 14.2 18.1 14.2H20.1C20.2 14.2 20.3 14.3 20.3 14.4L20.5 15.7C20.8 15.8 21.1 16 21.4 16.2L22.6 15.7C22.7 15.7 22.9 15.7 22.9 15.8L23.9 17.5C24 17.6 23.9 17.7 23.8 17.8L22.7 18.6V19.6L23.8 20.4M20.5 19C20.5 18.2 19.8 17.5 19 17.5S17.5 18.2 17.5 19 18.2 20.5 19 20.5 20.5 19.8 20.5 19Z" />
                </svg>
            </span>
            <span class="text">Rapor</span>
        </a>
        <ul id="kurikulum_rapor" class="{{ Request::routeIs('kurikulum.rapor.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('kurikulum.rapor.kd') }}"
                    class="{{ Request::routeIs('kurikulum.rapor.kd') ? 'active' : '' }}">KD Rapor</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.rapor.upload-kd-rapor') }}"
                    class="{{ Request::routeIs('kurikulum.rapor.upload-kd-rapor') ? 'active' : '' }}">KD Rapor Upload</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.rapor.kkm') }}"
                    class="{{ Request::routeIs('kurikulum.rapor.kkm') ? 'active' : '' }}">KKM Rapor</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.rapor.set-penilaian-rapor') }}"
                    class="{{ Request::routeIs('kurikulum.rapor.set-penilaian-rapor') ? 'active' : '' }}">Set Rapor</a>
            </li>
            <li>
                <a href="{{ route('kurikulum.rapor.tanggal-rapor') }}"
                    class="{{ Request::routeIs('kurikulum.rapor.tanggal-rapor') ? 'active' : '' }}">Tanggal Rapor</a>
            </li>
        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
