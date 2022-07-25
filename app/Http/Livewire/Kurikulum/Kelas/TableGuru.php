<?php

namespace App\Http\Livewire\Kurikulum\Kelas;

use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\User;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;

class TableGuru extends Component
{
    use GetData;
    use WithPagination;

    // model
    public $tahun;
    public $guru;
    public $kelas;

    // array
    public $list_guru = [];
    public $list_kelas = [];

    protected $rules =
    [
        'tahun' => 'required',
        'guru' => 'required',
        'kelas' => 'required',
    ];
    protected $listeners =
    [
        'refresh' => '$rsefresh'
    ];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view(
            'livewire.kurikulum.kelas.table-guru',
            [
                'list_guru_kelas' => User::where('username', '!=', null)
                    ->orderBy('name')
                    ->with(['kelas' => fn ($query) => $query->where('tahun', $this->tahun)])
                    ->paginate(5)
            ]
        );
    }

    public function mount()
    {
        $this->get_tahun();
        $this->list_guru = User::where('username', '!=', null)
            ->orderBy('name')
            ->get();
        $this->list_kelas = Kelas::get();
    }
    public function simpan()
    {
        $this->validate();
        try {
            GuruKelas::create(
                [
                    'guru_id' => $this->guru,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun
                ]
            );
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Pengaturan Guru Kelas']);
            $this->emitSelf('refresh');
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
    }
    public function delete($guru, $kelas)
    {
        try {
            $guru = GuruKelas::where('tahun', $this->tahun)
                ->where('guru_id', $guru)
                ->where('kelas_id', $kelas)
                ->first()->delete();
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Menghapus Pengaturan Guru Kelas']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi']);
        }
    }
}
