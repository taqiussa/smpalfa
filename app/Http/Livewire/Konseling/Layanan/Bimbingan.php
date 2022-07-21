<?php

namespace App\Http\Livewire\Konseling\Layanan;

use App\Models\Bk;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\GetData;
use Livewire\Component;
use Livewire\WithFileUploads;

class Bimbingan extends Component
{
    use GetData;
    use WithFileUploads;
    // model
    public $tanggal;
    public $jenis_bimbingan;
    public $bentuk_bimbingan;
    public $kelas;
    public $tahun;
    public $siswa;
    public $karakter;
    public $permasalahan;
    public $penyelesaian;
    public $tindak_lanjut;
    public $foto;
    public $foto_dokumen;

    // array
    public $list_kelas = [];
    public $list_siswa = [];
    public $kelompok_siswa = [];

    protected $rules = [
        'jenis_bimbingan' => 'required',
        'bentuk_bimbingan' => 'required',
        'permasalahan' => 'required',
        'penyelesaian' => 'required',
        'tindak_lanjut' => 'required',
    ];
    public function render()
    {
        return view('livewire.konseling.layanan.bimbingan');
    }
    public function mount()
    {
        $this->tanggal = gmdate('Y-m-d');
        $this->get_tahun();
        $this->list_kelas = Kelas::get();
    }
    public function hydrate()
    {
        switch ($this->bentuk_bimbingan) {
            case 'Individu':
                $this->get_list_siswa();
                break;
            case 'Kelompok':
                $this->get_list_siswa();
                break;
            default:
                break;
        }
    }
    public function tambah()
    {
        $this->validate([
            'kelas' => 'required',
            'siswa' => 'required'
        ]);
        $cari_kelas = Kelas::find($this->kelas);
        $cari_siswa = User::where('nis', $this->siswa)->first();
        $this->kelompok_siswa[] = [
            'id_kelas' => $cari_kelas->id,
            'nama_kelas' => $cari_kelas->nama,
            'nis_siswa' => $cari_siswa->nis,
            'nama_siswa' => $cari_siswa->name
        ];
        $this->kelas = '';
        $this->list_siswa = [];
        $this->siswa = '';
    }
    public function hapus($key)
    {
        unset($this->kelompok_siswa[$key]);
        $this->kelompok_siswa = array_values($this->kelompok_siswa);
    }

