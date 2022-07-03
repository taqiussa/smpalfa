<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Konseling\Layanan\DetailBimbinganController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PrintRaporController;
use App\Http\Livewire\Admin\Dashboard;
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
use App\Http\Livewire\Guru\WaliKelas\InputCatatan;
use App\Http\Livewire\Konseling\Absensi\AbsensiBk;
use App\Http\Livewire\Konseling\Absensi\AbsensiSiswa;
use App\Http\Livewire\Konseling\Absensi\ListKehadiran;
use App\Http\Livewire\Konseling\Absensi\RekapKehadiran;
use App\Http\Livewire\Konseling\Layanan\Bimbingan;
use App\Http\Livewire\Konseling\Layanan\RekapBimbingan;
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
        Route::get('guru/rapor/pdf', [HomeController::class,'pdf'])->name('guru.rapor.pdf-rapor');
        Route::get('guru/rapor/rapor-print', [PrintRaporController::class, 'index'])->name('guru.rapor.rapor-print');
        Route::get('guru/rapor/rapor-print-v', [PrintRaporController::class, 'indexv'])->name('guru.rapor.rapor-print-v');

        //Menu Wali Kelas
        Route::get('guru/wali-kelas/input-catatan', InputCatatan::class)->name('guru.wali-kelas.input-catatan');
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

        Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
        Route::get('/admin/home', function () {
            sleep(2);
            return view('admin/home');
        })->name('admin.home');
        
    });

    //Route For Sarpras
    Route::middleware(['role:Sarpras'])->group(function () {
        //Menu Inventaris
        Route::get('sarpras/inventaris/data-inventaris', DataInventaris::class)->name('sarpras.inventaris.data-inventaris');
    });
});