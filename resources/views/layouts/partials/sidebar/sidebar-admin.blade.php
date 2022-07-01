<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_kelas" aria-controls="menu_kelas"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M10,2V4.26L12,5.59V4H22V19H17V21H24V2H10M7.5,5L0,10V21H15V10L7.5,5M14,6V6.93L15.61,8H16V6H14M18,6V8H20V6H18M7.5,7.5L13,11V19H10V13H5V19H2V11L7.5,7.5M18,10V12H20V10H18M18,14V16H20V14H18Z" />
                </svg>
            </span>
            <span class="text">Kelas</span>
        </a>
        <ul id="menu_kelas" class="{{ Request::routeIs('admin.kelas.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.kelas.wali-kelas') }}"
                    class="{{ Request::routeIs('admin.kelas.wali-kelas') ? 'active' : '' }}">Wali Kelas</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_kurikulum"
            aria-controls="menu_kurikulum" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z" />
                </svg>
            </span>
            <span class="text">Kurikulum</span>
        </a>
        <ul id="menu_kurikulum" class="{{ Request::routeIs('admin.kurikulum.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.kurikulum.table-kurikulum') }}"
                    class="{{ Request::routeIs('admin.kurikulum.table-kurikulum') ? 'active' : '' }}">Table
                    Kurikulum</a>
            </li>
            <li>
                <a href="{{ route('admin.kurikulum.mata-pelajaran') }}"
                    class="{{ Request::routeIs('admin.kurikulum.mata-pelajaran') ? 'active' : '' }}">Mata
                    Pelajaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_mata_pelajaran"
            aria-controls="menu_mata_pelajaran" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>
            </span>
            <span class="text">Mata Pelajaran</span>
        </a>
        <ul id="menu_mata_pelajaran"
            class="{{ Request::routeIs('admin.mata-pelajaran.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.mata-pelajaran.table-guru') }}"
                    class="{{ Request::routeIs('admin.mata-pelajaran.table-guru') ? 'active' : '' }}">Table Guru</a>
            </li>
            <li>
                <a href="{{ route('admin.mata-pelajaran.table-mata-pelajaran') }}"
                    class="{{ Request::routeIs('admin.mata-pelajaran.table-mata-pelajaran') ? 'active' : '' }}">Table
                    Mata Pelajaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_penilaian"
            aria-controls="menu_penilaian" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z" />
                </svg>
            </span>
            <span class="text">Penilaian</span>
        </a>
        <ul id="menu_penilaian" class="{{ Request::routeIs('admin.penilaian.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.penilaian.ekstrakurikuler') }}"
                    class="{{ Request::routeIs('admin.penilaian.ekstrakurikuler') ? 'active' : '' }}">Ekstrakurikuler</a>
            </li>
            <li>
                <a href="{{ route('admin.penilaian.jenis-penilaian') }}"
                    class="{{ Request::routeIs('admin.penilaian.jenis-penilaian') ? 'active' : '' }}">Jenis
                    Penilaian</a>
            </li>
            <li>
                <a href="{{ route('admin.penilaian.kategori-penilaian') }}"
                    class="{{ Request::routeIs('admin.penilaian.kategori-penilaian') ? 'active' : '' }}">Kategori
                    Penilaian</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_rapor"
            aria-controls="menu_rapor" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 19C12 20.08 12.25 21.09 12.68 22H6C4.89 22 4 21.11 4 20V4C4 2.9 4.89 2 6 2H7V9L9.5 7.5L12 9V2H18C19.1 2 20 2.89 20 4V12.08C19.67 12.03 19.34 12 19 12C15.13 12 12 15.13 12 19M23.8 20.4C23.9 20.4 23.9 20.5 23.8 20.6L22.8 22.3C22.7 22.4 22.6 22.4 22.5 22.4L21.3 22C21 22.2 20.8 22.3 20.5 22.5L20.3 23.8C20.3 23.9 20.2 24 20.1 24H18.1C18 24 17.9 23.9 17.8 23.8L17.6 22.5C17.3 22.4 17 22.2 16.8 22L15.6 22.5C15.5 22.5 15.4 22.5 15.3 22.4L14.3 20.7C14.2 20.6 14.3 20.5 14.4 20.4L15.5 19.6V18.6L14.4 17.8C14.3 17.7 14.3 17.6 14.3 17.5L15.3 15.8C15.4 15.7 15.5 15.7 15.6 15.7L16.8 16.2C17.1 16 17.3 15.9 17.6 15.7L17.8 14.4C17.8 14.3 17.9 14.2 18.1 14.2H20.1C20.2 14.2 20.3 14.3 20.3 14.4L20.5 15.7C20.8 15.8 21.1 16 21.4 16.2L22.6 15.7C22.7 15.7 22.9 15.7 22.9 15.8L23.9 17.5C24 17.6 23.9 17.7 23.8 17.8L22.7 18.6V19.6L23.8 20.4M20.5 19C20.5 18.2 19.8 17.5 19 17.5S17.5 18.2 17.5 19 18.2 20.5 19 20.5 20.5 19.8 20.5 19Z" />
                </svg>
            </span>
            <span class="text">Rapor</span>
        </a>
        <ul id="menu_rapor" class="{{ Request::routeIs('admin.rapor.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.rapor.kd') }}"
                    class="{{ Request::routeIs('admin.rapor.kd') ? 'active' : '' }}">KD Rapor</a>
            </li>
            <li>
                <a href="{{ route('admin.rapor.upload-kd-rapor') }}"
                    class="{{ Request::routeIs('admin.rapor.upload-kd-rapor') ? 'active' : '' }}">KD Rapor Upload</a>
            </li>
            <li>
                <a href="{{ route('admin.rapor.kkm') }}"
                    class="{{ Request::routeIs('admin.rapor.kkm') ? 'active' : '' }}">KKM Rapor</a>
            </li>
            <li>
                <a href="{{ route('admin.rapor.set-penilaian-rapor') }}"
                    class="{{ Request::routeIs('admin.rapor.set-penilaian-rapor') ? 'active' : '' }}">Set Rapor</a>
            </li>
            <li>
                <a href="{{ route('admin.rapor.tanggal-rapor') }}"
                    class="{{ Request::routeIs('admin.rapor.tanggal-rapor') ? 'active' : '' }}">Tanggal Rapor</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_role"
            aria-controls="menu_role" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M10 4A4 4 0 0 0 6 8A4 4 0 0 0 10 12A4 4 0 0 0 14 8A4 4 0 0 0 10 4M10 6A2 2 0 0 1 12 8A2 2 0 0 1 10 10A2 2 0 0 1 8 8A2 2 0 0 1 10 6M17 12C16.84 12 16.76 12.08 16.76 12.24L16.5 13.5C16.28 13.68 15.96 13.84 15.72 14L14.44 13.5C14.36 13.5 14.2 13.5 14.12 13.6L13.16 15.36C13.08 15.44 13.08 15.6 13.24 15.68L14.28 16.5V17.5L13.24 18.32C13.16 18.4 13.08 18.56 13.16 18.64L14.12 20.4C14.2 20.5 14.36 20.5 14.44 20.5L15.72 20C15.96 20.16 16.28 20.32 16.5 20.5L16.76 21.76C16.76 21.92 16.84 22 17 22H19C19.08 22 19.24 21.92 19.24 21.76L19.4 20.5C19.72 20.32 20.04 20.16 20.28 20L21.5 20.5C21.64 20.5 21.8 20.5 21.8 20.4L22.84 18.64C22.92 18.56 22.84 18.4 22.76 18.32L21.72 17.5V16.5L22.76 15.68C22.84 15.6 22.92 15.44 22.84 15.36L21.8 13.6C21.8 13.5 21.64 13.5 21.5 13.5L20.28 14C20.04 13.84 19.72 13.68 19.4 13.5L19.24 12.24C19.24 12.08 19.08 12 19 12H17M10 13C7.33 13 2 14.33 2 17V20H11.67C11.39 19.41 11.19 18.77 11.09 18.1H3.9V17C3.9 16.36 7.03 14.9 10 14.9C10.43 14.9 10.87 14.94 11.3 15C11.5 14.36 11.77 13.76 12.12 13.21C11.34 13.08 10.6 13 10 13M18.04 15.5C18.84 15.5 19.5 16.16 19.5 17.04C19.5 17.84 18.84 18.5 18.04 18.5C17.16 18.5 16.5 17.84 16.5 17.04C16.5 16.16 17.16 15.5 18.04 15.5Z" />
                </svg>
            </span>
            <span class="text">Role</span>
        </a>
        <ul id="menu_role" class="{{ Request::routeIs('admin.role.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.role.table-role') }}"
                    class="{{ Request::routeIs('admin.role.table-role') ? 'active' : '' }}">Table Role</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_user"
            aria-controls="menu_user" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M4,6H2V20A2,2 0 0,0 4,22H18V20H4V6M20,2A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H8A2,2 0 0,1 6,16V4A2,2 0 0,1 8,2H20M17,7A3,3 0 0,0 14,4A3,3 0 0,0 11,7A3,3 0 0,0 14,10A3,3 0 0,0 17,7M8,15V16H20V15C20,13 16,11.9 14,11.9C12,11.9 8,13 8,15Z" />
                </svg>
            </span>
            <span class="text">User</span>
        </a>
        <ul id="menu_user" class="{{ Request::routeIs('admin.user.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('admin.user.table-user') }}"
                    class="{{ Request::routeIs('admin.user.table-user') ? 'active' : '' }}">Table User</a>
            </li>
            <li>
                <a href="{{ route('admin.user.set-role') }}"
                    class="{{ Request::routeIs('admin.user.set-role') ? 'active' : '' }}">Set Role</a>
            </li>
        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
