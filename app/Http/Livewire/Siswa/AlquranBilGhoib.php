<?php

namespace App\Http\Livewire\Siswa;

use App\Models\User;
use App\Traits\GetData;
use Livewire\Component;
use App\Models\JenisAlquran;
use App\Models\PenilaianAlquran;

class AlquranBilGhoib extends Component
{
    use GetData;

    //array
    public $list_jenis = [];
    public $list_nilai = [];
    public $list_tanggal = [];
    public $list_guru = [];

    public function render()
    {
        return view('livewire.siswa.alquran-bil-ghoib');
    }
    public function mount()
    {
        $this->list_jenis = JenisAlquran::where('kategori_alquran_id', 1)->get();
        $this->get_nilai();
    }
    public function get_nilai()
    {
        foreach ($this->list_jenis as $key => $jenis) {
            $cari = PenilaianAlquran::where('nis', auth()->user()->nis)
                ->where('jenis_alquran_id', $jenis->id)
                ->first();
            $this->list_nilai[$key] = $cari->nilai ?? '';
            $this->list_tanggal[$key] = $cari->tanggal ?? '';
            $user = User::find($cari->user_id ?? '');
            $this->list_guru[$key] = $user->name ?? '';
        }
    }
}
