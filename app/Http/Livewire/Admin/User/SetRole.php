<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class SetRole extends Component
{
    use WithPagination;
    //model
    public $role;
    public $user;
    public $user_id;
    public $nama;

    //array
    public $list_role;
    public $roles_name;

    protected $paginationTheme = 'bootstrap';
    protected $rules = 
    [
        'user' => 'required'
    ];
    public function render()
    {
        return view('livewire.admin.user.set-role',
    [
        'list_user' => User::where('username', '!=', '')->orderBy('name')->paginate(5)
    ]);
    }

    public function mount()
    {
        $this->list_role = Role::get();
    }

    public function show_user_roles($id)
    {
        $this->user = User::find($id);
        $this->nama = $this->user->name;
        $list_user_roles = $this->user->roles->pluck('name')->toArray();
        $this->roles_name = array_fill_keys($list_user_roles, true);
        $this->user_id = $id;
    }
    public function set_role()
    {
        $this->user = User::find($this->user_id);
        $this->user->syncRoles($this->roles_name);
        $this->user = '';
        $this->dispatchBrowserEvent('notyf', [
            'type' => 'success',
            'message' => 'Berhasil Update Role'
        ]);
    }
}
