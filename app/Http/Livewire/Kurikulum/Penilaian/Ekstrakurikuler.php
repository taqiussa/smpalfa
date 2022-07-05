<?php

namespace App\Http\Livewire\Kurikulum\Penilaian;

use App\Models\Ekstrakurikuler as ModelsEkstrakurikuler;
use Livewire\Component;
use Livewire\WithPagination;

class Ekstrakurikuler extends Component
{
    use WithPagination;

    //model
    public $ekstrakurikuler;
    public $is_edit;
    public $id_ekstrakurikuler;
    public $show;

    protected $listeners = ['delete' => 'delete'];
    protected $rules = ['ekstrakurikuler' => 'required'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.kurikulum.penilaian.ekstrakurikuler',
    [
        'list_ekstrakurikuler' => ModelsEkstrakurikuler::orderBy('nama')->paginate(5)
    ]);
    }

    public function simpan()
    {
        $this->validate();
        if($this->is_edit)
        {
            ModelsEkstrakurikuler::updateOrCreate(
                [
                    'id' => $this->id_ekstrakurikuler
                ],
                [
                    'nama' => $this->ekstrakurikuler
                ]
                );
                $this->dispatchBrowserEvent('notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update Ekstrakurikuler'
                ]);
        }else {

            ModelsEkstrakurikuler::create(['nama' => $this->ekstrakurikuler]);
            $this->dispatchBrowserEvent('notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Simpan Data Ekstrakurikuler'
            ]);
        }
        $this->resetExcept('list_ekstrakurikuler');
    }

    public function edit($id)
    {
        $this->show = true;
        $this->is_edit = true;
        $this->id_ekstrakurikuler = $id;
        $this->ekstrakurikuler = ModelsEkstrakurikuler::find($id)->nama;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Data Ekstrakurikuler',
            'text' => 'Anda Yakin Menghapus Data Ekstra ?',
            'id' => $id
        ]);
    }
    public function delete($id)
    {
        ModelsEkstrakurikuler::find($id)->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Hapus Data Ekstrakurikuler'
        ]);
    }
}
