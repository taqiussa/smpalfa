<?php

namespace App\Http\Livewire\Kurikulum\MataPelajaran;

use App\Models\GuruMapel;
use App\Models\MataPelajaran;
use App\Models\User;
use Livewire\Component;

class TableGuru extends Component
{
    //model
    public $guru;
    public $mata_pelajaran;

    //array
    public $list_mapel = [];
    public $list_mata_pelajaran = [];
    public $list_guru = [];
    protected $rules = [
        'guru' => 'required',
        'mata_pelajaran' => 'required'
    ];
    public function render()
    {
        $this->get_mata_pelajaran();
        return view('livewire.kurikulum.mata-pelajaran.table-guru');
    }

    public function simpan()
    {
        $this->validate();
        MataPelajaran::find($this->mata_pelajaran)->guru()->attach($this->guru);
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'success',
            'message' => 'Berhasil Mengatur Guru Mata Pelajaran'
        ]);
        $this->guru = '';
        $this->get_mata_pelajaran();

    }
    public function delete($mapel, $id)
    {
        GuruMapel::where('mata_pelajaran_id',$mapel)->where('user_id',$id)->first()->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Guru'
        ]);
    }
    public function get_mata_pelajaran()
    {
        $this->list_mapel = MataPelajaran::orderBy('kelompok')->orderBy('nama')->get();
        $this->list_guru = User::where('email', '!=', '')->orderBy('name')->get();
        $this->list_mata_pelajaran = MataPelajaran::with(['guru' => fn($query) => $query->orderBy('name')])->orderBy('kelompok')->orderBy('nama')->get();
    }
}
