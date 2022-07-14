<h3 class="px-3">{{ $title ?? '' }}</h3>
<ul>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bendahara_pengaturan"
            aria-controls="bendahara_pengaturan" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor"
                        d="M15 17V14H18V12L22 15.5L18 19V17H15M17 18V21H14V23L10 19.5L14 16V18H17M12 8C9.79 8 8 9.8 8 12C8 13.91 9.35 15.54 11.21 15.92L16 11.86C15.93 9.71 14.16 8 12 8M12 14C10.9 14 10 13.11 10 12S10.9 10 12 10 14 10.9 14 12 13.11 14 12 14M21.66 8.73L19.66 5.27C19.54 5.05 19.28 4.96 19.05 5.05L16.56 6.05C16.05 5.64 15.5 5.31 14.87 5.05L14.5 2.42C14.46 2.18 14.25 2 14 2H10C9.75 2 9.54 2.18 9.5 2.42L9.13 5.07C8.5 5.33 7.96 5.66 7.44 6.07L5 5.05C4.77 4.96 4.5 5.05 4.39 5.27L2.39 8.73C2.26 8.94 2.31 9.22 2.5 9.37L4.57 11L4.5 12L4.57 13L2.46 14.63C2.26 14.78 2.21 15.06 2.34 15.27L4.34 18.73C4.45 19 4.74 19.11 5 19L5 19L7.5 18C7.74 18.19 8 18.37 8.26 18.53L9.91 17.13C9.14 16.8 8.46 16.31 7.91 15.68L5.5 16.68L4.73 15.38L6.8 13.8C6.4 12.63 6.4 11.37 6.8 10.2L4.69 8.65L5.44 7.35L7.85 8.35C8.63 7.45 9.68 6.82 10.85 6.57L11.25 4H12.75L13.12 6.62C14.29 6.86 15.34 7.5 16.12 8.39L18.53 7.39L19.28 8.69L17.2 10.2C17.29 10.46 17.36 10.73 17.4 11H19.4L21.5 9.37C21.72 9.23 21.78 8.95 21.66 8.73M12 8C9.79 8 8 9.8 8 12C8 13.91 9.35 15.54 11.21 15.92L16 11.86C15.93 9.71 14.16 8 12 8M12 14C10.9 14 10 13.11 10 12S10.9 10 12 10 14 10.9 14 12 13.11 14 12 14M12 8C9.79 8 8 9.8 8 12C8 13.91 9.35 15.54 11.21 15.92L16 11.86C15.93 9.71 14.16 8 12 8M12 14C10.9 14 10 13.11 10 12S10.9 10 12 10 14 10.9 14 12 13.11 14 12 14Z" />
                </svg>
            </span>
            <span class="text">Pengaturan</span>
        </a>
        <ul id="bendahara_pengaturan"
            class="{{ Request::routeIs('bendahara.pengaturan.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('bendahara.pengaturan.atur-wajib-bayar') }}"
                    class="{{ Request::routeIs('bendahara.pengaturan.atur-wajib-bayar') ? 'active' : '' }}">Atur Wajib
                    Bayar SPP</a>
            </li>
            <li>
                <a href="{{ route('bendahara.pengaturan.kategori-pemasukan') }}"
                    class="{{ Request::routeIs('bendahara.pengaturan.kategori-pemasukan') ? 'active' : '' }}">Kategori Pemasukan</a>
            </li>
            <li>
                <a href="{{ route('bendahara.pengaturan.kategori-pengeluaran') }}"
                    class="{{ Request::routeIs('bendahara.pengaturan.kategori-pengeluaran') ? 'active' : '' }}">Kategori Pengeluaran</a>
            </li>
            <li>
                <a href="{{ route('bendahara.pengaturan.gunabayar') }}"
                    class="{{ Request::routeIs('bendahara.pengaturan.gunabayar') ? 'active' : '' }}">Guna Bayar</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bendahara_transaksi"
            aria-controls="bendahara_transaksi" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M12,3C10.73,3 9.6,3.8 9.18,5H3V7H4.95L2,14C1.53,16 3,17 5.5,17C8,17 9.56,16 9,14L6.05,7H9.17C9.5,7.85 10.15,8.5 11,8.83V20H2V22H22V20H13V8.82C13.85,8.5 14.5,7.85 14.82,7H17.95L15,14C14.53,16 16,17 18.5,17C21,17 22.56,16 22,14L19.05,7H21V5H14.83C14.4,3.8 13.27,3 12,3M12,5A1,1 0 0,1 13,6A1,1 0 0,1 12,7A1,1 0 0,1 11,6A1,1 0 0,1 12,5M5.5,10.25L7,14H4L5.5,10.25M18.5,10.25L20,14H17L18.5,10.25Z" />
                </svg>
            </span>
            <span class="text">Transaksi</span>
        </a>
        <ul id="bendahara_transaksi"
            class="{{ Request::routeIs('bendahara.transaksi.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('bendahara.transaksi.pembayaran-siswa') }}"
                    class="{{ Request::routeIs('bendahara.transaksi.pembayaran-siswa') ? 'active' : '' }}">Pembayaran Siswa</a>
            </li>
            <li>
                <a href="{{ route('bendahara.transaksi.pemasukan') }}"
                    class="{{ Request::routeIs('bendahara.transaksi.pemasukan') ? 'active' : '' }}">Pemasukan</a>
            </li>
            <li>
                <a href="{{ route('bendahara.transaksi.pengeluaran') }}"
                    class="{{ Request::routeIs('bendahara.transaksi.pengeluaran') ? 'active' : '' }}">Pengeluaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bendahara_rekap_pemasukan"
            aria-controls="bendahara_rekap_pemasukan" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M15.5,12C18,12 20,14 20,16.5C20,17.38 19.75,18.21 19.31,18.9L22.39,22L21,23.39L17.88,20.32C17.19,20.75 16.37,21 15.5,21C13,21 11,19 11,16.5C11,14 13,12 15.5,12M15.5,14A2.5,2.5 0 0,0 13,16.5A2.5,2.5 0 0,0 15.5,19A2.5,2.5 0 0,0 18,16.5A2.5,2.5 0 0,0 15.5,14M5,3H19C20.11,3 21,3.89 21,5V13.03C20.5,12.23 19.81,11.54 19,11V5H5V19H9.5C9.81,19.75 10.26,20.42 10.81,21H5C3.89,21 3,20.11 3,19V5C3,3.89 3.89,3 5,3M7,7H17V9H7V7M7,11H12.03C11.23,11.5 10.54,12.19 10,13H7V11M7,15H9.17C9.06,15.5 9,16 9,16.5V17H7V15Z" />
                </svg>
            </span>
            <span class="text">Rekap Pemasukan</span>
        </a>
        <ul id="bendahara_rekap_pemasukan"
            class="{{ Request::routeIs('bendahara.rekap-pemasukan.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('bendahara.rekap-pemasukan.data-pembayaran') }}"
                    class="{{ Request::routeIs('bendahara.rekap-pemasukan.data-pembayaran') ? 'active' : '' }}">Data Pembayaran Siswa</a>
            </li>
            <li>
                <a href="{{ route('bendahara.rekap-pemasukan.data-pemasukan') }}"
                class="{{ Request::routeIs('bendahara.rekap-pemasukan.data-pemasukan') ? 'active' : '' }}">Data Pemasukan</a>
            </li>
            <li>
                <a href="{{ route('bendahara.rekap-pemasukan.rekap-harian-pemasukan') }}"
                    class="{{ Request::routeIs('bendahara.rekap-pemasukan.rekap-harian-pemasukan') ? 'active' : '' }}">Rekap Harian Pemasukan</a>
            </li>
            <li>
                <a href="{{ route('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan') }}"
                    class="{{ Request::routeIs('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan') ? 'active' : '' }}">Rekap Tahunan Pemasukan</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bendahara_rekap_pengeluaran"
            aria-controls="bendahara_rekap_pengeluaran" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M15.5,12C18,12 20,14 20,16.5C20,17.38 19.75,18.21 19.31,18.9L22.39,22L21,23.39L17.88,20.32C17.19,20.75 16.37,21 15.5,21C13,21 11,19 11,16.5C11,14 13,12 15.5,12M15.5,14A2.5,2.5 0 0,0 13,16.5A2.5,2.5 0 0,0 15.5,19A2.5,2.5 0 0,0 18,16.5A2.5,2.5 0 0,0 15.5,14M7,15V17H9C9.14,18.55 9.8,19.94 10.81,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19A2,2 0 0,1 21,5V13.03C19.85,11.21 17.82,10 15.5,10C14.23,10 13.04,10.37 12.04,11H7V13H10C9.64,13.6 9.34,14.28 9.17,15H7M17,9V7H7V9H17Z" />
                </svg>
            </span>
            <span class="text">Rekap Pengeluaran</span>
        </a>
        <ul id="bendahara_rekap_pengeluaran"
            class="{{ Request::routeIs('bendahara.rekap-pengeluaran.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('bendahara.rekap-pengeluaran.data-pengeluaran') }}"
                class="{{ Request::routeIs('bendahara.rekap-pengeluaran.data-pengeluaran') ? 'active' : '' }}">Data Pengeluaran</a>
            </li>
            <li>
                <a href="{{ route('bendahara.rekap-pengeluaran.rekap-harian-pengeluaran') }}"
                    class="{{ Request::routeIs('bendahara.rekap-pengeluaran.rekap-harian-pengeluaran') ? 'active' : '' }}">Rekap Harian Pengeluaran</a>
            </li>
            <li>
                <a href="{{ route('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran') }}"
                    class="{{ Request::routeIs('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran') ? 'active' : '' }}">Rekap Tahunan Pengeluaran</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bendahara_kas"
            aria-controls="bendahara_kas" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon">
                <svg style="width:22px;height:22px" viewBox="0 0 22 22">
                    <path fill="currentColor" d="M17.45,15.18L22,7.31V19L22,21H2V3H4V15.54L9.5,6L16,9.78L20.24,2.45L21.97,3.45L16.74,12.5L10.23,8.75L4.31,19H6.57L10.96,11.44L17.45,15.18Z" />
                </svg>
            </span>
            <span class="text">KAS</span>
        </a>
        <ul id="bendahara_kas"
            class="{{ Request::routeIs('bendahara.kas.*') ? '' : 'collapse' }} dropdown-nav">
            <li>
                <a href="{{ route('bendahara.kas.kas-bulanan') }}"
                class="{{ Request::routeIs('bendahara.kas.kas-bulanan') ? 'active' : '' }}">KAS Bulanan</a>
            </li>
            <li>
                <a href="{{ route('bendahara.kas.kas-tahunan') }}"
                class="{{ Request::routeIs('bendahara.kas.kas-tahunan') ? 'active' : '' }}">KAS Tahunan</a>
            </li>
        </ul>
    </li>
    <span class="divider">
        <hr />
    </span>
</ul>
