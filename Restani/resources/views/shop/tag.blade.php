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
                                    <form class="d-none d-md-flex input-group w-auto my-auto fa-pull-right" action="{{ route('shop.tag') }}">
                                        <input type="hidden" value="{{ $categ->id }}" class="form-control" name="search" placeholder='Cari username'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari username'" >

                                        <button type="submit" class="list-group-item text-black-50 list-group-item-action border-0">{{ $categ->name }}</button>
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
                                {{-- loop --}}
                                <div class="col-lg-4 mt-1">
                                    <img src="https://asset.kompas.com/crops/gjGOH-MwyOdc0rOnaV6lUzXlLAo=/100x67:900x600/750x500/data/photo/2020/12/22/5fe16f9b8cfc0.jpg"
                                        class="img-fluid rounded-4" alt="">
                                </div>
                                <div class="col-lg-8 mt-1">
                                    <div class="mt-n2">
                                        <small style="font-size: 12px;">Paket Hemat</small>
                                    </div>
                                    <div class="mt-n2">
                                        <span class="fa fa-star text-warning mt-n1" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star" style="font-size: 12px;"></span>
                                    </div>
                                    <div class="mt-n2">
                                        <small class="text-success fw-bold" style="font-size: 12px;">Rp 75.000</small>
                                    </div>
                                </div>
                                <!-- break -->
                                {{-- loop --}}
                                <div class="col-lg-4 mt-1">
                                    <img src="https://asset.kompas.com/crops/gjGOH-MwyOdc0rOnaV6lUzXlLAo=/100x67:900x600/750x500/data/photo/2020/12/22/5fe16f9b8cfc0.jpg"
                                        class="img-fluid rounded-4" alt="">
                                </div>
                                <div class="col-lg-8 mt-1">
                                    <div class="mt-n2">
                                        <small style="font-size: 12px;">Paket Hemat</small>
                                    </div>
                                    <div class="mt-n2">
                                        <span class="fa fa-star text-warning mt-n1" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star" style="font-size: 12px;"></span>
                                    </div>
                                    <div class="mt-n2">
                                        <small class="text-success fw-bold" style="font-size: 12px;">Rp 75.000</small>
                                    </div>
                                </div>
                                <!-- break -->
                                {{-- loop --}}
                                <div class="col-lg-4 mt-1">
                                    <img src="https://asset.kompas.com/crops/gjGOH-MwyOdc0rOnaV6lUzXlLAo=/100x67:900x600/750x500/data/photo/2020/12/22/5fe16f9b8cfc0.jpg"
                                        class="img-fluid rounded-4" alt="">
                                </div>
                                <div class="col-lg-8 mt-1">
                                    <div class="mt-n2">
                                        <small style="font-size: 12px;">Paket Hemat</small>
                                    </div>
                                    <div class="mt-n2">
                                        <span class="fa fa-star text-warning mt-n1" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                        <span class="fa fa-star" style="font-size: 12px;"></span>
                                    </div>
                                    <div class="mt-n2">
                                        <small class="text-success fw-bold" style="font-size: 12px;">Rp 75.000</small>
                                    </div>
                                </div>
                                <!-- break -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="{{ asset('assets/icon/label.png') }}" class="img-fluid" alt="">
                    <div class="row my-4">
                        <div class="col-4">
                            <button class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#exampleModal">Tambah
                                Produk</button>
                        </div>
                        <div class="col-8">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" placeholder="Cari Produk" aria-label="Search"
                                    aria-describedby="search-addon" />
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        @foreach ($product as $prod)
                            <div class="col-lg-3 col-6 mt-2">
                                <img src="{{ asset('product/' . json_decode($prod->foto)[0]) }}"
                                    class="card-img-top img-fluid rounded-6" alt="Sunset Over the Sea"
                                    style="height: 100px; object-position: center;overflow: hidden;object-fit: cover;" />
            
                                <div class="card rounded-6 mt-n4">
                                    <div class="card-body">
                                        <input class="border-bottom border-0 border-success mx-4 my-1" type="hidden" value="1"
                                            name="jumlah" id="jumlah">
                                        <a href="#add" onclick="cartAdd({{ $prod->id }})"><i
                                                class="fa fa-plus-circle text-success fa-pull-right"></i></a>
                                        <a href="{{ route('shop.preview', ['slug' => $prod->slug]) }}">
            
                                            <p class="card-text text-body mt-n3 fw-bold">
                                                {{ Str::limit($prod->title, 25) }}
                                            </p>
                                            <p class="card-text text-primary small text-success mt-n3 fw-bold">
                                                Rp {{ $prod->harga }}
                                            </p>
                                        </a>
                                        <div class="mt-n1">
                                            <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                            <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                            <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                            <span class="fa fa-star text-warning" style="font-size: 12px;"></span>
                                            <span class="fa fa-star" style="font-size: 12px;"></span>
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
