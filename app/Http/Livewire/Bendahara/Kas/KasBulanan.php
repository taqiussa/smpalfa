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
    public $bulan = '01';
    public $total_pembayaran;
    public $total_pemasukan;
    public $total_pengeluaran;
    public $saldo;

    //array
    public $list_kategori_pemasukan = [];
    public $list_kategori_pengeluaran = [];
    public $subtotal_pemasukan = [];
    public $subtotal_pengeluaran = [];

    public function render()
    {
        return view('livewire.bendahara.kas.kas-bulanan');
    }
    
    public function mount()
    {
        $this->get_tahun();
    }
    public function updated($property)
    {
        $this->get_list_pemasukan();
        $this->get_list_pengeluaran();
        $this->saldo = $this->total_pemasukan - $this->total_pengeluaran;
    }
    private function get_list_pemasukan()
    {
        $this->list_kategori_pemasukan = KategoriPemasukan::where('nama', '!=', 'SPP')->orderBy('nama')->get();
        foreach ($this->list_kategori_pemasukan as $key => $pemasukan) {
            $jumlah = Pemasukan::where('tahun', $this->tahun)
            ->whereMonth('tanggal', $this->bulan)
            ->where('kategori_pemasukan_id', $pemasukan->id)
            ->sum('jumlah');
            $this->subtotal_pemasukan[$key] = $jumlah;
        }
        $this->total_pembayaran = Pembayaran::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah');
        $this->total_pemasukan = Pemasukan::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah') + $this->total_pembayaran;
    }
    private function get_list_pengeluaran()
    {
        $this->list_kategori_pengeluaran = KategoriPengeluaran::orderBy('nama')->get();
        foreach ($this->list_kategori_pengeluaran as $key => $pengeluaran) {
            $jumlah = Pengeluaran::where('tahun', $this->tahun)
            ->whereMonth('tanggal', $this->bulan)
            ->where('kategori_pengeluaran_id', $pengeluaran->id)
            ->sum('jumlah');
            $this->subtotal_pengeluaran[$key] = $jumlah;
        }
        $this->total_pengeluaran = Pengeluaran::where('tahun', $this->tahun)->whereMonth('tanggal', $this->bulan)->sum('jumlah');
    }
}
