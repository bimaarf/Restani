@extends('layouts.pages.main')
@section('shop', 'active')
@section('content')
    <div class="container-lg mt-4">
        <div id="product">
            <div class="row">
                <div class="col-lg-3 d-lg-block collapse">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-black-100 fw-bold">Produk Kategori</h6>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">

                                @foreach ($category as $categ)
                                    <form class="d-none d-md-flex input-group w-auto my-auto fa-pull-right"
                                        action="{{ route('shop.tag') }}">
                                        <input type="hidden" value="{{ $categ->id }}" class="form-control" name="search"
                                            placeholder='Cari username' onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Cari username'">

                                        <button type="submit"
                                            class="list-group-item text-black-50 list-group-item-action border-0">{{ $categ->name }}</button>
                                    </form>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h6 class="text-black-100 fw-bold">Produk Terlaris</h6>
                        </div>
                        <div class="card-body align-middle d-flex justify-content-between">
                            <div class="row">
                                @foreach ($productLaris->slice(0, 3) as $prod)
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
                                    {{-- loop --}}
                                    <div class="col-lg-4 mb-2">
                                        <img src="{{ asset('product/' . json_decode($prod->foto)[0]) }}"
                                            class="img-fluid rounded-4" alt=""
                                            style="width:200px; height: 60px; object-position: center;overflow: hidden;object-fit: cover;">
                                    </div>
                                    <div class="col-lg-8 mt-2">
                                        <div class="mt-n2">
                                            <small style="font-size: 12px;">{{ Str::limit($prod->title, 20) }}</small>
                                        </div>
                                        <div class="mt-n2" id="stars{{ $prod->id }}">

                                        </div>
                                        <div class="mt-n1">
                                            <small class="text-success fw-bold" style="font-size: 12px;">Rp
                                                {{ $prod->harga }}</small>
                                        </div>
                                    </div>
                                    <!-- break -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="{{ asset('assets/icon/label.png') }}" class="img-fluid" alt="">
                    <div class="row my-4">
                        <div class="col-4">

                        </div>
                        <div class="col-8">
                            <form action="{{ route('shop.tag') }}">
                                <div class="input-group rounded">
                                    <input type="search" class="form-control rounded" name="title" placeholder="Cari Produk"
                                        aria-label="Search" value="{{ request('title') }}"
                                        aria-describedby="search-addon" />
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <marquee>{{ $notFound }}</marquee>
                        @foreach ($product as $prod)
                            <style>
                                marquee {
                                    display: none
                                }

                            </style>

                            <script>
                                function starsSide(id) {
                                    const url = "/stars/" + id
                                    $.get(url, {}, function(product, status) {
                                        const query = "#starsSide" + id
                                        $(query).html(product);
                                    });
                                }
                                starsSide({{ $prod->id }})
                            </script>

                            <div class="col-lg-3 col-6 mt-2">
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
                                        <div class="mt-n1" id="starsSide{{ $prod->id }}">


                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
<script>

</script>
