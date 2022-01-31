@extends('layouts.pages.main')
@section('content')
    <main class="mt-4 d-lg-block container">
        <div class="row">
            <div class="col-lg-4">
                <nav class="d-lg-block collapse" style="z-index: 9; height: 700px">
                    <!-- Search form -->
                    <div class="card"
                        style="border-top-left-radius: 50px; border-bottom-left-radius: 50px; height:100%;">
                        <div class="position-sticky">
                            <div class="list-group list-group-flush pt-4 mx-4">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ asset('assets/avatar/' . Auth::user()->avatar) }}"
                                            class="img-thumbnail rounded-circle" alt="">
                                    </div>
                                    <div class="col-9 align-self-center">
                                        <h4 class="text-capitalize text-black-100">{{ Auth::user()->name }}</h4>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="list-group-item list-group-item-action rounded-6 {{ Route::is('admin.dashboard') ? 'active' : '' }} mt-3">
                                    <div class="row">
                                        <div class="col-2 far fa-circle fs-1"></div>
                                        <div class="col-1"></div>
                                        <div class="col-8 align-self-center">
                                            <span class="fs-6 ">Dashboard</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('admin.product') }}"
                                    class="list-group-item list-group-item-action rounded-6 {{ Route::is('admin.product') ? 'active' : '' }} mt-3"
                                    style="margin-bottom: 40vh">
                                    <div class="row">
                                        <div class="col-2 far fa-circle fs-1"></div>
                                        <div class="col-1"></div>
                                        <div class="col-8 align-self-center">
                                            <span class="fs-6 ">Product</span>
                                        </div>
                                    </div>
                                </a>



                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-8 badan">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product') }}">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" name="title" placeholder="Cari Produk"
                                    aria-label="Search" value="{{ request('title') }}" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row g-2">
                            <marquee>Produk yg anda cari tidak tersedia 😇</marquee>

                            @foreach ($product as $prod)
                                <style>
                                    marquee {
                                        display: none
                                    }

                                </style>
                                @include('shop.modal.modal_upd_product')
                                <div class="col-lg-3 col-6 mt-2">

                                    <a href="#" onclick="proDelete({{ $prod->id }})"
                                        class="fa fa-trash link-danger float-right"></a>

                                    <p class="fa fa-pen-alt link-warning float-right mx-2" data-mdb-toggle="modal"
                                        data-mdb-target="#upd-product{{ $prod->id }}"></p>


                                    <img src="{{ asset('product/' . json_decode($prod->foto)[0]) }}"
                                        class="card-img-top img-fluid rounded-6" alt="Sunset Over the Sea"
                                        style="height: 100px; object-position: center;overflow: hidden;object-fit: cover;" />

                                    <div class="card rounded-6 mt-n4">
                                        <div class="card-body">
                                            <input class="border-bottom border-0 border-success mx-4 my-1" type="hidden"
                                                value="1" name="jumlah" id="jumlah">
                                            <a href="#add" onclick="cartAdd({{ $prod->id }})"><i
                                                    class="fa fa-plus-circle text-success position-absolute"
                                                    style="right: 10px; top: 10px"></i></a>

                                            <a href="{{ route('shop.preview', ['key' => $prod->key]) }}">

                                                <p class="card-text text-body mt-n3 fw-bold small">
                                                    {{ Str::limit($prod->title, 20) }}
                                                </p>
                                                <p class="card-text text-primary small text-success mt-n3 small fw-bold">
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
    </main>

@endsection
