<?php

namespace App\Http\Livewire\Admin\Penilaian;

use App\Models\JenisPenilaian as ModelsJenisPenilaian;
use Livewire\Component;
use Livewire\WithPagination;

class JenisPenilaian extends Component
{
    use WithPagination;

    //model
    public $show;
    public $jenis_penilaian;
    public $is_edit;

    //array

    protected $rules = [
        'jenis_penilaian' => 'required'
    ];
    protected $listeners = [
        'delete' => 'delete'
    ];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.admin.penilaian.jenis-penilaian',
    [
        'list_jenis_penilaian' => ModelsJenisPenilaian::orderBy('nama')->paginate(5)
    ]);
    }

    public function simpan()
    {
        $this->validate();
        ModelsJenisPenilaian::create([
            'nama' => $this->jenis_penilaian
        ]);
        $this->dispatchBrowserEvent('notyf',[
            'type' => 'success',
            'message' => 'Berhasil Menyimpan Jenis Penilaian'
        ]);
    $this->reset();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Jenis Penilaian',
            'text' => 'And Yakin Menghapus Jenis Penilaian ?',
            'id' => $id, 
        ]);
    }
    public function delete($id)
    {
        ModelsJenisPenilaian::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Jenis Penilaian'
        ]);
    }
}
