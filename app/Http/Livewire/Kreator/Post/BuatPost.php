<?php

namespace App\Http\Livewire\Kreator\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class BuatPost extends Component
{
    use WithFileUploads;

    //model
    public $judul;
    public $tanggal;
    public $isi;
    public $foto;
    public $kutipan;

    protected $rules = [
        'judul' => 'required',
        'isi' => 'required'
    ];
    public function render()
    {
        return view('livewire.kreator.post.buat-post');
    }
    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
    }
    public function simpan()
    {
        $this->validate();
        if($this->foto)
        {
            $this->validate([
                'foto' => 'image|max:5120'
            ]);
            $foto = $this->foto->store('foto');
        } else {
            $foto = '';
        }
        $this->kutipan = Str::limit($this->isi, 230);
        
        try {
            Post::create(
                [
                    'tanggal' => $this->tanggal,
                    'judul' => $this->judul,
                    'kutipan' => $this->kutipan,
                    'isi' => $this->isi,
                    'foto' => $foto,
                    'user_id' => auth()->user()->id

                ]
                );
            $this->resetExcept('tanggal');
            $this->dispatchBrowserEvent('notyf', ['type' => 'success', 'message' => 'Berhasil Membuat Postingan']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf', ['type' => 'error', 'message' => 'Koneksi terputus, silahkan ulangi']);
        }
    }
}
