@foreach ($users as $user)
    <?php $count = 0; ?>
    <div id="toko{{ $user->id }}">

        @php
            $invoice = [];
        @endphp

        @foreach ($bookings as $booking)
            @if ($booking->product->user_id == $user->id)
                @php
                    $total += $booking->total;
                    $buy = [
                        'mitra_id' => $booking->product->user_id,
                        'title' => $booking->product->title,
                        'jumlah' => $booking->jumlah,
                        'subtotal' => $booking->total,
                    ];
                    array_push($invoice, $buy);
                @endphp

                <div class="row mt-2 py-lg-4 pb-2">
                    <div class="col-4 col-lg-3">
                        <?php
                        $decode = json_decode($booking->product->foto, true);
                        for ($i=0; $i < 1 ; $i++) { 
                        ?>
                        <img src="{{ asset('product/' . $decode[0]) }}"
                            class="img-fluid img-thumbnail text-center border rounded" alt=".."
                            style="object-position: center;overflow: hidden;object-fit: cover;">
                        <?php } ?>

                    </div>
                    <div class="col-8 col-lg-9">
                        <span class="fw-bold text-black-50">{{ $booking->product->title }}</span>
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="text-success">Rp {{ $booking->total }}</h6>
                                <p class="text-black-50 small">Rp {{ $booking->product->harga }} / kg</p>
                            </div>
                            <div class="col-lg-6">
                                <a class="mx-1" onclick="bookDelete({{ $booking->id }})" href="#"><i
                                        class="fa fa-trash fa-pull-right link-danger"></i></a>

                                <div class="number-input form-groyp border-0">
                                    <button
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown() ,bookUpdate({{ $booking->id }})"
                                        class="minus text-white bg-success"
                                        style="border-top-left-radius: 50%;border-bottom-left-radius: 50%;"></button>

                                    <input id="jumlah{{ $booking->id }}" class="border text-center" min="1"
                                        name="quantity" value="{{ $booking->jumlah }}" type="number"
                                        style="width: 100px;" disabled>

                                    <button
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp() ,bookUpdate({{ $booking->id }})"
                                        class="plus text-white bg-success"
                                        style="border-top-right-radius: 50%; border-bottom-right-radius: 50%;"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @endforeach

        <hr>
        <div class="row p-lg-4">
            <div class="col-md-4 mt-2 col-lg-8">
                <h6 class="text-black-50 fw-bold">Nama Petani</h6>
                <img src="{{ asset('assets/avatar/' . $user->avatar) }}" class="img-thumbnail" width="40" alt="">
                <span class="fw-bold fs-6 text-capitalize">{{ $user->name }}</span>
            </div>
            <div class="col-md-8 mt-2 col-lg-4">
                <i class="fa fa-calendar-alt text-black-50"></i>
                <span class="ml-2 fs-6 fw-bold h6 text-black-50">Tanggal Booking</span>
                <input type="hidden" value="{{ $user->no_telp }}">
                <input type="date" class="form-control my-4 rounded-6 btn btn-lg btn-success" name="tanggal"
                    id="tanggal" data-date="" data-date-format="DD MMMM YYYY">
            </div>
        </div>



        <div class="mx-4 float-lg-end">
            <span class="h5 fw-bold text-black-50">Total</span>

            <span class="h5 ml-2 fw-bold text-success">Rp {{ $total }}</span>
            @auth

                <a target="__blank"
                    href="https://wa.me/{{ $user->no_telp }}?text= *Re-Booking!*%0A Hallo kak saya {{ Auth::user()->name }}, %0A _Produk yg saya pesan_ %0A  %0A @foreach ($invoice as $buys) {{ $i++ }}. {{ $buys['title'] }}  %0A       jumlah x {{ $buys['jumlah'] }} = *Rp {{ $buys['subtotal'] }}* %0A @endforeach %0A *Total = Rp {{ $total }}* %0A      Tanggal Booking = "
                    class="btn btn-primary ml-4 px-6 btn-lg rounded-pill text-capitalize">Bayar
                    Sekarang</a>
            @endauth
        </div>

        <br>
        <div class="card-footer my-4">
            <div class="float-none py-4 text-center">

            </div>
        </div>
        @foreach ($title as $prod)
            @if ($prod['mitra_id'] == $user->id)
                <?php $count = count($title); ?>
                @php
                    $total = 0;
                @endphp
            @endif

        @endforeach
    </div>
    {{-- NULL --}}
    @if ($count == 0)
        <style>
            #toko{{ $user->id }} {
                display: none;
            }

        </style>
    @endif
    {{-- NULL --}}
@endforeach
