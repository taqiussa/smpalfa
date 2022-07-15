<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Gunabayar;
use App\Models\Siswa;
use App\Models\WajibBayar;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\Pembayaran;

class Administrasi extends Component
{
    use GetData;

    // model 
    public $tahun;
    public $wajibbayar;
    public $total;
    public $kurangbayar;

    //array
    public $list_gunabayar = [];
    public $list_pembayaran = [];
    public $sumjumlah = [];
    public $keterangan = [];

    public function render()
    {
        $this->get_tahun();
        $this->list_gunabayar = Gunabayar::orderBy('semester')->get();
        $tingkat = Siswa::where('tahun', $this->tahun)->where('nis', auth()->user()->nis)->value('tingkat');
        $this->wajibbayar = WajibBayar::where('tahun', $this->tahun)->where('tingkat', $tingkat)->value('jumlah');
        $this->total = Pembayaran::where('tahun', $this->tahun)
            ->where('nis', auth()->user()->nis)
            ->sum('jumlah');
        $this->kurangbayar = $this->wajibbayar - $this->total;
        foreach ($this->list_gunabayar as $key => $gunabayar) {
            $jumlah = Pembayaran::where('tahun', $this->tahun)
                ->where('nis', auth()->user()->nis)
                ->where('gunabayar_id', $gunabayar->id)
                ->sum('jumlah');
            $this->sumjumlah[$key] = $jumlah;
            $bulanan = intval($this->wajibbayar / 12);
            if ($this->sumjumlah[$key] < $bulanan) {
                $this->keterangan[$key] = 'Belum lunas';
            } else {
                $this->keterangan[$key] = 'Lunas';
            }
        }
        return view('livewire.siswa.administrasi');
    }
}
