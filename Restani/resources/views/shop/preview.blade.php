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
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                    </div>
                    <p class="h5 text-success">Rp {{ $product->harga }}</p>
                </div>
               <div id="favorite"></div>

                <br><br><br><br><br>
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

                            <input id="jumlah" class="text-center border" min="1" max="{{ $product->stok }}" name="quantity" value="1" type="number"
                                style="width: 60px; height: 30px;" disabled>

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
                    <input class="btn btn-info rounded my-1 mx-4 text-capitalize w-50 float-right" type="submit"
                        value="Beli Sekarang">

                </div>
                <div class="float-left mt-4">

                    <div class="card my-4">
                        <div class="card-body">
                            <form action="{{ route('chats.addRomm') }}" method="get">
                                <img src="{{ asset('assets/img/landing/aman.png') }}" width="40" alt="">
                                <span class="fw-bold text-capitalize">{{ $product->user->name }}</span>
                                <input type="hidden" name="user_id" value="{{ $product->user->id }}">
                                <a href="#" class="btn btn-success rounded-6 text-capitalize mx-4">Kunjungi Petani</a>
                                @if (Auth::user()->hasRole('user|mitra'))

                                    <button class="btn btn-outline-light text-black-50 rounded-6 text-capitalize ">Chat
                                        Petani </button>
                                @endif

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
                            Ulasan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-capitalize fs-6" id="profile-tab0" data-mdb-toggle="tab"
                            data-mdb-target="#profile0" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">
                            Reviews
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent0">
                    <div class="tab-pane fade show border p-4 rounded-6 active" id="home0" role="tabpanel"
                        aria-labelledby="home-tab0">
                        <!-- foreach -->
                        <h4 class="text-center mb-4 pb-2">Komentar</h4>
                        <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="40"
                                height="40" />
                            <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1">
                                            Maria Smantha <span class="small">- 2 hours ago</span>
                                        </p>
                                        <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small">
                                                reply</span></a>
                                    </div>
                                    <p class="small mb-0">
                                        It is a long established fact that a reader will be distracted by
                                        the readable content of a page.
                                    </p>
                                </div>

                                <div class="d-flex flex-start mt-4">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar"
                                            width="30" height="30" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    Simona Disa <span class="small">- 3 hours ago</span>
                                                </p>
                                            </div>
                                            <p class="small mb-0">
                                                letters, as opposed to using 'Content here, content here',
                                                making it look like readable English.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-start mt-4">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp" alt="avatar"
                                            width="30" height="30" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    John Smith <span class="small">- 4 hours ago</span>
                                                </p>
                                            </div>
                                            <p class="small mb-0">
                                                the majority have suffered alteration in some form, by
                                                injected humour, or randomised words.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- foreach -->
                        <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="40"
                                height="40" />
                            <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1">
                                            Maria Smantha <span class="small">- 2 hours ago</span>
                                        </p>
                                        <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small">
                                                reply</span></a>
                                    </div>
                                    <p class="small mb-0">
                                        It is a long established fact that a reader will be distracted by
                                        the readable content of a page.
                                    </p>
                                </div>

                                <div class="d-flex flex-start mt-4">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar"
                                            width="30" height="30" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    Simona Disa <span class="small">- 3 hours ago</span>
                                                </p>
                                            </div>
                                            <p class="small mb-0">
                                                letters, as opposed to using 'Content here, content here',
                                                making it look like readable English.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-start mt-4">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp" alt="avatar"
                                            width="30" height="30" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    John Smith <span class="small">- 4 hours ago</span>
                                                </p>
                                            </div>
                                            <p class="small mb-0">
                                                the majority have suffered alteration in some form, by
                                                injected humour, or randomised words.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-4 rounded-6" id="profile0" role="tabpanel"
                        aria-labelledby="profile-tab0">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo eos laboriosam, debitis odit
                        voluptatum non repellat neque consectetur impedit ab dicta id doloribus blanditiis rem
                        repellendus expedita, animi aperiam omnis! Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. At, minus sint eos enim provident cupiditate suscipit, reiciendis sit accusamus fugit nemo
                        ipsum iste facilis magni totam commodi illo animi nesciunt! Lorem ipsum dolor sit amet
                        consectetur adipisicing elit. Fugit provident quo ipsum ipsa, repellendus eos suscipit nam.
                        Dignissimos eius ratione ea modi neque libero odit distinctio voluptate, nostrum pariatur saepe!
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
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
