<?php

namespace App\Http\Livewire\Bendahara\Kas;

use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Traits\GetData;
use Livewire\Component;

class KasBulanan extends Component
{
    use GetData;

    //model
    public $tahun;
    public $bulan;
    public $total_pembayaran;
    public $total_pemasukan;
    public $total_pengeluaran;
    public $saldo;

    //array
    public $list_pemasukan = [];
    public $list_pengeluaran = [];

    public function render()
    {
        return view('livewire.bendahara.kas.kas-bulanan');
    }
    
    public function mount()
    {
        $this->bulan = gmdate('m');
        $this->get_tahun();
        $this->get_list_pemasukan();
        $this->get_list_pengeluaran();
        $this->saldo = $this->total_pemasukan - $this->total_pengeluaran;
    }
    public function updated($property)
    {
        $this->get_list_pemasukan();
        $this->get_list_pengeluaran();
        $this->saldo = $this->total_pemasukan - $this->total_pengeluaran;
    }
    private function get_list_pemasukan()
    {
        $this->list_pemasukan = Pemasukan::where('tahun', $this->tahun)
        ->whereMonth('tanggal', $this->bulan)
        ->groupBy('kategori_pemasukan_id')
        ->selectRaw('kategori_pemasukan_id, sum(jumlah) as jumlah')
        ->get();
        $this->total_pembayaran = Pembayaran::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah');
        $this->total_pemasukan = Pemasukan::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah') + $this->total_pembayaran;
    }
    private function get_list_pengeluaran()
    {
        $this->list_pengeluaran = Pengeluaran::where('tahun', $this->tahun)
        ->whereMonth('tanggal', $this->bulan)
        ->groupBy('kategori_pengeluaran_id')
        ->selectRaw('kategori_pengeluaran_id, sum(jumlah) as jumlah')
        ->get();
        $this->total_pengeluaran = Pengeluaran::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah');
    }
}
