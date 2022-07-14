<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;

class HapusSiswa extends Component
{
    use GetData;

    // model
    public $tahun;
    public $kelas;

    //array
    public $list_kelas = [];
    public $list_siswa = [];

    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        $this->get_list_siswa();
        return view('livewire.tata-usaha.siswa.hapus-siswa');
    }
    public function mount()
    {
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Menghapus Siswa', 'text' => 'Anda Yakin Menghapus Siswa ?', 'id' => $id]);
    }
    public function delete($id)
    {
        try {
            Siswa::find($id)->delete();
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Menghapus Siswa']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi Lagi']);
        }
    }
}
