<?php

namespace App\Http\Controllers;

use App\Models\Gunabayar;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\Kelas;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;

class BendaharaPrintController extends Controller
{
    public function pembayaran_siswa()
    {
        $tanggal = request('tanggal');
        $nis = request('nis');
        $kelas = request('kelas');
        $siswa = request('siswa');
        $tahun = request('tahun');
        $pembayaran = Pembayaran::with('gunabayar')->where('tanggal', $tanggal)->where('nis', $nis)->get();
        $total = Pembayaran::where('tanggal', $tanggal)->where('nis', $nis)->sum('jumlah');
        $data = [
            'list_pembayaran' => $pembayaran,
            'tanggal' => $tanggal,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'tahun' => $tahun,
            'total' => $total,
        ];
        return view('pembayaran.print',$data);
    }

    // Pemasukan
    public function rekap_pemasukan_harian()
    {
        $tanggalawal = request('tanggalawal');
        $tanggalakhir = request('tanggalakhir');
        $subtotal_pemasukan = Pemasukan::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $subtotal_pembayaran = Pembayaran::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $total = $subtotal_pembayaran + $subtotal_pemasukan;
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'list_pembayaran' => Pembayaran::join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
            ->join('kelas', 'kelas.id', '=', 'pembayarans.kelas_id')
            ->join('users as siswa', 'siswa.nis', '=', 'pembayarans.nis')
            ->join('users as bendahara', 'bendahara.id', '=', 'pembayarans.user_id')
            ->select(
                'pembayarans.id as id',
                'pembayarans.tanggal as tanggal',
                'pembayarans.tahun as tahun',
                'pembayarans.jumlah as jumlah',
                'kelas.nama as kelas',
                'gunabayars.nama as gunabayar',
                'siswa.name as siswa',
                'bendahara.name as bendahara',
            )
            ->whereBetween('pembayarans.tanggal', [$tanggalawal, $tanggalakhir])
            ->orderBy('pembayarans.created_at', 'desc')
            ->get(),
            'subtotal_pembayaran' => $subtotal_pembayaran,
            'list_pemasukan' => Pemasukan::with(['kategori', 'user'])->whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->get(),
            'subtotal_pemasukan' => $subtotal_pemasukan,
            'total' => $total,
        ];
        return view('pemasukan.rekap-pemasukan-harian-print',$data);
    }
    public function rekap_pemasukan_tahunan()
    {
        $tahun = request('tahun');
        $subtotal_pemasukan = Pemasukan::where('tahun', $tahun)->sum('jumlah');
        $subtotal_pembayaran = Pembayaran::where('tahun', $tahun)->sum('jumlah');
        $total = $subtotal_pembayaran + $subtotal_pemasukan;
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tahun' => $tahun,
            'list_pembayaran' => Pembayaran::join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
            ->join('kelas', 'kelas.id', '=', 'pembayarans.kelas_id')
            ->join('users as siswa', 'siswa.nis', '=', 'pembayarans.nis')
            ->join('users as bendahara', 'bendahara.id', '=', 'pembayarans.user_id')
            ->select(
                'pembayarans.id as id',
                'pembayarans.tanggal as tanggal',
                'pembayarans.tahun as tahun',
                'pembayarans.jumlah as jumlah',
                'kelas.nama as kelas',
                'gunabayars.nama as gunabayar',
                'siswa.name as siswa',
                'bendahara.name as bendahara',
            )
            ->where('pembayarans.tahun', $tahun)
            ->orderBy('pembayarans.created_at', 'desc')
            ->get(),
            'subtotal_pembayaran' => $subtotal_pembayaran,
            'list_pemasukan' => Pemasukan::with(['kategori', 'user'])->where('tahun', $tahun)->get(),
            'subtotal_pemasukan' => $subtotal_pemasukan,
            'total' => $total,
        ];
        return view('pemasukan.rekap-pemasukan-tahunan-print',$data);
    }
    public function rekap_pemasukan_harian_simple()
    {
        $tanggalawal = request('tanggalawal');
        $tanggalakhir = request('tanggalakhir');
        $subtotal_pemasukan = Pemasukan::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $subtotal_pembayaran = Pembayaran::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $total = $subtotal_pembayaran + $subtotal_pemasukan;
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'subtotal_pembayaran' => $subtotal_pembayaran,
            'list_kategori' => KategoriPemasukan::where('nama','!=','SPP')->orderBy('nama')->get(),
            'total' => $total,
        ];
        return view('pemasukan.rekap-pemasukan-harian-print-simple',$data);
    }
    public function rekap_pemasukan_tahunan_simple()
    {
        $tahun = request('tahun');
        $subtotal_pemasukan = Pemasukan::where('tahun', $tahun)->sum('jumlah');
        $subtotal_pembayaran = Pembayaran::where('tahun', $tahun)->sum('jumlah');
        $total = $subtotal_pembayaran + $subtotal_pemasukan;
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tahun' => $tahun,
            'subtotal_pembayaran' => $subtotal_pembayaran,
            'list_kategori' => KategoriPemasukan::where('nama','!=','SPP')->orderBy('nama')->get(),
            'total' => $total,
        ];
        return view('pemasukan.rekap-pemasukan-tahunan-print-simple',$data);
    }

    // Pengeluaran
    public function rekap_pengeluaran_harian()
    {
        $tanggalawal = request('tanggalawal');
        $tanggalakhir = request('tanggalakhir');
        $total = Pengeluaran::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'list_pengeluaran' => Pengeluaran::with(['kategori', 'user'])->whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->get(),
            'total' => $total,
        ];
        return view('pengeluaran.rekap-pengeluaran-harian-print',$data);
    }
    public function rekap_pengeluaran_tahunan()
    {
        $tahun = request('tahun');
        $total = Pengeluaran::where('tahun', $tahun)->sum('jumlah');
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tahun' => $tahun,
            'list_pengeluaran' => Pengeluaran::with(['kategori', 'user'])->where('tahun', $tahun)->get(),
            'total' => $total,
        ];
        return view('pengeluaran.rekap-pengeluaran-tahunan-print',$data);
    }
    public function rekap_pengeluaran_harian_simple()
    {
        $tanggalawal = request('tanggalawal');
        $tanggalakhir = request('tanggalakhir');
        $total = Pengeluaran::whereBetween('tanggal', [$tanggalawal, $tanggalakhir])->sum('jumlah');
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'list_kategori' => KategoriPengeluaran::orderBy('nama')->get(),
            'total' => $total,
        ];
        return view('pengeluaran.rekap-pengeluaran-harian-print-simple',$data);
    }
    public function rekap_pengeluaran_tahunan_simple()
    {
        $tahun = request('tahun');
        $total = Pengeluaran::where('tahun', $tahun)->sum('jumlah');
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tahun' => $tahun,
            'list_kategori' => KategoriPengeluaran::orderBy('nama')->get(),
            'total' => $total,
        ];
        return view('pengeluaran.rekap-pengeluaran-tahunan-print-simple',$data);
    }

    public function kas_tahunan()
    {
        $tahun = request('tahun');
        $subtotal_pemasukan = Pemasukan::where('tahun', $tahun)->sum('jumlah');
        $subtotal_pembayaran = Pembayaran::where('tahun', $tahun)->sum('jumlah');
        $totalpemasukan = $subtotal_pembayaran + $subtotal_pemasukan;
        $totalpengeluaran= Pengeluaran::where('tahun', $tahun)->sum('jumlah');
        $data = [
            'kepala_sekolah' => User::role('Kepala Sekolah')->get(),
            'tahun' => $tahun,
            'subtotal_pembayaran' => $subtotal_pembayaran,
            'list_kategori_pemasukan' => KategoriPemasukan::where('nama','!=','SPP')->orderBy('nama')->get(),
            'list_kategori_pengeluaran' => KategoriPengeluaran::orderBy('nama')->get(),
            'totalpemasukan' => $totalpemasukan,
            'totalpengeluaran' => $totalpengeluaran,
            'saldo' => $totalpemasukan - $totalpengeluaran
        ];
        return view('kas.kas-tahunan-print', $data);
    }
}
