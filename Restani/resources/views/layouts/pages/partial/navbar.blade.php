<nav class="navbar navbar-expand-lg navbar-light">
    <!-- Container wrapper -->
    <div class="container-lg">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse text-center navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0 d-lg-block collapse" href="#">
                <img src="{{ asset('assets/icon/restani.png') }}" height="50" alt="MDB Logo" loading="lazy" />
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item fw-bold mx-4">
                    <a class="nav-link @yield('welcome')" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item fw-bold mx-4">
                    <a class="nav-link @yield('shop')" href="{{ route('shop.product') }}">Shop</a>
                </li>
                <li class="nav-item fw-bold mx-4">
                    <a class="nav-link" href="#">Re-booking</a>
                </li>
                <li class="nav-item fw-bold mx-4">
                    <a class="nav-link" href="#">Subscribe</a>
                </li>
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" class="btn btn-outline-info d-lg-none fw-bold ml-4 fs-6 text-capitalize rounded-pill" onclick="event.preventDefault();
                this.closest('form').submit();">Logout</a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-success d-lg-none fs-6 fw-bold mx-4">Login</a>
                @endif
            </ul>
            <!-- Left links -->

            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="align-items-center border-left d-lg-flex collapse">
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" class="btn btn-outline-info fw-bold ml-4 fs-6 text-capitalize rounded-pill" onclick="event.preventDefault();
                this.closest('form').submit();">Logout</a>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-success fs-6 fw-bold mx-4">Login</a>
                <a href="#" class="btn btn-outline-success fw-bold fs-6 text-capitalize rounded-pill">Register</a>
            @endif

        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
