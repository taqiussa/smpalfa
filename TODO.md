untuk kepentingan upload di hosting
yang perlu di rubah
Index.php di public di sesuaikan vendor/autoload.php
1. Vendor/laravel/ui/auth-backend/AuthenticatesUsers.php {
     public function username()
    {
        $login = request('username');
        if(is_numeric($login)){
            $field = 'nis';
        }else{
            $field = 'email';
        }
        request()->merge([$field => $login]);
        return $field;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            // $this->username() => [trans('auth.failed')],
            $this->username() => 'Username / Password Salah',
        ]);
    }

     public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

}
2. Spatie Role tambahkan Sluggable
Vendor/spatie/laravel-permission/src/Models/Role.php
3. config/app.php
timezone, locale, faker_local id_ID

1. Input Skor X jumlah = Kasir
2. Menu  Siswa Kurang  Nilai 
3. Print Skor Per Siswa
4. Jurnal Guru dan Jurnal Wali Kelas - pending akhir tahun
5. Rekap Bimbingan Print
6. Rekap Skor Print - belum selesai, Rekap Skor Per Siswa / Download Per Siswa
7. rekapan ekstra per kelas - buat print rekap data siswa per ekstra
8. Print data skor per siswa mengacu pada nomor 13
9. Nilai Quran - on going - kurang print per siswa
10. alpha dari skor
11. Tambah Siswa - kurang data alamat dan lain lain
12. Input Nilai Ekstra sesuaikan dengan Input Nilai SUDAH - kalau perlu buat Upload Nilai Ekstra ini belum
13. Guru list kelas sesuai SK mengajar
14. Rekap Pembayaran / Tagihan Per kelas
15. Print Data Ekstra per kelas + Nilai, TTD Pembina, Kesiswaan , Kasek
16. BK pembuatan karakter SISWA
17. RAPBS