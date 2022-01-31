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
                    <a class="nav-link @yield('booking')" href="{{ route('shop.booking') }}">Re-booking</a>
                </li>
                <li class="nav-item fw-bold mx-4">
                    <a class="nav-link @yield('subscribe')" href="{{ route('shop.subscribe') }}">Langganan</a>
                </li>
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#"
                            class="btn btn-outline-info d-lg-none fw-bold ml-4 fs-6 text-capitalize rounded-pill"
                            onclick="event.preventDefault();
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
        @auth

            <a href="{{ route('chats.index') }}" class="fa fa-comment-dots mx-2"><span
                    class="badge rounded-pill badge-notification bg-danger" id="chat" style="display: none"></span></a>
        @endauth
        <a href="{{ route('shop.favorite') }}" class="fa fa-heart mx-4"><span
                class="badge rounded-pill badge-notification bg-danger" id="favo" style="display: none"></span></a>
        <a href="{{ route('shop.cart') }}" class="fa fa-shopping-cart mx-2"><span
                class="badge rounded-pill badge-notification bg-danger" id="cart" style="display: none"></span></a>
        <div class="align-items-center border-left ml-4 d-lg-flex collapse">
            @if (Auth::check())
                <ul class="navbar-nav d-flex flex-row d-none d-sm-flex ml-4">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center rounded-pill text-capitalize"
                            href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                            aria-expanded="false">

                            <i class="fa fa-user"></i>
                            &nbsp;<span class="font-normal">{{ Auth::user()->name }}</span>&nbsp;


                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item"
                                    href="{{ route('profile.index', ['name' => Auth::user()->name]) }}">Profil</a>
                            </li>

                            <li>
                            @if (Auth::user()->hasRole('admin'))

                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @endif

            <li>

                @if (Auth::check())
                    <button class="dropdown-item" onclick="logout()">Logout</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button id="logoutTrue" class="dropdown-item d-none" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Logout</button>
                    </form>
                @endif
            </li>
            </ul>
            </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="text-success fs-6 fw-bold mx-4">Login</a>
            <a href="{{ route('register') }}"
                class="btn btn-outline-success fw-bold fs-6 text-capitalize rounded-pill">Register</a>
            @endif

        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
@auth
    <script>
        function logout() {
            swal({
                title: "Log out!",
                text: "Are you sure you want to log out?",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            }).then((result) => {
                if (result.dismiss !== 'cancel') {
                    $("#logoutTrue").click();
                }
            })
        }

        function cartCount() {
            const url = "{{ route('shop.elements.countCart') }}";
            $.get(url, {}, function(checkouts, status) {
                const query = "#cart"

                $(query).html(checkouts);
                if (checkouts == 0) {
                    document.getElementById('cart').style.display = 'none';
                } else {
                    document.getElementById('cart').style.display = 'inline';
                }
            });
        }

        function favCount() {
            const url = "{{ route('shop.elements.countFav') }}";
            $.get(url, {}, function(favo, status) {
                const query = "#favo"
                $(query).html(favo);
                if (favo == 0) {
                    document.getElementById('favo').style.display = 'none';
                } else {
                    document.getElementById('favo').style.display = 'inline';
                }
            });
        }

        function chatCount() {
            const url = "{{ route('chats.elements.countChat') }}";
            $.get(url, {}, function(checkouts, status) {
                const query = "#chat"

                $(query).html(checkouts);
                if (checkouts == 0) {
                    document.getElementById('chat').style.display = 'none';
                } else {
                    document.getElementById('chat').style.display = 'inline';
                }
            });
        }

        favCount();
        cartCount();
        chatCount();
    </script>
@endauth
