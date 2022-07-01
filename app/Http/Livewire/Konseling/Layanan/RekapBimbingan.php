<?php

namespace App\Http\Livewire\Konseling\Layanan;

use App\Models\Bk;
use App\Models\BkDetail;
use Livewire\Component;
use Livewire\WithPagination;

class RekapBimbingan extends Component
{
    use WithPagination;

    //model
    public $mulai;
    public $akhir;
    public $search = '';
    //array

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.konseling.layanan.rekap-bimbingan',[
            'list_rekap' =>  BkDetail::join('kelas', 'bk_details.kelas_id' , '=', 'kelas.id')
            ->join('users', 'bk_details.nis', '=', 'users.nis')
            ->where('users.name', 'like', '%'. $this->search. '%')
            ->whereBetween('tanggal', [$this->mulai, $this->akhir])
            ->where('bentuk_bimbingan', '!=', 'Kelas')
            ->orderBy('tanggal', 'desc')->paginate(5)
        ]);
    }

    public function mount(){
        $this->mulai = gmdate('Y-m-d');
        $this->akhir = gmdate('Y-m-d');
    }
}
