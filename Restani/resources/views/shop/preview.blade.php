@extends('layouts.pages.main')
@section('content')
    <div class="container card mt-2">
        <div class="row">
            <div class="col-lg-4 my-2 card-body">

                <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach (json_decode($product->foto) as $key => $slider)
                            <button type="button" data-mdb-target="#carouselBasicExample"
                                data-mdb-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                aria-current="true" aria-label="Slide 1"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">

                        @foreach (json_decode($product->foto) as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('product/' . $slider) }}" class="img-fuild img-thumbnail"
                                    style="height: 300px;width:400px;object-position: center;overflow: hidden;object-fit: cover;"
                                    alt="...">

                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-capitalize">Stok Tersedia</h5>
                                    <p>{{ $product->stok }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-lg-8 card-body">
                <div class="float-left">
                    <p class="text-black-50 fw-bold h5">{{ $product->title }}</p>
                    <div class="my-1">
                        @if (count($ratting) > 0)
                            @if ($mean / count($ratting) > 0 && $mean / count($ratting) < 2)
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                            @endif
                            @if ($mean / count($ratting) >= 2 && $mean / count($ratting) < 3)
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                            @endif
                            @if ($mean / count($ratting) >= 3 && $mean / count($ratting) < 4)
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                            @endif
                            @if ($mean / count($ratting) >= 4 && $mean / count($ratting) < 5)
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star" style="font-size: 10px;"></span>
                            @endif
                            @if ($mean / count($ratting) == 5)
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                                <span class="fa fa-star text-warning" style="font-size: 10px;"></span>
                            @endif
                            <br>
                            <div style="font-size: 12px;">
                                {{ $mean / count($ratting) }} <small class="text-black-50">({{ count($ratting) }}
                                    Ulasan)</small>
                            </div>

                        @else
                            <span class="fa fa-star" style="font-size: 10px;"></span>
                            <span class="fa fa-star" style="font-size: 10px;"></span>
                            <span class="fa fa-star" style="font-size: 10px;"></span>
                            <span class="fa fa-star" style="font-size: 10px;"></span>
                            <span class="fa fa-star" style="font-size: 10px;"></span>
                            <div style="font-size: 12px;">
                                <small class="text-black-50">(Belum ada ulasan)</small>
                            </div>
                        @endif

                    </div>
                    <p class="h5 text-success">Rp {{ $product->harga }}</p>
                </div>
                <div id="favorite"></div>

                <br><br><br><br><br>
                <span class="float-end"><i class="fas fa-tags"></i> {{ $product->kategori->name }}</span>
                @if ($product->stok > 0)
                    <i class="fa fa-check bg-success text-white rounded-circle p-1"></i> <span
                        class="ml-2 fw-bold h6 text-black-50">Stok Tersedia</span> <span
                        class="text-info">{{ $product->stok }}</span>
                @else
                    <span class="ml-2 fw-bold h6 text-danger">Stok Habis</span>
                @endif
                <div class="float-none">
                    <p class="text-body border-bottom pb-4">{!! $product->desc !!}</p>

                    <div class="float-left">

                        <label for="jumlah">Jumlah</label>
                        <div class="number-input form-group ml-3 border-0 float-right">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                class="minus text-black-50 border" style="height: 30px ; width: 20px"></button>

                            <input id="jumlah" class="text-center border" min="1" max="{{ $product->stok }}"
                                name="quantity" value="1" type="number" style="width: 60px; height: 30px;" disabled>

                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                class="plus text-black-50 border" style="height: 30px ; width: 20px"></button>
                        </div>

                    </div>

                    <button onclick="cartAdd({{ $product->id }})"
                        class="btn btn-success rounded my-1 mx-4 text-capitalize float-right" type="submit"> <i
                            class="fa fa-shopping-cart"></i><span class="d-lg-inline collapse"> Masukkan
                            Keranjang</span></button>
                    <button onclick="bookAdd({{ $product->id }})"
                        class="btn btn-info rounded my-1 mx-4 text-capitalize w-50 float-right"
                        type="submit">Re-Booking</button>
                    <button onclick="subAdd({{ $product->id }})"
                        class="btn btn-info rounded my-1 mx-4 text-capitalize w-50 float-right"
                        type="submit">Langganan</button>
                    @auth

                        <a target="__blank"
                            href="https://wa.me/{{ $product->user->no_telp }}?text= *Re-Booking!*%0A Hallo kak saya {{ Auth::user()->name }}, %0A _Produk yg saya pesan_ %0A  %0A {{ $product->title }}%0A       jumlah ="
                            class="btn btn-info rounded my-1 mx-4 text-capitalize w-50 float-right">Bayar
                            Sekarang</a>
                    @endauth


                </div>
                <div class="float-left mt-4">

                    <div class="card my-4">
                        <div class="card-body">
                            <form action="{{ route('chats.addRomm') }}" method="get">
                                <img src="{{ asset('assets/avatar/' . $product->user->avatar) }}" width="40" alt="">
                                <span class="fw-bold text-capitalize">{{ $product->user->name }}</span>
                                <input type="hidden" name="user_id" value="{{ $product->user->id }}">
                                <a href="{{ route('profile.index', ['name' => $product->user->name]) }}"
                                    class="btn btn-success rounded-6 text-capitalize mx-4">Kunjungi Petani</a>
                                @auth

                                    @if (Auth::user()->hasRole('user'))

                                        <button class="btn btn-outline-light text-black-50 rounded-6 text-capitalize ">Chat
                                            Petani </button>
                                    @endif
                                @endauth


                            </form>
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-map-marker-alt text-success"></i>
                        <label for="lokasi">Lokasi</label>
                        <span class="border-bottom border-primary px-1 ml-4">{{ $product->lokasi }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-capitalize fs-6 active" id="home-tab0" data-mdb-toggle="tab"
                            data-mdb-target="#home0" type="button" role="tab" aria-controls="home" aria-selected="true">
                            Comments
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-capitalize fs-6" onclick="ratShow({{ $product->id }})"
                            id="profile-tab0" data-mdb-toggle="tab" data-mdb-target="#profile0" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">
                            Reviews
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent0">
                    <div class="tab-pane fade show border p-4 rounded-6 active" id="home0" role="tabpanel"
                        aria-labelledby="home-tab0">
                        <a href="#!" class="float-right" onclick="comment()"><i class="fas fa-reply fa-xs"></i><span
                                class="small">
                                Add comment</span></a>
                        <h4 class="text-center mb-4 pb-2">Komentar</h4>
                        <form id="form-comment" class="input-group my-4"
                            action="{{ route('comment.store', ['id' => $product->id]) }}">
                            <input id="message" type="text" value="" maxlength="250"
                                class="form-control border-0 border-bottom" name="message" placeholder='Ketikkan komentar..'
                                style="border-color: inherit;
                                                                                        -webkit-box-shadow: none;
                                                                                        box-shadow: none;">

                            <button onclick="addComment({{ $product->id }})" type="submit"
                                class="btn btn-outline-success fas fa-paper-plane"></button>
                        </form>
                        {{-- comment --}}
                        <div id="box-comment"></div>
                    </div>
                    <div class="tab-pane fade border p-4 rounded-6" id="profile0" role="tabpanel"
                        aria-labelledby="profile-tab0">
                        <div id="ratting"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        var subCondition = true;
        var comCondition = true;

        function commentElement(id) {
            const url = '/comment/show/' + id
            $.get(url, {}, function(comments, status) {
                const query = "#box-comment"
                $(query).html(comments)
            })
        }

        function comment() {
            if (comCondition == true) {
                $("#form-comment").addClass('d-none');
                console.log(comCondition)
                comCondition = false
            } else {
                $("#form-comment").removeClass('d-none');
                console.log(comCondition)
                comCondition = true
            }
        }

        function subComment(id) {
            if (subCondition == true) {
                $("#form-sub" + id).removeClass('d-none');

                subCondition = false;

            } else if (subCondition == false) {
                $("#form-sub" + id).addClass('d-none');

                subCondition = true;
            }
        }

        setTimeout(() => {
            commentElement({{ $product->id }});

        }, 1000);

        function addComment(id) {
            const url = "/comment/add/" + id
            const formComment = '#form-comment'
            $('.btn').attr('disabled', true);
            $.ajax({
                url: url,
                type: "GET",
                data: $(formComment).serialize(),
                success: function(response) {
                    $('.btn').attr('disabled', false);
                    $('#message').val('');
                    commentElement(id)
                },
                error: function(response) {
                    if ($('#message').val()) {
                        $('.btn').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Anda perlu login!",
                            type: "warning",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: false,
                        })
                    } else {
                        $('.btn').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Text tidak boleh kosong!",
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: false,
                        })
                    }
                }
            })
        }

        function addSub(id) {
            const url = "/sub-comment/add/" + id
            const message = $('#sub-message' + id).val()
            $('.btn').attr('disabled', true);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    message: message
                },
                success: function(response) {
                    $('.btn').attr('disabled', false);
                    $('#sub-message' + id).val('');
                    commentElement({{ $product->id }})
                },
                error: function(response) {
                    if ($('#sub-message' + id).val()) {
                        $('.btn').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Anda perlu login!",
                            type: "warning",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: false,
                        })
                    } else {
                        $('.btn').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Text tidak boleh kosong!",
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: false,
                        })
                    }

                }
            })
        }


        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault()
            ''
        })
        const product_id = '{{ $product->id }}';
        window.onload = function() {
            favShow(product_id);
        }
    </script>

@endsection