    public function simpan()
    {

        switch ($this->bentuk_bimbingan) {
            case 'Individu':
                $this->resetErrorBag();
                $this->validate();
                if ($this->foto) {
                    $this->validate([
                        'foto' => 'image|max:2048'
                    ]);
                    $foto = $this->foto->store('foto');
                } else {
                    $foto = '';
                }
                if ($this->foto_dokumen) {
                    $this->validate([
                        'foto_dokumen' => 'image|max:2048'
                    ]);
                    $fotoDokumen = $this->foto_dokumen->store('fotodokumen');
                } else {
                    $fotoDokumen = '';
                }
                $cari_siswa = User::where('nis', $this->siswa)->first();
                $bk = Bk::create([
                    'tanggal' => $this->tanggal,
                    'jenis_bimbingan' => $this->jenis_bimbingan,
                    'bentuk_bimbingan' => $this->bentuk_bimbingan,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'nis' => $this->siswa,
                    'permasalahan' => $this->permasalahan,
                    'penyelesaian' => $this->penyelesaian,
                    'tindak_lanjut' => $this->tindak_lanjut,
                    'user_id' => auth()->user()->id,
                    'foto' => $foto,
                    'foto_dokumen' => $fotoDokumen,
                ]);
                $bk->details()->create([
                    'tanggal' => $this->tanggal,
                    'jenis_bimbingan' => $this->jenis_bimbingan,
                    'bentuk_bimbingan' => $this->bentuk_bimbingan,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'nis' => $this->siswa,
                    'user_name' => $cari_siswa->name,
                    'karakter' => $this->karakter,
                    'permasalahan' => $this->permasalahan,
                    'penyelesaian' => $this->penyelesaian,
                    'tindak_lanjut' => $this->tindak_lanjut,
                    'user_id' => auth()->user()->id,
                    'foto' => $foto,
                    'foto_dokumen' => $fotoDokumen,
                ]);
                $this->dispatchBrowserEvent('notyf', [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Bimbingan Individu'
                ]);
                $this->clearVar();
                break;

            case 'Kelompok':
                $this->resetErrorBag();
                $this->validate();
                if ($this->foto) {
                    $this->validate([
                        'foto' => 'image|max:2048'
                    ]);
                    $foto = $this->foto->store('foto');
                } else {
                    $foto = '';
                }
                if ($this->foto_dokumen) {
                    $this->validate([
                        'foto_dokumen' => 'image|max:2048'
                    ]);
                    $fotoDokumen = $this->foto_dokumen->store('fotodokumen');
                } else {
                    $fotoDokumen = '';
                }
                $bk = Bk::create([
                    'tanggal' => $this->tanggal,
                    'jenis_bimbingan' => $this->jenis_bimbingan,
                    'bentuk_bimbingan' => $this->bentuk_bimbingan,
                    'kelas_id' => $this->kelompok_siswa[0]['id_kelas'],
                    'tahun' => $this->tahun,
                    'nis' => $this->kelompok_siswa[0]['nis_siswa'],
                    'permasalahan' => $this->permasalahan,
                    'penyelesaian' => $this->penyelesaian,
                    'tindak_lanjut' => $this->tindak_lanjut,
                    'user_id' => auth()->user()->id,
                    'foto' => $foto,
                    'foto_dokumen' => $fotoDokumen,
                ]);
                foreach ($this->kelompok_siswa as $key => $kelompok) {
                    $bk->details()->create([
                        'tanggal' => $this->tanggal,
                        'jenis_bimbingan' => $this->jenis_bimbingan,
                        'bentuk_bimbingan' => $this->bentuk_bimbingan,
                        'kelas_id' => $kelompok['id_kelas'],
                        'tahun' => $this->tahun,
                        'nis' => $kelompok['nis_siswa'],
                        'user_name' => $kelompok['nama_siswa'],
                        'permasalahan' => $this->permasalahan,
                        'penyelesaian' => $this->penyelesaian,
                        'tindak_lanjut' => $this->tindak_lanjut,
                        'user_id' => auth()->user()->id,
                        'foto' => $foto,
                        'foto_dokumen' => $fotoDokumen,
                    ]);
                }
                $this->dispatchBrowserEvent('notyf', [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Bimbingan Kelompok'
                ]);
                $this->clearVar();
                $this->kelompok_siswa = [];
                break;

            case 'Kelas':
                $this->resetErrorBag();
                $this->validate();
                if ($this->foto) {
                    $this->validate([
                        'foto' => 'image|max:2048'
                    ]);
                    $foto = $this->foto->store('foto');
                } else {
                    $foto = '';
                }
                if ($this->foto_dokumen) {
                    $this->validate([
                        'foto_dokumen' => 'image|max:2048'
                    ]);
                    $fotoDokumen = $this->foto_dokumen->store('fotodokumen');
                } else {
                    $fotoDokumen = '';
                }
                $cari_siswa = Siswa::where('kelas_id', $this->kelas)
                    ->where('tahun', $this->tahun)
                    ->join('users', 'siswas.nis', '=', 'users.nis')
                    ->select(
                        'users.name as name',
                        'siswas.nis as nis'
                    )
                    ->orderBy('users.name')
                    ->get();
                $bk = Bk::create([
                    'tanggal' => $this->tanggal,
                    'jenis_bimbingan' => $this->jenis_bimbingan,
                    'bentuk_bimbingan' => $this->bentuk_bimbingan,
                    'kelas_id' => $this->kelas,
                    'tahun' => $this->tahun,
                    'nis' => $cari_siswa[0]->nis,
                    'permasalahan' => $this->permasalahan,
                    'penyelesaian' => $this->penyelesaian,
                    'tindak_lanjut' => $this->tindak_lanjut,
                    'user_id' => auth()->user()->id,
                    'foto' => $foto,
                    'foto_dokumen' => $fotoDokumen,
                ]);
                foreach ($cari_siswa as $key => $siswa) {
                    $bk->details()->create([
                        'tanggal' => $this->tanggal,
                        'jenis_bimbingan' => $this->jenis_bimbingan,
                        'bentuk_bimbingan' => $this->bentuk_bimbingan,
                        'kelas_id' => $this->kelas,
                        'tahun' => $this->tahun,
                        'nis' => $siswa->nis,
                        'user_name' => $siswa->name,
                        'permasalahan' => $this->permasalahan,
                        'penyelesaian' => $this->penyelesaian,
                        'tindak_lanjut' => $this->tindak_lanjut,
                        'user_id' => auth()->user()->id,
                        'foto' => $foto,
                        'foto_dokumen' => $fotoDokumen,
                    ]);
                }
                $this->dispatchBrowserEvent('notyf', [
                    'type' => 'success',
                    'message' => 'Berhasil Simpan Bimbingan Kelas'
                ]);
                $this->clearVar();
                break;

            default:
                $this->validate();
                break;
        }
    }

    public function updatedBentukBimbingan()
    {
        $this->kelas = '';
        $this->list_siswa = [];
        $this->siswa = '';
    }
    public function updatedKelas()
    {
        switch ($this->bentuk_bimbingan) {
            case 'Individu':
                $this->get_list_siswa();
                break;
            case 'Kelompok':
                $this->get_list_siswa();
                break;
            default:
                break;
        }
    }
    public function updatedTahun()
    {
        switch ($this->bentuk_bimbingan) {
            case 'Individu':
                $this->get_list_siswa();
                break;
            case 'Kelompok':
                $this->get_list_siswa();
                break;
            default:
                break;
        }
    }
    private function get_list_siswa()
    {
        $this->list_siswa = Siswa::join('users', 'siswas.nis', '=', 'users.nis')
            ->where('siswas.kelas_id', $this->kelas)
            ->where('siswas.tahun', $this->tahun)
            ->select(
                'users.name as name',
                'siswas.nis as nis',
            )
            ->orderBy('users.name')
            ->get();
    }
    public function clearVar()
    {
        $tahunIni = gmdate('Y');
        $bulanIni = gmdate('m');
        if ($bulanIni <= 6) {
            $this->tahun = (intval($tahunIni) - 1) . ' / ' . intval($tahunIni);
        } else {
            $this->tahun = intval($tahunIni) . ' / ' . (intval($tahunIni) + 1);
        }
        $this->tanggal = gmdate('Y-m-d');
        $this->kelas = '';
        $this->list_siswa = [];
        $this->siswa = '';
        $this->jenis_bimbingan = '';
        $this->bentuk_bimbingan = '';
        $this->permasalahan = '';
        $this->penyelesaian = '';
        $this->tindak_lanjut = '';
        $this->foto = '';
        $this->foto_dokumen = '';
    }
}
