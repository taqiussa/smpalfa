<header class="header shadow">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-20">
                        <button id="menu-toggle" class="btn btn-primary rounded-pill">
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <!-- Profile start -->
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    {{-- <h6>{{ auth()->user()->name }}</h6> --}}
                                    <div class="image">
                                        <img src="{{ asset('images/logoalfa.png') }}" alt="" />
                                        <span class="status"></span>
                                    </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                </form>
                            </li>
                        </ul>
                        {{-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li class="d-flex justify-content-center">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="px-1" type="submit"> <i class="lni lni-exit"></i> Log
                                        Out </button>
                                </form>
                            </li>
                        </ul> --}}
                    </div>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>
