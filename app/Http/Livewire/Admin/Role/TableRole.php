<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class TableRole extends Component
{
    use WithPagination;
    //model
    public $name;
    public $show;

    //array

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'delete' => 'delete'
    ];
    protected $rules = [
        'name' => 'required|unique:roles'
    ];
    public function render()
    {
        return view(
            'livewire.admin.role.table-role',
            [
                'list_role' => Role::paginate(5)
            ]
        );
    }

    public function simpan()
    {
        $this->validate();
        Role::create([
            'name' => $this->name
        ]);
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'success',
                'message' => 'Berhasil Simpan Role'
            ]
        );
        $this->name = '';
        $this->show = false;
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent(
            'confirm',
            [
                'title' => 'Menghapus Role',
                'text' => 'Yakin Menghapus Role ?',
                'id' => $id
            ]
        );
    }
    public function delete($id)
    {
        Role::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus Role'
            ]
        );
    }
}
