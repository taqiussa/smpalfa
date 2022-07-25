<?php

namespace App\Http\Livewire\Siswa;

use App\Models\BkDetail;
use Livewire\Component;
use Livewire\WithPagination;

class Bimbingan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view(
            'livewire.siswa.bimbingan',
            [
                'list_rekap' => BkDetail::where('nis', auth()->user()->nis)
                    ->with(['siswa', 'guru', 'kelas'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(5),
            ]
        );
    }
}
