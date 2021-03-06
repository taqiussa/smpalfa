<?php

namespace App\Http\Livewire\Bendahara\Rekap;

use Livewire\Component;
use App\Models\Pengeluaran;
use Livewire\WithPagination;

class RekapHarianPengeluaran extends Component
{
    use WithPagination;

    //model
    public $tanggalawal;
    public $tanggalakhir;
    public $total;

    //array
    // public $list_pengeluaran = [];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.bendahara.rekap.rekap-harian-pengeluaran',
    [
        'list_pengeluaran' => Pengeluaran::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])
        ->orderBy('created_at', 'desc')
        ->with(['kategori', 'user'])
        ->paginate(5),
    ]);
    }

    public function mount()
    {
        $this->tanggalawal = gmdate('Y-m-d');
        $this->tanggalakhir = gmdate('Y-m-d');
        $this->get_list_pengeluaran();
    }

    public function updated($property)
    {
        $this->get_list_pengeluaran();
    }
    private function get_list_pengeluaran()
    {
        // $this->list_pengeluaran = Pengeluaran::join('kategori_pengeluarans', 'kategori_pengeluarans.id', '=', 'pengeluarans.kategori_pengeluaran_id')
        //     ->join('users', 'users.id', '=', 'pengeluarans.user_id')
        //     ->select(
        //         'pengeluarans.id as id',
        //         'pengeluarans.tanggal as tanggal',
        //         'pengeluarans.tanggal_nota as tanggal_nota',
        //         'pengeluarans.tahun as tahun',
        //         'pengeluarans.jumlah as jumlah',
        //         'pengeluarans.keterangan as keterangan',
        //         'kategori_pengeluarans.nama as kategori',
        //         'users.name as bendahara',
        //     )
        //     ->whereBetween('pengeluarans.tanggal', [$this->tanggalawal, $this->tanggalakhir])
        //     ->orderBy('pengeluarans.created_at', 'desc')
        //     ->get();
        $this->total = Pengeluaran::whereBetween('tanggal', [$this->tanggalawal, $this->tanggalakhir])->sum('jumlah');
    }
}
