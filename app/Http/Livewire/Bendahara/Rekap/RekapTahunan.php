<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Traits\GetData;
use Livewire\Component;

class RekapTahunan extends Component
{
    use GetData;

    //model
    public $tahun;
    public $subtotal_pembayaran;
    public $subtotal_pemasukan;
    public $total;

    //array
    public $list_pembayaran = [];
    public $list_pemasukan = [];
    public function render()
    {
        return view('livewire.bendahara.rekap.rekap-tahunan');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_list_pembayaran();
        $this->get_list_pemasukan();
        $this->total = $this->subtotal_pembayaran + $this->subtotal_pemasukan;
    }

    public function updated($property)
    {
        $this->get_list_pembayaran();
        $this->get_list_pemasukan();
        $this->total = $this->subtotal_pembayaran + $this->subtotal_pemasukan;
    }
    private function get_list_pembayaran()
    {
        $this->list_pembayaran = Pembayaran::join('gunabayars', 'gunabayars.id', '=', 'pembayarans.gunabayar_id')
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
            ->where('pembayarans.tahun', $this->tahun)
            ->orderBy('pembayarans.created_at', 'desc')
            ->get();
        $this->subtotal_pembayaran = Pembayaran::where('tahun', $this->tahun)->sum('jumlah');
    }
    private function get_list_pemasukan()
    {
        $this->list_pemasukan = Pemasukan::join('kategori_pemasukans', 'kategori_pemasukans.id', '=', 'pemasukans.kategori_pemasukan_id')
            ->join('users', 'users.id', '=', 'pemasukans.user_id')
            ->select(
                'pemasukans.id as id',
                'pemasukans.tanggal as tanggal',
                'pemasukans.tahun as tahun',
                'pemasukans.jumlah as jumlah',
                'pemasukans.keterangan as keterangan',
                'kategori_pemasukans.nama as kategori',
                'users.name as bendahara',
            )
            ->where('pemasukans.tahun', $this->tahun)
            ->orderBy('pemasukans.created_at', 'desc')
            ->get();
        $this->subtotal_pemasukan = Pemasukan::where('tahun', $this->tahun)->sum('jumlah');
    }
}
