<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\User;
use Livewire\Component;

class EditDataSiswa extends Component
{ 
    // model
    public $nama;
    public $nis;
    public $id_siswa;

    protected $rules = [
        'nis' => 'required',
        'nama' => 'required'
    ];
    public function render()
    {
        return view('livewire.tata-usaha.siswa.edit-data-siswa');
    }
    public function mount()
    {
        $this->id_siswa = request('id');
        $cari = User::find($this->id_siswa);
        $this->nis = $cari->nis;
        $this->nama = $cari->name;
    }
    public function simpan()
    {
        $this->validate();
        try {
            $user = User::find($this->id_siswa);
            $user->update(['nis' => $this->nis, 'name' => $this->nama]);
                $this->dispatchBrowserEvent('notyf', ['type' => 'success' ,'message' => 'Berhasil Menambah Siswa']);
            } catch (\Throwable $th) {
                
                $this->dispatchBrowserEvent('notyf', ['type' => 'error' ,'message' => 'Koneksi terputus, Ulangi']);
        }
        return redirect()->route('tata-usaha.siswa.cari-siswa');
    }
}
