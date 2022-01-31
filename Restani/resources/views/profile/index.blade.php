@extends('layouts.pages.main')
@section('shop', 'active')
@section('content')
    <div class="container-sm mt-4 px-lg-5">
        @auth

            @if ($users->id == Auth::user()->id)
                @include('shop.modal.modal_add_product')

                <!-- Button trigger modal -->
                <!-- Modal -->

                <div class="modal top fade" id="img-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                    data-mdb-backdrop="static" data-mdb-keyboard="true">
                    <div class="modal-dialog   modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Profil</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="file" name="avatar" class="form-control form-control-file">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            @endif
        @endauth

        <section class="h-100 gradient-custom-2">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-9 col-xl-12">
                        <div class="card">
                            <div class="rounded-top text-white d-flex flex-row"
                                style="background-color: #000; height:200px;">
                                <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                    <img src="{{ asset('assets/avatar/' . $users->avatar) }}"
                                        alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                        style="width: 150px; z-index: 1" @auth @if ($users->id == Auth::user()->id) data-mdb-toggle="modal"
                                    data-mdb-target="#img-profile" @endif @endauth>
                                    @auth

                                        @if ($users->id == Auth::user()->id)
                                            <i class="fas fa-pen-alt text-black"
                                                style="z-index: 1; margin-left:130px;margin-top: -145px"></i>
                                        @endif
                                    @endauth

                                </div>
                                <div class="ms-3" style="margin-top: 130px;">
                                    <h5 class="text-capitalize">{{ $users->name }}</h5>
                                    <p>{{ $users->email }}</p>
                                </div>
                            </div>

                            <div class="p-4 text-black" style="background-color: #f8f9fa;">
                                <div class="d-flex justify-content-end text-center py-1">
                                    <div>
                                        <p class="mb-1 h5">{{ count($product) }}</p>
                                        <p class="small text-muted mb-0">Product</p>
                                    </div>
                                    <div class="px-3">
                                        <p class="mb-1 h5">{{ $comCount }}</p>
                                        <p class="small text-muted mb-0">Comments</p>
                                    </div>
                                    <div>
                                        <p class="mb-1 h5">{{ $favCount }}</p>
                                        <p class="small text-muted mb-0">Favorite</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 text-black">
                                @auth

                                    @if ($users->id == Auth::user()->id)
                                        <div class="mb-5">
                                            <p class="lead fw-normal mb-1">Profile Saya</p>
                                            <div class="p-4" style="background-color: #f8f9fa;">
                                                <div class="input-group form-group">
                                                    <label class="pr-4">Username</label>
                                                    <input class="form-control mx-3 bg-transparent border-0" type="text"
                                                        value="{{ Auth::user()->name }}" disabled>
                                                </div>
                                                <div class="input-group form-group">
                                                    <label class="pr-4" style="margin-right: 25px">Email</label>
                                                    <input class="form-control mx-4 bg-transparent border-0" type="text"
                                                        value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                                <div class="input-group form-group">
                                                    <label class="pr-4" style="margin-right: 12px">No. Telp</label>
                                                    <input name="no_telp" id="no_telp" class="form-control mx-4" type="number"
                                                        value="{{ Auth::user()->no_telp }}" required placeholder="628XXX">
                                                    <a href="" onclick="telpUpdate()" class="link-success"><i
                                                            class="fas fa-pen-alt"></i></a>
                                                </div>
                                                <div class="input-group form-group">
                                                    <label class="pr-4">Password</label>
                                                    <input id="password" name="password" minlength="8" maxlength="16"
                                                        class="form-control mx-4" type="password" value=""
                                                        placeholder="Enter your password">
                                                    <a href="#" onclick="passUpdate()" class="link-success"><i
                                                            class="fas fa-pen-alt"></i></a>
                                                </div>
                                                <div class="input-group form-group">
                                                    <label style="margin-right: 25px">Jenis Akun</label>
                                                    @if (Auth::user()->hasRole('user'))
                                                        <p class="ml-4 text-info">User</p>
                                                    @endif
                                                    @if (Auth::user()->hasRole('admin'))
                                                        <p class="ml-4">Admin</p>
                                                    @endif
                                                    @if (Auth::user()->hasRole('mitra'))
                                                        <p class="ml-4">Mitra</p>
                                                    @endif
                                                </div>
                                                <div class="input-group form-group">
                                                    <label style="margin-right: 25px">Jenis Kelamin</label>
                                                    <p class="ml-1">{{ Auth::user()->jenis_kelamin }}</p>

                                                </div>
                                            </div>
                                        </div>
                                        <style>
                                            .umum {
                                                display: none;
                                            }

                                        </style>
                                    @endif
                                @endauth
                                <div class="mb-5 umum">
                                    <p class="lead fw-normal mb-1 text-capitalize">Profile {{ $users->name }}</p>
                                    <div class="p-4" style="background-color: #f8f9fa;">
                                        <div class="input-group form-group">
                                            <label class="pr-4">Username</label>
                                            <input class="form-control mx-3 bg-transparent border-0" type="text"
                                                value="{{ $users->name }}" disabled>
                                        </div>
                                        <div class="input-group form-group">
                                            <label class="pr-4" style="margin-right: 12px">No. Telp <i
                                                    class="fab fa-whatsapp ml-1 text-success"></i></label>
                                            <a
                                                href="https://wa.me/{{ $users->no_telp }}?text=Hallo kak, saya @auth {{ Auth::user()->name }} @endauth">
                                                <p class="ml-2">+{{ $users->no_telp }}</p>
                                            </a>
                                        </div>
                                        <div class="input-group form-group">
                                            <label style="margin-right: 25px">Jenis Akun</label>
                                            @if ($users->hasRole('user'))
                                                <p class="ml-4 text-info">User</p>
                                            @endif
                                            @if ($users->hasRole('admin'))
                                                <p class="ml-4">Admin</p>
                                            @endif
                                            @if ($users->hasRole('mitra'))
                                                <p class="ml-4">Mitra</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($users->hasRole('mitra|admin'))

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <p class="lead fw-normal mb-0">Produk {{ $users->name }}</p>

                                        @auth

                                            @if ($users->id == Auth::user()->id)
                                                <button class="btn btn-success" data-mdb-toggle="modal"
                                                    data-mdb-target="#exampleModal">Tambah
                                                    Produk</button>
                                            @endif
                                        @endauth
                                    </div>
                                @endif

                                <div class="row g-2">
                                    @if (count($product) == 0)
                                        <marquee>Tidak ada produk yg ditambahkan!</marquee>

                                    @endif
                                    @foreach ($product as $prod)
                                        @include('shop.modal.modal_upd_product')
                                        <div class="col-lg-3 col-6 mt-2">
                                            @auth

                                                @if ($prod->user_id == Auth::user()->id)
                                                    <a href="#" onclick="proDelete({{ $prod->id }})"
                                                        class="fa fa-trash link-danger float-right"></a>

                                                    <p class="fa fa-pen-alt link-warning float-right mx-2"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#upd-product{{ $prod->id }}"></p>

                                                @endif
                                            @endauth

                                            <img src="{{ asset('product/' . json_decode($prod->foto)[0]) }}"
                                                class="card-img-top img-fluid rounded-6" alt="Sunset Over the Sea"
                                                style="height: 100px; object-position: center;overflow: hidden;object-fit: cover;" />

                                            <div class="card rounded-6 mt-n4">
                                                <div class="card-body">
                                                    <input class="border-bottom border-0 border-success mx-4 my-1"
                                                        type="hidden" value="1" name="jumlah" id="jumlah">
                                                    <a href="#add" onclick="cartAdd({{ $prod->id }})"><i
                                                            class="fa fa-plus-circle text-success position-absolute"
                                                            style="right: 10px; top: 10px"></i></a>

                                                    <a href="{{ route('shop.preview', ['key' => $prod->key]) }}">

                                                        <p class="card-text text-body mt-n3 fw-bold small">
                                                            {{ Str::limit($prod->title, 20) }}
                                                        </p>
                                                        <p
                                                            class="card-text text-primary small text-success mt-n3 small fw-bold">
                                                            Rp {{ $prod->harga }}
                                                        </p>
                                                    </a>
                                                    <div class="mt-n1" id="stars{{ $prod->id }}">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            function stars(id) {
                                                const url = "/stars/" + id
                                                $.get(url, {}, function(product, status) {
                                                    const query = "#stars" + id
                                                    $(query).html(product);
                                                });
                                            }
                                            stars({{ $prod->id }})
                                        </script>
                                    @endforeach
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script>
    function telpUpdate() {
        const url = "{{ route('profile.telp') }}"
        const no_telp = document.getElementById("no_telp").value;
        $.ajax({
            url: url,
            type: "get",
            data: {
                no_telp: no_telp
            },
            success: function(response) {
                $('.btn').attr('disabled', false);
                swal({
                    title: "Berhasil",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: false,
                })

            }
        })
    }

    function passUpdate() {
        const url = "{{ route('profile.pass') }}"
        const password = document.getElementById("password").value;
        $.ajax({
            url: url,
            type: "get",
            data: {
                password: password
            },
            success: function(response) {
                if ($('#password').val()) {
                    $('.btn').attr('disabled', false);
                    swal({
                        title: "Berhasil",
                        type: "success",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                } else {
                    $('.btn').attr('disabled', false);
                    swal({
                        title: "Error!",
                        text: "Password tidak boleh kosong!",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: false,
                    })
                }
            }
        })
    }
</script>
