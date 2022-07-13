<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class TableUser extends Component
{
    use WithPagination;

    //model
    public $show;
    public $name;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;
    public $is_edit;
    public $id_user;
    //array

    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'name' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required|min:8|confirmed'
    ];
    protected $listeners = [
        'delete' => 'delete'
    ];
    public function render()
    {
        return view(
            'livewire.admin.user.table-user',
            [
                'list_user' => User::where('username', '!=', '')->orderBy('name')->paginate(10)
            ]
        );
    }

    public function edit($id)
    {
        $this->show = true;
        $this->is_edit = true;
        $this->id_user = $id;
        $user = User::find($id);
        $this->name = $user->name;
        $this->username = $user->username;
    }
    public function simpan()
    {
        if ($this->is_edit) {
            $this->validateOnly('name',['name' => 'required']);
            User::updateOrCreate(
                [
                    'id' => $this->id_user
                ],
                [
                    'name' => $this->name,
                    'username' => $this->username,
                ]
            );
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Update User'
                ]
            );
        } else {

            $this->validate();
            User::create([
                'name' => $this->name,
                'username' => $this->username,
                'password' => Hash::make($this->password)
            ]);
            $this->dispatchBrowserEvent(
                'notyf',
                [
                    'type' => 'success',
                    'message' => 'Berhasil Menambahkan User Baru'
                ]
            );
        }
        // $this->reset();
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', [
            'title' => 'Menghapus User',
            'text' => 'Anda Yakin Menghapus User Ini ?',
            'id' => $id,
        ]);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $this->dispatchBrowserEvent(
            'notyf',
            [
                'type' => 'error',
                'message' => 'Berhasil Menghapus User'
            ]
        );
    }
}
