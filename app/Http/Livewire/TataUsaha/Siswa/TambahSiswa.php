<?php

namespace App\Http\Livewire\TataUsaha\Siswa;

use App\Models\User;
use Livewire\Component;

class TambahSiswa extends Component
{
    // model
    public $nama;
    public $nis;
    // public $nisn;
    // public $nik;
    // public $jenis_kelamin;
    // public $tanggal_lahir;
    // public $telepon;
    // public $skhun;
    // public $no_ijazah;
    // public $no_kps;
    // public $rt;
    // public $rw;
    // public $desa;
    // public $kecamatan;
    // public $kabupaten;
    // public $provinsi;
    // public $kode_pos;
    // public $nama_sekolah;
    // public $desa_sekolah;
    // public $kecamatan_sekolah;
    // public $kabupaten_sekolah;
    // public $provinsi_sekolah;
    // public $nama_ayah;
    // public $pekerjaan_ayah;
    // public $nama_ibu;
    // public $pekerjaan_ibu;
    // public $nama_wali;
    // public $pekerjaan_wali;

    protected $rules =[
        'nis' => 'required|unique:users',
        'nama' => 'required'
    ];
    public function render()
    {
        return view('livewire.tata-usaha.siswa.tambah-siswa');
    }

    public function simpan()
    {
        $this->validate();
        try {
            User::create(
                [
                    'name' => $this->nama,
                    'nis' => $this->nis,
                    'password' => bcrypt('12345678'),
                ]
                );
                $this->dispatchBrowserEvent('notyf', ['type' => 'success' ,'message' => 'Berhasil Menambah Siswa']);
            } catch (\Throwable $th) {
                
                $this->dispatchBrowserEvent('notyf', ['type' => 'error' ,'message' => 'Koneksi terputus, Ulangi']);
        }
    }
    
}
