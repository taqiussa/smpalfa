<?php

namespace App\Http\Livewire\Bendahara\Pengaturan;

use App\Models\Gunabayar as ModelsGunabayar;
use App\Models\KategoriPemasukan;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithPagination;

class Gunabayar extends Component
{
    use GetData;
    use WithPagination;

    //model
    public $kategori;
    public $semester;
    public $gunabayar;
    public $is_edit;
    public $is_disabled;
    public $id_gunabayar;

    //array
    public $list_kategori = [];

    protected $rules = [
        'kategori' => 'required',
        'gunabayar' => 'required',
    ];
    protected $listeners = ['delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view(
            'livewire.bendahara.pengaturan.gunabayar',
            [
                'list_gunabayar' => ModelsGunabayar::where('kategori_pemasukan_id', $this->kategori)->orderBy('semester')->paginate(6)
            ]
        );
    }
    public function mount()
    {
        $this->list_kategori = KategoriPemasukan::orderBy('nama')->get();
    }
    public function simpan()
    {
        $this->validate();
        try {
            if ($this->is_edit) {
                ModelsGunabayar::updateOrCreate(
                    [
                        'id' => $this->id_gunabayar,
                        'kategori_pemasukan_id' => $this->kategori
                    ],
                    [
                        'nama' => $this->gunabayar,
                        'semester' => $this->semester
                    ]
                );
                $this->dispatchBrowserEvent('notyf',['type' => 'success', 'message' => 'Berhasil Update Gunabayar']);
            } else {
                ModelsGunabayar::create([
                    'kategori_pemasukan_id' => $this->kategori,
                    'nama' => $this->gunabayar,
                    'semester' => $this->semester
                ]);
                $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Simpan Gunabayar']);
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi Terputus, Ulangi Lagi']);
        }
    $this->resetExcept('list_kategori', 'kategori', 'semester');
    }

    public function edit($id)
    {
        $this->is_edit = true;
        $this->is_disabled = 'disabled';
        $cari = ModelsGunabayar::find($id);
        $this->kategori = $cari->kategori_pemasukan_id;
        $this->gunabayar = $cari->nama;
        $this->semester = $cari->semester;
        $this->id_gunabayar = $id;
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Gunabayar', 'text' => 'Anda Yakin Menghapus ?', 'id' =>$id]);

    }
    
    public function delete($id)
    {
        ModelsGunabayar::find($id)->delete();
        $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Berhasil Hapus Gunabayar']);
    }
}
