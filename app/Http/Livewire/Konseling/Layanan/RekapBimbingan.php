<?php

namespace App\Http\Livewire\Konseling\Layanan;

use App\Models\BkDetail;
use App\Traits\GetData;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class RekapBimbingan extends Component
{
    use WithPagination;
    use GetData;
    //model
    public $mulai;
    public $akhir;
    public $tahun;
    public $search = '';
    
    //array

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'delete'];
    public function render()
    {
        return view('livewire.konseling.layanan.rekap-bimbingan',[
            'list_rekap' =>  BkDetail::join('kelas', 'bk_details.kelas_id' , '=', 'kelas.id')
            ->join('users', 'bk_details.nis', '=', 'users.nis')
            ->where('users.name', 'like', '%'. $this->search. '%')
            // ->whereBetween('tanggal', [$this->mulai, $this->akhir])
            ->where('bk_details.tahun', $this->tahun)
            ->where('bentuk_bimbingan', '!=', 'Kelas')
            ->select(
                'bk_details.id as id',
                'bk_details.slug as slug',
                'bk_details.bentuk_bimbingan as bentuk_bimbingan',
                'bk_details.permasalahan as permasalahan',
                'bk_details.tindak_lanjut as tindak_lanjut',
                'bk_details.tanggal as tanggal',
                'bk_details.user_id as user_id',
                'kelas.nama as kelas',
                'users.name as siswa'
            )
            ->with('guru')
            ->orderBy('bk_details.created_at', 'desc')->paginate(5)
        ]);
    }

    public function mount(){
        $this->mulai = gmdate('Y-m-d');
        $this->akhir = gmdate('Y-m-d');
        $this->get_tahun();
    }
    public function confirm($id)
    {
        $this->dispatchBrowserEvent('confirm', ['title' => 'Menghapus Rekap Bimbingan', 'text' => 'Anda Yakin menghapus Bimbingan ini ?', 'id' => $id]);
    }
    public function delete($id)
    {
        try {
            $detail = BkDetail::find($id);
            if($detail->foto){
                Storage::delete($detail->foto);
            }
            if($detail->fotodokumen){
                Storage::delete($detail->fotodokumen);
            }
            $detail->delete();
            $this->dispatchBrowserEvent('notyf',['type' => 'error', 'message' => 'Berhasil Hapus Bimbingan']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('notyf',['type' => 'error', 'message' => 'Koneksi terputus, ulangi']);
        }
    }
}
