<?php

namespace App\Http\Livewire\Konseling\Absensi;

use App\Models\Absensi;
use App\Models\Siswa;
use Livewire\Component;

class RekapKehadiran extends Component
{
    // model
    public $tanggal;
    public $jam;
    public $tahun;

    //print
    public $hadir, $izin, $sakit, $alpha, $bolos, $pulang, $siswa, $absensi;
    public function render()
    {
        return view('livewire.konseling.absensi.rekap-kehadiran');
    }
    
    public function updated($property)
    {
        $this->cekRekap();
    }
    public function hydrate()
    {
        $this->cekRekap();
    }
    public function mount()
    {
        $bulan = gmdate('m');
        $tahun = gmdate('Y');
        //make tahun ajaran based on month
        if ($bulan <= 6) {
            $this->tahun = ($tahun - 1) . ' / ' . ($tahun);
        } else {
            $this->tahun = $tahun . ' / ' . ($tahun + 1);
        }
        $this->tanggal = gmdate('Y-m-d');
        $this->jam = '1-2';
        $this->cekRekap();
    }
    private function cekRekap(){
        $this->resetExcept(['tahun', 'tanggal', 'jam']);
        $this->hadir = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Hadir')
                            ->count();
        $this->sakit = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Sakit')
                            ->count();
        $this->izin = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Izin')
                            ->count();
        $this->alpha = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Alpha')
                            ->count();
        $this->bolos = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Bolos')
                            ->count();
        $this->pulang = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->where('kehadirans.nama','Izin Pulang')
                            ->count();
        $this->absensi = Absensi::join('kehadirans','kehadirans.id', '=', 'absensis.kehadiran_id')
                            ->where('absensis.jam', $this->jam)
                            ->where('absensis.tanggal',$this->tanggal)
                            ->where('absensis.tahun', $this->tahun)
                            ->count();
        $this->siswa = Siswa::where('tahun', $this->tahun)->count();
    }
}
