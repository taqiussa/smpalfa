untuk kepentingan upload di hosting
yang perlu di rubah
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
}
2. Spatie Role tambahkan Sluggable
Vendor/spatie/laravel-permission/src/Models/Role.php
3. config/app.php
timezone, locale, faker_local id_ID

4. ABSENSI EKSTRA
5. Karakter Siswa / Keterangan di Bimbingan
6. Input Skor X jumlah = Kasir