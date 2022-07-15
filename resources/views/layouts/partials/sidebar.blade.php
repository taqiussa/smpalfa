<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="index.html">
            <img class="w-50 img-fluid" src="{{ asset('images/logoalfa.png') }}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <h6 class="mx-3 mb-3">{{ auth()->user()->name }}</h6>
        @role('Admin')
            @include('layouts.partials.sidebar.sidebar-admin', ['title' => 'Admin'])
        @endrole
        @role('Bendahara')
            @include('layouts.partials.sidebar.sidebar-bendahara', ['title' => 'Bendahara'])
        @endrole
        @role('Guru')
            @include('layouts.partials.sidebar.sidebar-guru', ['title' => 'Guru'])
        @endrole
        @role('Konseling')
        @include('layouts.partials.sidebar.sidebar-konseling', ['title' => 'Konseling'])
        @endrole
        @role('Kreator')
        @include('layouts.partials.sidebar.sidebar-kreator', ['title' => 'Kreator'])
        @endrole
        @role('Kurikulum')
            @include('layouts.partials.sidebar.sidebar-kurikulum', ['title' => 'Kurikulum'])
        @endrole
        @role('Sarpras')
            @include('layouts.partials.sidebar.sidebar-sarpras', ['title' => 'Sarpras'])
        @endrole
        @role('Siswa')
            @include('layouts.partials.sidebar.sidebar-siswa', ['title' => 'Siswa'])
        @endrole
        @role('Tata Usaha')
            @include('layouts.partials.sidebar.sidebar-tata-usaha', ['title' => 'Tata Usaha'])
        @endrole
    </nav>
</aside>
<div class="overlay"></div>
