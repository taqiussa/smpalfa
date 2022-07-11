<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use Livewire\Component;
use App\Models\Pengeluaran;
use App\Traits\GetData;

class RekapTahunanPengeluaran extends Component
{
    use GetData;

    //model
    public $tahun;
    public $total;

    //array
    public $list_pengeluaran = [];
    public function render()
    {
        return view('livewire.bendahara.rekap.rekap-tahunan-pengeluaran');
    }

    public function mount()
    {
        $this->get_tahun();
        $this->get_list_pengeluaran();
    }

    public function updated($property)
    {
        $this->get_list_pengeluaran();
    }
    private function get_list_pengeluaran()
    {
        $this->list_pengeluaran = Pengeluaran::join('kategori_pengeluarans', 'kategori_pengeluarans.id', '=', 'pengeluarans.kategori_pengeluaran_id')
            ->join('users', 'users.id', '=', 'pengeluarans.user_id')
            ->select(
                'pengeluarans.id as id',
                'pengeluarans.tanggal as tanggal',
                'pengeluarans.tahun as tahun',
                'pengeluarans.jumlah as jumlah',
                'pengeluarans.keterangan as keterangan',
                'kategori_pengeluarans.nama as kategori',
                'users.name as bendahara',
            )
            ->where('pengeluarans.tahun', $this->tahun)
            ->orderBy('pengeluarans.created_at', 'desc')
            ->get();
        $this->total = Pengeluaran::where('tahun', $this->tahun)->sum('jumlah');
    }
}
