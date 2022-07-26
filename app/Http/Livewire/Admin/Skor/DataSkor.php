<?php

namespace App\Http\Livewire\Admin\Skor;

use App\Models\Skor;
use Livewire\Component;
use Livewire\WithPagination;

class DataSkor extends Component
{
    use WithPagination;

    //model
    public $keterangan;
    public $skor;
    public $is_edit;
    public $id_skor;
    public $search = '';

    //array

    protected $rules  = [
        'keterangan' => 'required',
        'skor' => 'required',
    ];
    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.skor.data-skor',[
            'list_skor' => Skor::where('keterangan', 'like', '%' . $this->search . '%')->orderBy('keterangan')->paginate(5),
        ]);
    }
    public function simpan()
    {
        $this->validate();
        if($this->is_edit)
        {
            Skor::where('id', $this->id_skor)
                ->update([
                    'keterangan' => $this->keterangan,
                    'skor' => $this->skor
                ]);
            $this->dispatchBrowserEvent('notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Update Data Skor'
            ]);
            $this->is_edit = false;
            $this->id_skor = '';
        } else {
            Skor::create([
                'keterangan' => $this->keterangan,
                'skor' => $this->skor
            ]);
            $this->dispatchBrowserEvent('notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Menambah Data Skor'
            ]);
        }
        $this->keterangan = '';
        $this->skor = '';
    }

    public function batal()
    {
        $this->keterangan = '';
        $this->skor = '';
        $this->id_skor = '';
        $this->is_edit = false;
    }
    public function edit($id)
    {
        $this->id_skor = $id;
        $this->is_edit = true;
        $skor = Skor::find($id);
        $this->keterangan = $skor->keterangan;
        $this->skor = $skor->skor;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm',
        [
            'title' => 'Menghapus Data Skor',
            'text' => 'Anda Yakin Menghapus Data ini ?',
            'id' => $id
        ]);
    }
    public function delete($id)
    {
        Skor::find($id)->delete();
        $this->dispatchBrowserEvent('notyf',
        [
            'type' => 'error',
            'message' => 'Berhasil Menghapus Data Skor'
        ]);
    }
}
