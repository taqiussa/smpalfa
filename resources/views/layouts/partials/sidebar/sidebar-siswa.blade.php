<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item {{ Request::routeIs('siswa.administrasi') ? 'active' : '' }}">
        <a href="{{ route('siswa.administrasi') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M23.5 17L18.5 22L15 18.5L16.5 17L18.5 19L22 15.5L23.5 17M6 2C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H13.8C13.4 21.4 13.2 20.7 13.1 20H6V4H13V9H18V13.1C18.3 13 18.7 13 19 13C19.3 13 19.7 13 20 13.1V8L14 2H6M11 11V19H13V11H11M7 13V19H9V13H7Z" />
                </svg>
            </span>
            <span class="text">Administrasi</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.alquran.bil-ghoib') ? 'active' : '' }}">
        <a href="{{ route('siswa.alquran.bil-ghoib') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z" />
                </svg>
            </span>
            <span class="text">Al-Qur'an Bil Ghoib</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.alquran.bin-nadzor') ? 'active' : '' }}">
        <a href="{{ route('siswa.alquran.bin-nadzor') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M21,4H3A2,2 0 0,0 1,6V19A2,2 0 0,0 3,21H21A2,2 0 0,0 23,19V6A2,2 0 0,0 21,4M3,19V6H11V19H3M21,19H13V6H21V19M14,9.5H20V11H14V9.5M14,12H20V13.5H14V12M14,14.5H20V16H14V14.5Z" />
                </svg>
            </span>
            <span class="text">Al-Qur'an Bin Nadzor</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.data-bimbingan') ? 'active' : '' }}">
        <a href="{{ route('siswa.data-bimbingan') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M19.07 14.88L21.12 16.93L15.06 23H13V20.94L19.07 14.88M21.04 13.13C21.18 13.13 21.31 13.19 21.42 13.3L22.7 14.58C22.92 14.79 22.92 15.14 22.7 15.35L21.7 16.35L19.65 14.3L20.65 13.3C20.76 13.19 20.9 13.13 21.04 13.13M17 4V10L15 8L13 10V4H9V20H11V22H7C5.95 22 5 21.05 5 20V19H3V17H5V13H3V11H5V7H3V5H5V4C5 2.89 5.9 2 7 2H19C20.05 2 21 2.95 21 4V10L19 12V4H17M5 5V7H7V5H5M5 11V13H7V11H5M5 17V19H7V17H5Z" />
                </svg>
            </span>
            <span class="text">Data Bimbingan</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.data-skor') ? 'active' : '' }}">
        <a href="{{ route('siswa.data-skor') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M14.84,16.26C17.86,16.83 20,18.29 20,20V22H4V20C4,18.29 6.14,16.83 9.16,16.26L12,21L14.84,16.26M8,8H16V10A4,4 0 0,1 12,14A4,4 0 0,1 8,10V8M8,7L8.41,2.9C8.46,2.39 8.89,2 9.41,2H14.6C15.11,2 15.54,2.39 15.59,2.9L16,7H8M12,3H11V4H10V5H11V6H12V5H13V4H12V3Z" />
                </svg>
            </span>
            <span class="text">Data Skor</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.kehadiran') ? 'active' : '' }}">
        <a href="{{ route('siswa.kehadiran') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M13.34,8.17C12.41,8.17 11.65,7.4 11.65,6.47A1.69,1.69 0 0,1 13.34,4.78C14.28,4.78 15.04,5.54 15.04,6.47C15.04,7.4 14.28,8.17 13.34,8.17M10.3,19.93L4.37,18.75L4.71,17.05L8.86,17.9L10.21,11.04L8.69,11.64V14.5H7V10.54L11.4,8.67L12.07,8.59C12.67,8.59 13.17,8.93 13.5,9.44L14.36,10.79C15.04,12 16.39,12.82 18,12.82V14.5C16.14,14.5 14.44,13.67 13.34,12.4L12.84,14.94L14.61,16.63V23H12.92V17.9L11.14,16.21L10.3,19.93M21,23H19V3H6V16.11L4,15.69V1H21V23M6,23H4V19.78L6,20.2V23Z" />
                </svg>
            </span>
            <span class="text">Kehadiran</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('siswa.nilai') ? 'active' : '' }}">
        <a href="{{ route('siswa.nilai') }}">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M8.5,7H10.5L16,21H13.6L12.5,18H6.3L5.2,21H3L8.5,7M7.1,16H11.9L9.5,9.7L7.1,16M22,5V7H19V10H17V7H14V5H17V2H19V5H22Z" />
                </svg>
            </span>
            <span class="text">Nilai</span>
        </a>
    </li>
</ul>
