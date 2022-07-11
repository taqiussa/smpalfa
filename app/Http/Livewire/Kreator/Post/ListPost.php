<?php

namespace App\Http\Livewire\Kreator\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListPost extends Component
{
    use WithPagination;
    
    // model
    public $search;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view('livewire.kreator.post.list-post',
    [
        'list_post' => Post::with('user')
        ->where('judul', 'like', '%'. $this->search . '%')
        ->orWhere('isi', 'like', '%'. $this->search . '%')
        ->orderBy('created_at', 'desc')->paginate(5)
    ]);
    }

    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Hapus Postingan', 'text' => 'Anda Yakin Menghapus Postingan ?', 'id' => $id]);
    }
    public function delete($id)
    {
        $cari = Post::find($id);
        try {
            if($cari->foto)
            {
                Storage::delete($cari->foto);
            }
            $cari->delete();
            $this->dispatchBrowserEvent('nofyt', ['type' => 'success', 'message' => 'Berhasil Menghapus Postingan']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('nofyt', ['type' => 'error', 'message' => 'Koneksi terputus, silahkan ulangi']);
        }
    }
}
