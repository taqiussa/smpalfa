<?php

use App\Http\Controllers\BendaharaPrintController;
use App\Http\Controllers\DaftarNilaiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Konseling\Layanan\DetailBimbinganController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrintAlquranController;
use App\Http\Controllers\PrintRaporController;
use App\Http\Controllers\RekapSkorPrintController;
use App\Http\Livewire\Admin\Kelas\WaliKelas;
use App\Http\Livewire\Admin\Kurikulum\MataPelajaran;
use App\Http\Livewire\Admin\Kurikulum\TableKurikulum;
use App\Http\Livewire\Admin\MataPelajaran\TableGuru;
use App\Http\Livewire\Admin\MataPelajaran\TableMataPelajaran;
use App\Http\Livewire\Admin\Penilaian\Ekstrakurikuler;
use App\Http\Livewire\Admin\Penilaian\JenisPenilaian;
use App\Http\Livewire\Admin\Penilaian\KategoriPenilaian;
use App\Http\Livewire\Admin\Rapor\Kd as RaporKd;
use App\Http\Livewire\Admin\Rapor\Kkm as RaporKkm;
use App\Http\Livewire\Admin\Rapor\SetPenilaianRapor;
use App\Http\Livewire\Admin\Rapor\TanggalRapor as RaporTanggalRapor;
use App\Http\Livewire\Admin\Rapor\UploadKdRapor;
use App\Http\Livewire\Admin\Role\TableRole;
use App\Http\Livewire\Admin\Skor\DataSkor;
use App\Http\Livewire\Admin\User\SetRole;
use App\Http\Livewire\Admin\User\SetUserSiswa;
use App\Http\Livewire\Admin\User\TableUser;
use App\Http\Livewire\Bendahara\Kas\KasBulanan;
use App\Http\Livewire\Bendahara\Kas\KasTahunan;
use App\Http\Livewire\Bendahara\Pengaturan\Gunabayar;
use App\Http\Livewire\Bendahara\Pengaturan\KategoriPemasukan;
use App\Http\Livewire\Bendahara\Pengaturan\KategoriPengeluaran;
use App\Http\Livewire\Bendahara\Pengaturan\WajibBayar;
use App\Http\Livewire\Bendahara\Rekap\DataPemasukan;
use App\Http\Livewire\Bendahara\Rekap\DataPembayaran;
use App\Http\Livewire\Bendahara\Rekap\DataPengeluaran;
use App\Http\Livewire\Bendahara\Rekap\RekapHarian;
use App\Http\Livewire\Bendahara\Rekap\RekapHarianPengeluaran;
use App\Http\Livewire\Bendahara\Rekap\RekapTahunan;
use App\Http\Livewire\Bendahara\Rekap\RekapTahunanPengeluaran;
use App\Http\Livewire\Bendahara\Transaksi\Pemasukan;
use App\Http\Livewire\Bendahara\Transaksi\PembayaranSiswa;
use App\Http\Livewire\Bendahara\Transaksi\Pengeluaran;
use App\Http\Livewire\Bendahara\Transaksi\TransaksiPembayaran;
use App\Http\Livewire\Guru\Ekstra\AbsensiEkstra;
use App\Http\Livewire\Guru\Absensi\AbsensiSiswa as AbsensiAbsensiSiswa;
use App\Http\Livewire\Guru\Alquran\InputNilai as AlquranInputNilai;
use App\Http\Livewire\Guru\Alquran\PrintNilai;
use App\Http\Livewire\Guru\Ekstra\AbsensiEkstraPrint;
use App\Http\Livewire\Guru\Ekstra\InputNilaiEkstra;
use App\Http\Livewire\Guru\Penilaian\InputNilai;
use App\Http\Livewire\Guru\Penilaian\InputNilaiSikap;
use App\Http\Livewire\Guru\Penilaian\InputPrestasi;
use App\Http\Livewire\Guru\Penilaian\UploadAnalisis;
use App\Http\Livewire\Guru\Penilaian\UploadNilai;
use App\Http\Livewire\Guru\Rapor\CetakRapor;
use App\Http\Livewire\Guru\Rapor\DaftarNilaiGuru;
use App\Http\Livewire\Guru\Skor\InputSkor;
use App\Http\Livewire\Guru\Skor\SaldoSkor;
use App\Http\Livewire\Guru\WaliKelas\DaftarNilaiKelas;
use App\Http\Livewire\Guru\WaliKelas\DownloadDataSiswa;
use App\Http\Livewire\Guru\WaliKelas\InputCatatan;
use App\Http\Livewire\Guru\WaliKelas\InputSkor as WaliKelasInputSkor;
use App\Http\Livewire\Kesiswaan\Ekstrakurikuler\PendaftaranSiswa;
use App\Http\Livewire\Konseling\Absensi\AbsensiBk;
use App\Http\Livewire\Konseling\Absensi\AbsensiSiswa;
use App\Http\Livewire\Konseling\Absensi\CekListAbsensi;
use App\Http\Livewire\Konseling\Absensi\ListKehadiran;
use App\Http\Livewire\Konseling\Absensi\RekapKehadiran;
use App\Http\Livewire\Konseling\Layanan\Bimbingan;
use App\Http\Livewire\Konseling\Layanan\RekapBimbingan;
use App\Http\Livewire\Konseling\Skor\PencarianSkor;
use App\Http\Livewire\Konseling\Skor\RekapSkor;
use App\Http\Livewire\Konseling\Skor\RekapSkorPrint;
use App\Http\Livewire\Kreator\Post\BuatPost;
use App\Http\Livewire\Kreator\Post\ListPost;
use App\Http\Livewire\Kurikulum\Kurikulum\MataPelajaran as KurikulumMataPelajaran;
use App\Http\Livewire\Kurikulum\Kurikulum\TableKurikulum as KurikulumTableKurikulum;
use App\Http\Livewire\Kurikulum\MataPelajaran\TableGuru as MataPelajaranTableGuru;
use App\Http\Livewire\Kurikulum\MataPelajaran\TableMataPelajaran as MataPelajaranTableMataPelajaran;
use App\Http\Livewire\Kurikulum\Penilaian\Ekstrakurikuler as PenilaianEkstrakurikuler;
use App\Http\Livewire\Kurikulum\Penilaian\JenisPenilaian as PenilaianJenisPenilaian;
use App\Http\Livewire\Kurikulum\Penilaian\KategoriPenilaian as PenilaianKategoriPenilaian;
use App\Http\Livewire\Kurikulum\Rapor\RaporKd as RaporRaporKd;
use App\Http\Livewire\Kurikulum\Rapor\RaporKkm as RaporRaporKkm;
use App\Http\Livewire\Kurikulum\Rapor\SetPenilaianRapor as RaporSetPenilaianRapor;
use App\Http\Livewire\Kurikulum\Rapor\TanggalRapor;
use App\Http\Livewire\Kurikulum\Rapor\UploadKdRapor as RaporUploadKdRapor;
use App\Http\Livewire\Landing\Posts;
use App\Http\Livewire\Sarpras\Inventaris\DataInventaris;
use App\Http\Livewire\Siswa\Administrasi;
use App\Http\Livewire\Siswa\AlquranBilGhoib;
use App\Http\Livewire\Siswa\AlquranBinNadzor;
use App\Http\Livewire\Siswa\Bimbingan as SiswaBimbingan;
use App\Http\Livewire\Siswa\DataSkor as SiswaDataSkor;
use App\Http\Livewire\Siswa\Kehadiran;
use App\Http\Livewire\Siswa\Nilai;
use App\Http\Livewire\TataUsaha\Siswa\AturKelasSiswa;
use App\Http\Livewire\TataUsaha\Siswa\CariSiswa;
use App\Http\Livewire\TataUsaha\Siswa\DataSiswa;
use App\Http\Livewire\TataUsaha\Siswa\EditDataSiswa;
use App\Http\Livewire\TataUsaha\Siswa\HapusSiswa;
use App\Http\Livewire\TataUsaha\Siswa\PindahKelasSiswa;
use App\Http\Livewire\TataUsaha\Siswa\TambahSiswa;
use App\Http\Livewire\User\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [LandingController::class,'index'])->name('landing');
Route::get('/', Posts::class)->name('landing');
Route::get('/detail/{slug}', [LandingController::class, 'detail'])->name('landing.detail');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('user/profile', Profile::class)->name('user.profile');

    // Route For Admin
    Route::middleware(['role:Admin'])->group(function () {
        //Menu Kelas
        Route::get('admin/kelas/wali-kelas', WaliKelas::class)->name('admin.kelas.wali-kelas');

        //Menu Kurikulum
        Route::get('admin/kurikulum/table-kurikulum', TableKurikulum::class)->name('admin.kurikulum.table-kurikulum');
        Route::get('admin/kurikulum/mata-pelajaran', MataPelajaran::class)->name('admin.kurikulum.mata-pelajaran');

        //Menu Mata Pelajaran
        Route::get('admin/mata-pelajaran/table-mata-pelajaran', TableMataPelajaran::class)->name('admin.mata-pelajaran.table-mata-pelajaran');
        Route::get('admin/mata-pelajaran/table-guru', TableGuru::class)->name('admin.mata-pelajaran.table-guru');

        //Menu Penilaian
        Route::get('admin/penilaian/ekstrakurikuler', Ekstrakurikuler::class)->name('admin.penilaian.ekstrakurikuler');
        Route::get('admin/penilaian/jenis-penilaian', JenisPenilaian::class)->name('admin.penilaian.jenis-penilaian');
        Route::get('admin/penilaian/kategori-penilaian', KategoriPenilaian::class)->name('admin.penilaian.kategori-penilaian');

        //Menu Rapor
        Route::get('admin/rapor/kd', RaporKd::class)->name('admin.rapor.kd');
        Route::get('admin/rapor/upload-kd-rapor', UploadKdRapor::class)->name('admin.rapor.upload-kd-rapor');
        Route::get('admin/rapor/kkm', RaporKkm::class)->name('admin.rapor.kkm');
        Route::get('admin/rapor/set-penilaian-rapor', SetPenilaianRapor::class)->name('admin.rapor.set-penilaian-rapor');
        Route::get('admin/rapor/tanggal-rapor', RaporTanggalRapor::class)->name('admin.rapor.tanggal-rapor');

        //Menu Role
        Route::get('admin/role/table-role', TableRole::class)->name('admin.role.table-role');

        //Menu Skor
        Route::get('admin/skor/data-skor', DataSkor::class)->name('admin.skor.data-skor');

        //Menu User
        Route::get('admin/user/table-user', TableUser::class)->name('admin.user.table-user');
        Route::get('admin/user/set-role', SetRole::class)->name('admin.user.set-role');
        Route::get('admin/user/set-user', SetUserSiswa::class)->name('admin.user.set-user');


        Route::get('/admin/home', function () {
            sleep(2);
            return view('admin/home');
        })->name('admin.home');
    });

    //Route For Bendahara
    Route::middleware(['role:Bendahara'])->group(function () {

        //Menu Pengaturan
        Route::get('bendahara/pengaturan/atur-wajib-bayar', WajibBayar::class)->name('bendahara.pengaturan.atur-wajib-bayar');
        Route::get('bendahara/pengaturan/kategori-pemasukan', KategoriPemasukan::class)->name('bendahara.pengaturan.kategori-pemasukan');
        Route::get('bendahara/pengaturan/gunabayar', Gunabayar::class)->name('bendahara.pengaturan.gunabayar');
        Route::get('bendahara/pengaturan/kategori-pengeluaran', KategoriPengeluaran::class)->name('bendahara.pengaturan.kategori-pengeluaran');


        //Menu Transaksi
        // Route::get('bendahara/transaksi/pembayaran-siswa', PembayaranSiswa::class)->name('bendahara.transaksi.pembayaran-siswa');
        Route::get('bendahara/transaksi/pembayaran-siswa', TransaksiPembayaran::class)->name('bendahara.transaksi.pembayaran-siswa');
        Route::get('bendahara/transaksi/pemasukan', Pemasukan::class)->name('bendahara.transaksi.pemasukan');
        Route::get('bendahara/transaksi/pengeluaran', Pengeluaran::class)->name('bendahara.transaksi.pengeluaran');

        // Print
        Route::get('bendahara/transaksi/pembayaran-siswa-print', [BendaharaPrintController::class, 'pembayaran_siswa'])->name('bendahara.transaksi.pembayaran-siswa-print');
        Route::get('bendahara/rekap-pemasukan/rekap-harian-pemasukan-print', [BendaharaPrintController::class, 'rekap_pemasukan_harian'])->name('bendahara.rekap-pemasukan.rekap-harian-pemasukan-print');
        Route::get('bendahara/rekap-pemasukan/rekap-harian-pemasukan-print-simple', [BendaharaPrintController::class, 'rekap_pemasukan_harian_simple'])->name('bendahara.rekap-pemasukan.rekap-harian-pemasukan-print-simple');
        Route::get('bendahara/rekap-pemasukan/rekap-tahun-pemasukan-print', [BendaharaPrintController::class, 'rekap_pemasukan_tahunan'])->name('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan-print');
        Route::get('bendahara/rekap-pemasukan/rekap-tahun-pemasukan-print-simple', [BendaharaPrintController::class, 'rekap_pemasukan_tahunan_simple'])->name('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan-print-simple');
        Route::get('bendahara/rekap-pengeluaran/rekap-harian-pengeluaran-print', [BendaharaPrintController::class, 'rekap_pengeluaran_harian'])->name('bendahara.rekap-pengeluaran.rekap-harian-pengeluaran-print');
        Route::get('bendahara/rekap-pengeluaran/rekap-harian-pengeluaran-print-simple', [BendaharaPrintController::class, 'rekap_pengeluaran_harian_simple'])->name('bendahara.rekap-pengeluaran.rekap-harian-pengeluaran-print-simple');
        Route::get('bendahara/rekap-pengeluaran/rekap-tahun-pengeluaran-print', [BendaharaPrintController::class, 'rekap_pengeluaran_tahunan'])->name('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran-print');
        Route::get('bendahara/rekap-pengeluaran/rekap-tahun-pengeluaran-print-simple', [BendaharaPrintController::class, 'rekap_pengeluaran_tahunan_simple'])->name('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran-print-simple');

        // Menu Rekap Pemasukan
        Route::get('bendahara/rekap-pemasukan/data-pemasukan', DataPemasukan::class)->name('bendahara.rekap-pemasukan.data-pemasukan');
        Route::get('bendahara/rekap-pemasukan/data-pembayaran', DataPembayaran::class)->name('bendahara.rekap-pemasukan.data-pembayaran');
        Route::get('bendahara/rekap-pemasukan/rekap-harian-pemasukan', RekapHarian::class)->name('bendahara.rekap-pemasukan.rekap-harian-pemasukan');
        Route::get('bendahara/rekap-pemasukan/rekap-tahunan-pemasukan', RekapTahunan::class)->name('bendahara.rekap-pemasukan.rekap-tahunan-pemasukan');

        // Menu Rekap Pengeluaran
        Route::get('bendahara/rekap-pengeluaran/data-pengeluaran', DataPengeluaran::class)->name('bendahara.rekap-pengeluaran.data-pengeluaran');
        Route::get('bendahara/rekap-pengeluaran/rekap-harian-pengeluaran', RekapHarianPengeluaran::class)->name('bendahara.rekap-pengeluaran.rekap-harian-pengeluaran');
        Route::get('bendahara/rekap-pengeluaran/rekap-tahunan-pengeluaran', RekapTahunanPengeluaran::class)->name('bendahara.rekap-pengeluaran.rekap-tahunan-pengeluaran');

        // Menu KAS
        Route::get('bendahara/kas/kas-bulanan', KasBulanan::class)->name('bendahara.kas.kas-bulanan');
        Route::get('bendahara/kas/kas-tahunan', KasTahunan::class)->name('bendahara.kas.kas-tahunan');
        Route::get('bendahara/kas/kas-bulanan-print', [BendaharaPrintController::class, 'kas_bulanan'])->name('bendahara.kas.kas-bulanan-print');
        Route::get('bendahara/kas/kas-tahunan-print', [BendaharaPrintController::class, 'kas_tahunan'])->name('bendahara.kas.kas-tahunan-print');
    });

    //Route For Guru
    Route::middleware(['role:Guru'])->group(function () {
        //Menu Absensi
        Route::get('guru/absensi/absensi-bk', AbsensiBk::class)->name('guru.absensi.absensi-bk');
        Route::get('guru/absensi/absensi-siswa', AbsensiAbsensiSiswa::class)->name('guru.absensi.absensi-siswa');

        // Menu Alquran
        Route::get('guru/alquran/input-nilai', AlquranInputNilai::class)->name('guru.alquran.input-nilai');
        Route::get('guru/alquran/print-nilai', PrintNilai::class)->name('guru.alquran.print-nilai');
        Route::get('guru/alquran/print-nilai-print', [PrintAlquranController::class, 'index'])->name('guru.alquran.print-nilai-print');

        //Menu Ekstrakurikuler
        // Route::get('guru/ekstrakurikuler/absensi-ekstrakurikuler', AbsensiEkstra::class)->name('guru.ekstrakurikuler.absensi-ekstrakurikuler');
        Route::get('guru/ekstrakurikuler/absensi-ekstrakurikuler', AbsensiEkstra::class)->name('guru.ekstrakurikuler.absensi-ekstrakurikuler');
        Route::get('guru/ekstrakurikuler/absensi-ekstrakurikuler-print', AbsensiEkstraPrint::class)->name('guru.ekstrakurikuler.absensi-ekstrakurikuler-print');
        Route::get('guru/ekstrakurikuler/input-nilai-ekstra', InputNilaiEkstra::class)->name('guru.ekstrakurikuler.input-nilai-ekstra');

        //Menu Penilaian
        Route::get('guru/penilaian/input-nilai', InputNilai::class)->name('guru.penilaian.input-nilai');
        // Route::get('guru/penilaian/input-nilai-ekstra', InputNilaiEkstra::class)->name('guru.penilaian.input-nilai-ekstra');
        Route::get('guru/penilaian/input-nilai-sikap', InputNilaiSikap::class)->name('guru.penilaian.input-nilai-sikap');
        Route::get('guru/penilaian/input-prestasi', InputPrestasi::class)->name('guru.penilaian.input-prestasi');
        Route::get('guru/penilaian/upload-analisis', UploadAnalisis::class)->name('guru.penilaian.upload-analisis');
        Route::get('guru/penilaian/upload-nilai', UploadNilai::class)->name('guru.penilaian.upload-nilai');

        //Menu Rapor
        Route::get('guru/rapor/cetak-rapor', CetakRapor::class)->name('guru.rapor.cetak-rapor');
        Route::get('guru/rapor/pdf', [HomeController::class, 'pdf'])->name('guru.rapor.pdf-rapor');
        Route::get('guru/rapor/rapor-print', [PrintRaporController::class, 'index'])->name('guru.rapor.rapor-print');
        Route::get('guru/rapor/rapor-print-v', [PrintRaporController::class, 'indexv'])->name('guru.rapor.rapor-print-v');
        Route::get('guru/rapor/daftar-nilai-guru', DaftarNilaiGuru::class)->name('guru.rapor.daftar-nilai-guru');
        Route::get('guru/rapor/daftar-nilai-guru-print', [DaftarNilaiController::class, 'nilai_guru'])->name('guru.rapor.daftar-nilai-guru-print');


        //Menu Skor
        Route::get('guru/skor/input-skor', InputSkor::class)->name('guru.skor.input-skor');
        Route::get('guru/skor/saldo-skor', SaldoSkor::class)->name('guru.skor.saldo-skor');

        //Menu Wali Kelas
        Route::get('guru/wali-kelas/daftar-nilai-kelas', DaftarNilaiKelas::class)->name('guru.wali-kelas.daftar-nilai-kelas');
        Route::get('guru/wali-kelas/daftar-nilai-kelas-print', [DaftarNilaiController::class, 'nilai_kelas'])->name('guru.wali-kelas.daftar-nilai-kelas-print');
        Route::get('guru/wali-kelas/download-data-siswa', DownloadDataSiswa::class)->name('guru.wali-kelas.download-data-siswa');
        Route::get('guru/wali-kelas/input-catatan', InputCatatan::class)->name('guru.wali-kelas.input-catatan');
        Route::get('guru/wali-kelas/input-skor', WaliKelasInputSkor::class)->name('guru.wali-kelas.input-skor');
    
    });

    // Route For Kesiswaan
    Route::middleware(['role:Kesiswaan'])->group(function () {
        Route::get('kesiswaan/ekstrakurikuler/pendaftaran-siswa', PendaftaranSiswa::class)->name('kesiswaan.ekstrakurikuler.pendaftaran-siswa');
    });

    // Route For Konseling
    Route::middleware(['role:Konseling'])->group(function () {
        //Menu Absensi
        Route::get('konseling/absensi/absensi-siswa', AbsensiSiswa::class)->name('konseling.absensi.absensi-siswa');
        Route::get('konseling/absensi/absensi-bk', AbsensiBk::class)->name('konseling.absensi.absensi-bk');
        Route::get('konseling/absensi/rekap-kehadiran', RekapKehadiran::class)->name('konseling.absensi.rekap-kehadiran');
        Route::get('konseling/absensi/cek-list-absensi', CekListAbsensi::class)->name('konseling.absensi.cek-list-absensi');
        Route::get('konseling/absensi/list-kehadiran/{tanggal}/{jam}/{kehadiran}', ListKehadiran::class)->name('konseling.absensi.list-kehadiran');

        // Menu Data Siswa
        Route::get('konseling/siswa/cari-siswa', CariSiswa::class)->name('konseling.siswa.cari-siswa');

        //Menu Layanan
        Route::get('konseling/layanan/bimbingan-dan-konseling', Bimbingan::class)->name('konseling.layanan.bimbingan');
        Route::get('konseling/layanan/rekap-bimbingan', RekapBimbingan::class)->name('konseling.layanan.rekap-bimbingan');
        Route::get('konseling/layanan/detail-bimbingan/{bk_detail}', [DetailBimbinganController::class, 'show'])->name('konseling.layanan.detail-bimbingan');

        //Menu Skor
        Route::get('konseling/skor/data-skor', DataSkor::class)->name('konseling.skor.data-skor');
        Route::get('konseling/skor/input-skor', InputSkor::class)->name('konseling.skor.input-skor');
        Route::get('konseling/skor/pencarian', PencarianSkor::class)->name('konseling.skor.pencarian');
        Route::get('konseling/skor/rekap-skor', RekapSkor::class)->name('konseling.skor.rekap-skor');
        Route::get('konseling/skor/rekap-skor-print', RekapSkorPrint::class)->name('konseling.skor.rekap-skor-print');
        Route::get('konseling/skor/rekap-skor-perkelas', [RekapSkorPrintController::class, 'perkelas'])->name('konseling.skor.rekap-skor-perkelas');
        Route::get('konseling/skor/rekap-skor-persiswa', [RekapSkorPrintController::class, 'persiswa'])->name('konseling.skor.rekap-skor-persiswa');
        Route::get('konseling/skor/saldo-skor', SaldoSkor::class)->name('konseling.skor.saldo-skor');
    });

    // Route For Kreator
    Route::middleware(['role:Kreator'])->group(function () {

        //Menu Postingan
        Route::get('kreator/post/buat-post', BuatPost::class)->name('kreator.post.buat-post');
        Route::get('kreator/post/list-post', ListPost::class)->name('kreator.post.list-post');
        Route::get('kreator/post/list-post/detail/{slug}', [PostController::class, 'detail'])->name('kreator.post.list-post.detail');
    });

    // Route For Kurikulum
    Route::middleware(['role:Kurikulum'])->group(function () {

        //Menu Kurikulum
        Route::get('kurikulum/kurikulum/table-kurikulum', KurikulumTableKurikulum::class)->name('kurikulum.kurikulum.table-kurikulum');
        Route::get('kurikulum/kurikulum/mata-pelajaran', KurikulumMataPelajaran::class)->name('kurikulum.kurikulum.mata-pelajaran');

        //Menu Mata Pelajaran
        Route::get('kurikulum/mata-pelajaran/table-guru', MataPelajaranTableGuru::class)->name('kurikulum.mata-pelajaran.table-guru');
        Route::get('kurikulum/mata-pelajaran/table-mata-pelajaran', MataPelajaranTableMataPelajaran::class)->name('kurikulum.mata-pelajaran.table-mata-pelajaran');

        //Menu Penilaian
        Route::get('kurikulum/penilaian/ekstrakurikuler', PenilaianEkstrakurikuler::class)->name('kurikulum.penilaian.ekstrakurikuler');
        Route::get('kurikulum/penilaian/jenis-penilaian', PenilaianJenisPenilaian::class)->name('kurikulum.penilaian.jenis-penilaian');
        Route::get('kurikulum/penilaian/kategori-penilaian', PenilaianKategoriPenilaian::class)->name('kurikulum.penilaian.kategori-penilaian');

        //Menu Rapor
        Route::get('kurikulum/rapor/kd', RaporRaporKd::class)->name('kurikulum.rapor.kd');
        Route::get('kurikulum/rapor/upload-kd-rapor', RaporUploadKdRapor::class)->name('kurikulum.rapor.upload-kd-rapor');
        Route::get('kurikulum/rapor/kkm', RaporRaporKkm::class)->name('kurikulum.rapor.kkm');
        Route::get('kurikulum/rapor/set-penilaian-rapor', RaporSetPenilaianRapor::class)->name('kurikulum.rapor.set-penilaian-rapor');
        Route::get('kurikulum/rapor/tanggal-rapor', TanggalRapor::class)->name('kurikulum.rapor.tanggal-rapor');
    });

    //Route For Sarpras
    Route::middleware(['role:Sarpras'])->group(function () {
        //Menu Inventaris
        Route::get('sarpras/inventaris/data-inventaris', DataInventaris::class)->name('sarpras.inventaris.data-inventaris');
    });

    // Route For Siswa
    Route::middleware(['role:Siswa'])->group(function () {

        // Administrasi
        Route::get('siswa/administrasi', Administrasi::class)->name('siswa.administrasi');

        //Alquran
        Route::get('siswa/alquran/bil-ghoib', AlquranBilGhoib::class)->name('siswa.alquran.bil-ghoib');
        Route::get('siswa/alquran/bin-nadzor', AlquranBinNadzor::class)->name('siswa.alquran.bin-nadzor');

        // Data Bimbingan
        Route::get('siswa/data-bimbingan', SiswaBimbingan::class)->name('siswa.data-bimbingan');
        
        // Data Skor
        Route::get('siswa/data-skor', SiswaDataSkor::class)->name('siswa.data-skor');

        // Kehadiran
        Route::get('siswa/kehadiran', Kehadiran::class)->name('siswa.kehadiran');

        // Nilai
        Route::get('siswa/nilai', Nilai::class)->name('siswa.nilai');
    });

    //Route For Tata Usaha
    Route::middleware(['role:Tata Usaha'])->group(function () {
        // Menu Siswa
        Route::get('tata-usaha/siswa/atur-kelas-siswa', AturKelasSiswa::class)->name('tata-usaha.siswa.atur-kelas-siswa');
        Route::get('tata-usaha/siswa/edit-data-siswa', EditDataSiswa::class)->name('tata-usaha.siswa.edit-data-siswa');
        Route::get('tata-usaha/siswa/cari-siswa', CariSiswa::class)->name('tata-usaha.siswa.cari-siswa');
        Route::get('tata-usaha/siswa/hapus-siswa', HapusSiswa::class)->name('tata-usaha.siswa.hapus-siswa');
        Route::get('tata-usaha/siswa/pindah-kelas-siswa', PindahKelasSiswa::class)->name('tata-usaha.siswa.pindah-kelas-siswa');
        Route::get('tata-usaha/siswa/tambah-siswa', TambahSiswa::class)->name('tata-usaha.siswa.tambah-siswa');
    });
});
