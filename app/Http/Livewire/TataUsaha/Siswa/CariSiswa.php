<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\Siswa;
use App\Models\User;
use App\Traits\GetData;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CariSiswa extends Component
{
    use WithPagination;
    use GetData;

    // model
    public $tahun;
    public $search;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.tata-usaha.siswa.cari-siswa',
    [
        'list_siswa' => Siswa::where('tahun', $this->tahun)
        ->whereHas('user', function (Builder $query) { $query->where('name', 'like', '%' . $this->search . '%')->orWhere('nis', $this->search);})
        ->with([
            'user',
            'kelas',
            'orangtua',
            'alamat',
            ])
        ->paginate(10),
    ]);
    }

    public function mount()
    {
        $this->get_tahun();
    }
}
