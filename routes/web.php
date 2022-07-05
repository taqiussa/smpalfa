<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Konseling\Layanan\DetailBimbinganController;
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
use App\Http\Livewire\Admin\User\TableUser;
use App\Http\Livewire\Guru\Absensi\AbsensiSiswa as AbsensiAbsensiSiswa;
use App\Http\Livewire\Guru\Penilaian\InputNilai;
use App\Http\Livewire\Guru\Penilaian\InputNilaiEkstra;
use App\Http\Livewire\Guru\Penilaian\InputNilaiSikap;
use App\Http\Livewire\Guru\Penilaian\InputPrestasi;
use App\Http\Livewire\Guru\Penilaian\UploadNilai;
use App\Http\Livewire\Guru\Rapor\CetakRapor;
use App\Http\Livewire\Guru\Skor\InputSkor;
use App\Http\Livewire\Guru\Skor\SaldoSkor;
use App\Http\Livewire\Guru\WaliKelas\InputCatatan;
use App\Http\Livewire\Guru\WaliKelas\InputSkor as WaliKelasInputSkor;
use App\Http\Livewire\Konseling\Absensi\AbsensiBk;
use App\Http\Livewire\Konseling\Absensi\AbsensiSiswa;
use App\Http\Livewire\Konseling\Absensi\ListKehadiran;
use App\Http\Livewire\Konseling\Absensi\RekapKehadiran;
use App\Http\Livewire\Konseling\Layanan\Bimbingan;
use App\Http\Livewire\Konseling\Layanan\RekapBimbingan;
use App\Http\Livewire\Konseling\Skor\PencarianSkor;
use App\Http\Livewire\Konseling\Skor\RekapSkor;
use App\Http\Livewire\Konseling\Skor\RekapSkorPrint;
use App\Http\Livewire\Kurikulum\Kurikulum\MataPelajaran as KurikulumMataPelajaran;
use App\Http\Livewire\Kurikulum\Kurikulum\TableKurikulum as KurikulumTableKurikulum;
use App\Http\Livewire\Kurikulum\MataPelajaran\TableGuru as MataPelajaranTableGuru;
use App\Http\Livewire\Kurikulum\MataPelajaran\TableMataPelajaran as MataPelajaranTableMataPelajaran;
use App\Http\Livewire\Kurikulum\Penilaian\Ekstrakurikuler as PenilaianEkstrakurikuler;
use App\Http\Livewire\Kurikulum\Penilaian\JenisPenilaian as PenilaianJenisPenilaian;
use App\Http\Livewire\Kurikulum\Penilaian\KategoriPenilaian as PenilaianKategoriPenilaian;
use App\Http\Livewire\Kurikulum\Rapor\Kd;
use App\Http\Livewire\Kurikulum\Rapor\RaporKd as RaporRaporKd;
use App\Http\Livewire\Kurikulum\Rapor\RaporKkm as RaporRaporKkm;
use App\Http\Livewire\Kurikulum\Rapor\SetPenilaianRapor as RaporSetPenilaianRapor;
use App\Http\Livewire\Kurikulum\Rapor\TanggalRapor;
use App\Http\Livewire\Kurikulum\Rapor\UploadKdRapor as RaporUploadKdRapor;
use App\Http\Livewire\Sarpras\Inventaris\DataInventaris;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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



        Route::get('/admin/home', function () {
            sleep(2);
            return view('admin/home');
        })->name('admin.home');
    });

    //Route For Guru
    Route::middleware(['role:Guru'])->group(function () {
        //Menu Absensi
        Route::get('guru/absensi/absensi-siswa', AbsensiAbsensiSiswa::class)->name('guru.absensi.absensi-siswa');

        //Menu Penilaian
        Route::get('guru/penilaian/input-nilai', InputNilai::class)->name('guru.penilaian.input-nilai');
        Route::get('guru/penilaian/input-nilai-ekstra', InputNilaiEkstra::class)->name('guru.penilaian.input-nilai-ekstra');
        Route::get('guru/penilaian/input-nilai-sikap', InputNilaiSikap::class)->name('guru.penilaian.input-nilai-sikap');
        Route::get('guru/penilaian/input-prestasi', InputPrestasi::class)->name('guru.penilaian.input-prestasi');
        Route::get('guru/penilaian/upload-nilai', UploadNilai::class)->name('guru.penilaian.upload-nilai');

        //Menu Rapor
        Route::get('guru/rapor/cetak-rapor', CetakRapor::class)->name('guru.rapor.cetak-rapor');
        Route::get('guru/rapor/pdf', [HomeController::class, 'pdf'])->name('guru.rapor.pdf-rapor');
        Route::get('guru/rapor/rapor-print', [PrintRaporController::class, 'index'])->name('guru.rapor.rapor-print');
        Route::get('guru/rapor/rapor-print-v', [PrintRaporController::class, 'indexv'])->name('guru.rapor.rapor-print-v');

        //Menu Skor
        Route::get('guru/skor/input-skor', InputSkor::class)->name('guru.skor.input-skor');
        Route::get('guru/skor/saldo-skor', SaldoSkor::class)->name('guru.skor.saldo-skor');

        //Menu Wali Kelas
        Route::get('guru/wali-kelas/input-catatan', InputCatatan::class)->name('guru.wali-kelas.input-catatan');
        Route::get('guru/wali-kelas/input-skor', WaliKelasInputSkor::class)->name('guru.wali-kelas.input-skor');
    });

    // Route For Konseling
    Route::middleware(['role:Konseling'])->group(function () {
        //Menu Absensi
        Route::get('konseling/absensi/absensi-siswa', AbsensiSiswa::class)->name('konseling.absensi.absensi-siswa');
        Route::get('konseling/absensi/absensi-bk', AbsensiBk::class)->name('konseling.absensi.absensi-bk');
        Route::get('konseling/absensi/rekap-kehadiran', RekapKehadiran::class)->name('konseling.absensi.rekap-kehadiran');
        Route::get('konseling/absensi/list-kehadiran/{tanggal}/{jam}/{kehadiran}', ListKehadiran::class)->name('konseling.absensi.list-kehadiran');

        //Menu Layanan
        Route::get('konseling/layanan/bimbingan-dan-konseling', Bimbingan::class)->name('konseling.layanan.bimbingan');
        Route::get('konseling/layanan/rekap-bimbingan', RekapBimbingan::class)->name('konseling.layanan.rekap-bimbingan');
        Route::get('konseling/layanan/detail-bimbingan/{bk_detail}', [DetailBimbinganController::class, 'show'])->name('konseling.layanan.detail-bimbingan');

        //Menu Skor
        Route::get('konseling/skor/input-skor', InputSkor::class)->name('konseling.skor.input-skor');
        Route::get('konseling/skor/pencarian', PencarianSkor::class)->name('konseling.skor.pencarian');
        Route::get('konseling/skor/rekap-skor', RekapSkor::class)->name('konseling.skor.rekap-skor');
        Route::get('konseling/skor/rekap-skor-print', RekapSkorPrint::class)->name('konseling.skor.rekap-skor-print');
        Route::get('konseling/skor/rekap-skor-perkelas', [RekapSkorPrintController::class, 'perkelas'])->name('konseling.skor.rekap-skor-perkelas');
        Route::get('konseling/skor/rekap-skor-persiswa', [RekapSkorPrintController::class, 'persiswa'])->name('konseling.skor.rekap-skor-persiswa');
        Route::get('konseling/skor/saldo-skor', SaldoSkor::class)->name('konseling.skor.saldo-skor');
    });

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
});
