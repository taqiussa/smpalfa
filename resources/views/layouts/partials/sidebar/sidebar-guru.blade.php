<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#absensi_guru"
            aria-controls="absensi_guru" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                    <path
                        d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                </svg>
            </span>
            <span class="text">Absensi</span>
        </a>
        <ul id="absensi_guru" class="{{ Request::routeIs('guru.absensi.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.absensi.absensi-siswa') }}"
                    class="{{ Request::routeIs('guru.absensi.absensi-siswa') ? 'active' : '' }}"> Absensi Siswa </a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#penilaian_alquran"
            aria-controls="penilaian_alquran" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z" />
                </svg>
            </span>
            <span class="text">Al Qur'an</span>
        </a>
        <ul id="penilaian_alquran" class="{{ Request::routeIs('guru.alquran.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.alquran.input-nilai') }}"
                    class="{{ Request::routeIs('guru.alquran.input-nilai') ? 'active' : '' }}"> Input Nilai Al Qur'an </a>
            </li>
            <li>
                <a href="{{ route('guru.alquran.print-nilai') }}"
                    class="{{ Request::routeIs('guru.alquran.print-nilai') ? 'active' : '' }}"> Print Nilai Al Qur'an </a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#absensi_ekstrakurikuler"
            aria-controls="absensi_ekstrakurikuler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M15.83 10.43A6.93 6.93 0 0 1 18.39 14.86A6.64 6.64 0 0 1 17.5 19.5L15.78 18.5A5 5 0 0 0 16.44 16A5.22 5.22 0 0 0 15.46 13.06L9.18 23.93L7.44 22.95L10.44 17.75L8.71 16.76L7.21 19.34L5.5 18.36L10.63 9.45A7 7 0 0 1 8.8 5.46A6.91 6.91 0 0 1 9.69 1.1L11.43 2.13A4.84 4.84 0 0 0 10.91 5.9A4.74 4.74 0 0 0 13.21 8.93M16 5A2 2 0 1 0 18 7A2 2 0 0 0 16 5M13.5 1A1.5 1.5 0 1 0 15 2.5A1.5 1.5 0 0 0 13.5 1Z" />
                </svg>
            </span>
            <span class="text">Ekstrakurikuler</span>
        </a>
        <ul id="absensi_ekstrakurikuler" class="{{ Request::routeIs('guru.ekstrakurikuler.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.ekstrakurikuler.absensi-ekstrakurikuler') }}"
                    class="{{ Request::routeIs('guru.ekstrakurikuler.absensi-ekstrakurikuler') ? 'active' : '' }}"> Absensi Ekstrakurikuler</a>
            </li>
            <li>
                <a href="{{ route('guru.ekstrakurikuler.absensi-ekstrakurikuler-print') }}"
                    class="{{ Request::routeIs('guru.ekstrakurikuler.absensi-ekstrakurikuler-print') ? 'active' : '' }}"> Absensi Print</a>
            </li>
            <li>
                <a href="{{ route('guru.ekstrakurikuler.input-nilai-ekstra') }}"
                    class="{{ Request::routeIs('guru.ekstrakurikuler.input-nilai-ekstra') ? 'active' : '' }}">Input Nilai Ekstra</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#penilaian_guru"
            aria-controls="penilaian_guru" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>
            </span>
            <span class="text">Penilaian</span>
        </a>
        <ul id="penilaian_guru" class="{{ Request::routeIs('guru.penilaian.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.penilaian.input-nilai') }}"
                    class="{{ Request::routeIs('guru.penilaian.input-nilai') ? 'active' : '' }}">Input Nilai</a>
            </li>
            {{-- <li>
                <a href="{{ route('guru.penilaian.input-nilai-ekstra') }}"
                    class="{{ Request::routeIs('guru.penilaian.input-nilai-ekstra') ? 'active' : '' }}">Input Nilai Ekstra</a>
            </li> --}}
            <li>
                <a href="{{ route('guru.penilaian.input-nilai-sikap') }}"
                    class="{{ Request::routeIs('guru.penilaian.input-nilai-sikap') ? 'active' : '' }}">Input Nilai Sikap</a>
            </li>
            <li>
                <a href="{{ route('guru.penilaian.input-prestasi') }}"
                    class="{{ Request::routeIs('guru.penilaian.input-prestasi') ? 'active' : '' }}">Input Prestasi</a>
            </li>
            <li>
                <a href="{{ route('guru.penilaian.upload-analisis') }}"
                    class="{{ Request::routeIs('guru.penilaian.upload-analisis') ? 'active' : '' }}">Upload Analisis</a>
            </li>
            <li>
                <a href="{{ route('guru.penilaian.upload-nilai') }}"
                    class="{{ Request::routeIs('guru.penilaian.upload-nilai') ? 'active' : '' }}">Upload Nilai</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#rapor_guru"
            aria-controls="rapor_guru" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M13 19C13 20.1 13.3 21.12 13.81 22H6C4.89 22 4 21.11 4 20V4C4 2.9 4.89 2 6 2H7V9L9.5 7.5L12 9V2H18C19.1 2 20 2.89 20 4V13.09C19.67 13.04 19.34 13 19 13C15.69 13 13 15.69 13 19M20 20V16H18V20H16L19 23L22 20H20Z" />
                </svg>
            </span>
            <span class="text">Rapor</span>
        </a>
        <ul id="rapor_guru" class="{{ Request::routeIs('guru.rapor.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.rapor.cetak-rapor') }}"
                    class="{{ Request::routeIs('guru.rapor.cetak-rapor') ? 'active' : '' }}">Cetak Rapor</a>
            </li>
            <li>
                <a href="{{ route('guru.rapor.daftar-nilai-guru') }}"
                    class="{{ Request::routeIs('guru.rapor.daftar-nilai-guru') ? 'active' : '' }}">Daftar Nilai Guru</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#skor"
            aria-controls="skor" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M17 14V17H14V19H17V22H19V19H22V17H19V14M20 11V12.3C19.4 12.1 18.7 12 18 12C16.8 12 15.6 12.4 14.7 13H7V11H20M12.1 17H7V15H12.8C12.5 15.6 12.2 16.3 12.1 17M7 7H20V9H7V7M5 19H7V21H3V3H7V5H5V19Z" />
                </svg>
            </span>
            <span class="text">Skor</span>
        </a>
        <ul id="skor" class="{{ Request::routeIs('guru.skor.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.skor.input-skor') }}"
                    class="{{ Request::routeIs('guru.skor.input-skor') ? 'active' : '' }}">Input Skor</a>
            </li>
            <li>
                <a href="{{ route('guru.skor.saldo-skor') }}"
                    class="{{ Request::routeIs('guru.skor.saldo-skor') ? 'active' : '' }}">Saldo Skor</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#wali_kelas"
            aria-controls="wali_kelas" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H9.18C9.6,1.84 10.7,1 12,1C13.3,1 14.4,1.84 14.82,3H19M12,3A1,1 0 0,0 11,4A1,1 0 0,0 12,5A1,1 0 0,0 13,4A1,1 0 0,0 12,3M7,7V5H5V19H19V5H17V7H7M12,9A2,2 0 0,1 14,11A2,2 0 0,1 12,13A2,2 0 0,1 10,11A2,2 0 0,1 12,9M8,17V16C8,14.9 9.79,14 12,14C14.21,14 16,14.9 16,16V17H8Z" />
                </svg>
            </span>
            <span class="text">Wali Kelas</span>
        </a>
        <ul id="wali_kelas" class="{{ Request::routeIs('guru.wali-kelas.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('guru.wali-kelas.daftar-nilai-kelas') }}"
                    class="{{ Request::routeIs('guru.wali-kelas.daftar-nilai-kelas') ? 'active' : '' }}">Daftar Nilai Kelas</a>
            </li>
            <li>
                <a href="{{ route('guru.wali-kelas.download-data-siswa') }}"
                    class="{{ Request::routeIs('guru.wali-kelas.download-data-siswa') ? 'active' : '' }}">Download Data Siswa</a>
            </li>
            <li>
                <a href="{{ route('guru.wali-kelas.input-catatan') }}"
                    class="{{ Request::routeIs('guru.wali-kelas.input-catatan') ? 'active' : '' }}">Input Catatan Wali Kelas</a>
            </li>
            <li>
                <a href="{{ route('guru.wali-kelas.input-skor') }}"
                    class="{{ Request::routeIs('guru.wali-kelas.input-skor') ? 'active' : '' }}">Input Skor</a>
            </li>
        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
