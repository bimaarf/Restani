<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Market</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/wave.css') }}">
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('css/trix.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

    </style>
    @if (Request::url() != 'route("shop.product")')
        <link rel="stylesheet" href="{{ asset('assets/css/number.css') }}">
    @endif

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
</head>

<body>
    <header>
        <!-- Intro settings -->
        <style>
            /* Default height for small devices */
            #intro-example {
                height: 400px;
            }

            /* Height for devices larger than 992px */
            @media (min-width: 992px) {
                #intro-example {
                    height: 600px;
                }
            }

        </style>

        @include('layouts.pages.partial.navbar')

    </header>
    @if (Session::has('sweet_alert.alert'))
        <script>
            swal({!! Session::get('sweet_alert.alert') !!});
        </script>
    @endif
    <div class="container mt-2">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
    </div>
    @yield('content')

    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>

    <script src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
       
        function shopElement() {
            const url = "{{ route('shop.elements.product') }}"
            $.get(url, {}, function(bookings, status) {
                const query = "#product"
                $(query).html(bookings);
            });
        }
        // cart
        function cartAdd(id) {
            const url = "/cart/add/" + id
            const jumlah = $("#jumlah").val()

            $.ajax({
                url: url,
                type: "get",
                data: {
                    jumlah: jumlah
                },
                success: function(response) {
                    swal({
                        title: "Success",
                        text: 'Produk ditambahkan ke keranjang',
                        type: "success",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                    console.log('cart berhasil ditambahkan');
                    cartCount();
                }
            })
        }

        function cartSubTotal(id) {
            const harga = document.getElementById("harga" + id).innerHTML;
            const jumlah = document.getElementById("jumlah" + id).value;
            const total = harga * jumlah;
            document.getElementById('subtotal' + id).innerHTML = total;
        }

        function cartDelete(id) {
            const url = "/cart/delete/" + id
            $.ajax({
                url: url,
                type: "get",
                success: function(response) {
                    swal({
                        title: "Dihapus",
                        text: 'Produk dihapus dari keranjang!',
                        type: "success",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                    console.log('cart berhasil dihapus');
                    cartCount();
                    table();
                }
            })
        }

        function cartUpdate(id) {
            const url = "/cart/update/" + id
            const jumlah = document.getElementById("jumlah" + id).value;
            $.ajax({
                url: url,
                type: "get",
                data: {
                    jumlah: jumlah
                },
                success: function(response) {
                    console.log('cart berhasil diupdate');
                    table();
                }
            })
        }

        function cartUpdateM(id) {
            const url = "/cart/update/" + id
            const jumlah = document.getElementById("jumlahM" + id).value;
            $.ajax({
                url: url,
                type: "get",
                data: {
                    jumlah: jumlah
                },
                success: function(response) {
                    console.log('cart berhasil diupdate');
                    table();
                }
            })
        }

        function table() {
            const url = "{{ route('shop.elements.cart') }}"
            $.get(url, {}, function(carts, status) {
                const query = "#table"
                $(query).html(carts);
            });
        }
        // Booking
        function bookAdd(id) {
            const url = "/booking/add/" + id
            const jumlah = $("#jumlah").val()

            $.ajax({
                url: url,
                type: "get",
                data: {
                    jumlah: jumlah
                },
                success: function(response) {
                    swal({
                        title: "Success",
                        text: 'Produk ditambahkan ke daftar booking',
                        type: "success",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                    console.log('produk di booking');
                }
            })
        }

        function bookUpdate(id) {
            const url = "/booking/update/" + id
            const jumlah = document.getElementById("jumlah" + id).value;
            $.ajax({
                url: url,
                type: "get",
                data: {
                    jumlah: jumlah
                },
                success: function(response) {
                    console.log('re-booking berhasil diupdate');
                    tableBook();
                }
            })
        }

        function bookDelete(id) {
            const url = "/booking/delete/" + id
            $.ajax({
                url: url,
                type: "get",
                success: function(response) {
                    swal({
                        title: "Dihapus",
                        text: 'Produk dihapus dari re-booking!',
                        type: "success",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                    console.log('book / produk berhasil dihapus');
                    cartCount();
                    tableBook();
                }
            })
        }

        function tableBook() {
            const url = "{{ route('shop.elements.booking') }}"
            $.get(url, {}, function(bookings, status) {
                const query = "#booking"
                $(query).html(bookings);
            });
        }
        cartCount();
    </script>

</body>

</html>
