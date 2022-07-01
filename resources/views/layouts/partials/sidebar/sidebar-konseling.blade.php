<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_absensi" aria-controls="menu_absensi"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                    <path
                        d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                </svg>
            </span>
            <span class="text">Absensi</span>
        </a>
        <ul id="menu_absensi" class="{{ Request::routeIs('konseling.absensi.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('konseling.absensi.absensi-siswa') }}"
                    class="{{ Request::routeIs('konseling.absensi.absensi-siswa') ? 'active' : '' }}"> Absensi Siswa </a>
            </li>
            <li>
                <a href="{{ route('konseling.absensi.absensi-bk') }}" class="{{ Request::routeIs('konseling.absensi.absensi-bk') ? 'active' : '' }}">
                    Absensi BK </a>
            </li>
            <li>
                <a href="{{ route('konseling.absensi.rekap-kehadiran') }}" class="{{ Request::routeIs('konseling.absensi.rekap-kehadiran') ? 'active' : '' }}">
                    Rekap Kehadiran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_layanan" aria-controls="menu_layanan"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Layanan</span>
        </a>
        <ul id="menu_layanan" class="{{ Request::routeIs('konseling.layanan.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('konseling.layanan.bimbingan') }}"
                    class="{{ Request::routeIs('konseling.layanan.bimbingan') ? 'active' : '' }}">Bimbingan dan Konseling</a>
            </li>
            <li>
                <a href="{{ route('konseling.layanan.rekap-bimbingan') }}"
                    class="{{ Request::routeIs('konseling.layanan.rekap-bimbingan') ? 'active' : '' }}">Rekap Bimbingan</a>
            </li>

        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
