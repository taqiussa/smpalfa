<?php

namespace App\Http\Livewire\Admin\Kelas;

use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas as ModelsWaliKelas;
use Livewire\Component;

class WaliKelas extends Component
{
    //Model
    public $tahun;
    public $kelas;
    public $show;
    public $guru;

    //array
    public $list_user = [];
    public $list_kelas = [];
    public $list_wali_kelas = [];

    protected $rules = 
    [
        'kelas' => 'required',
        'guru' => 'required'
    ];
    protected $listeners =
    [
        'delete' => 'delete',
        'refresh' => '$refresh'
    ];
    public function render()
    {
        $this->get_wali_kelas();
        return view('livewire.admin.kelas.wali-kelas');
    }

    public function mount()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
        
        $id_kelas = ModelsWaliKelas::where('tahun', $this->tahun)->pluck('kelas_id');
        $this->list_kelas = Kelas::whereNotIn('id',$id_kelas)->get();
        $id_guru = ModelsWaliKelas::where('tahun', $this->tahun)->pluck('user_id');
        $this->list_user = User::where('email', '!=', '')->whereNotIn('id', $id_guru)->orderBy('name')->get();
        $this->list_wali_kelas = ModelsWaliKelas::join('users', 'users.id', '=', 'kelas_wali_kelas.user_id')
                                                    ->join('kelas', 'kelas.id', '=', 'kelas_wali_kelas.kelas_id')
                                                    ->where('tahun', $this->tahun)
                                                    ->get();
    }

    public function updatedTahun()
    {
        $this->resetErrorBag();
        $this->get_wali_kelas();
    }
    public function updatedKelas()
    {
        $this->resetErrorBag();
        $this->get_wali_kelas();
    }
    public function updatedGuru()
    {
        $this->resetErrorBag();
        $this->get_wali_kelas();
    }

    public function simpan()
    {
        $this->resetErrorBag();
        $this->validate();
        Kelas::find($this->kelas)->wali_kelas($this->tahun)->attach($this->guru, ['tahun' => $this->tahun]);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Wali Kelas'
        ]);
        $this->guru = '';
        $this->kelas = '';

        $this->get_wali_kelas();
    }
    public function batal()
    {
        $this->resetExcept('tahun');
        $this->get_wali_kelas();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Mata Wali Kelas',
                'text' => 'Apakah Anda Yakin Menghapus Mata Wali Kelas ?',
                'id' => $id,
            ]
        );
    }
    public function delete($id)
    {
        ModelsWaliKelas::where('kelas_id', $id)->where('tahun', $this->tahun)->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Data Wali Kelas',
        ]);
        $this->guru = '';
        $this->kelas = '';
        $this->get_wali_kelas();
    }
    private function get_wali_kelas()
    {
        $id_kelas = ModelsWaliKelas::where('tahun', $this->tahun)->pluck('kelas_id');
        $this->list_kelas = Kelas::whereNotIn('id',$id_kelas)->get();
        $id_guru = ModelsWaliKelas::where('tahun', $this->tahun)->pluck('user_id');
        $this->list_user = User::where('email', '!=', '')->whereNotIn('id', $id_guru)->orderBy('name')->get();
        $this->list_wali_kelas = ModelsWaliKelas::join('users', 'users.id', '=', 'kelas_wali_kelas.user_id')
                                                    ->join('kelas', 'kelas.id', '=', 'kelas_wali_kelas.kelas_id')
                                                    ->where('tahun', $this->tahun)
                                                    ->get();
    }
}
