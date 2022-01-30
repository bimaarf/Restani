    <div class="table-responsive-lg">
        <table class="table table-borderless border d-sm-none d-lg-table collapse">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <?php $count = 0; ?>
                <tbody id="toko{{ $user->id }}">
                    @php
                        $invoice = [];
                    @endphp
                    @foreach ($carts as $cart)

                        @if ($cart->product->user_id == $user->id)
                            @php
                                $total += $cart->total;
                                $buy = [
                                    'mitra_id' => $cart->product->user_id,
                                    'title' => $cart->product->title,
                                    'jumlah' => $cart->jumlah,
                                    'subtotal' => $cart->total,
                                ];
                                array_push($invoice, $buy);
                            @endphp
                            <tr>
                                <td>
                                    <?php
                                $decode = json_decode($cart->product->foto, true);
                                for ($i=0; $i < 1 ; $i++) { 
                                ?>
                                    <img src="{{ asset('product/' . $decode[0]) }}"
                                        class="img-fluid img-thumbnail text-center border rounded" alt=".."
                                        style="height: 40px;width:50px;object-position: center;overflow: hidden;object-fit: cover;">
                                    <?php } ?>

                                </td>
                                <td>{{ Str::limit($cart->product->title, 50) }}</td>
                                <td>Rp <span id="harga{{ $cart->id }}">{{ $cart->product->harga }}</span></td>
                                {{-- <input id="harga{{ $cart->id }}" type="text" value="{{ $cart->product->harga }}"> --}}
                                <td>
                                    <div class="number-input border-0">
                                        <button
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown() ,cartUpdate({{ $cart->id }})"
                                            class="minus text-white bg-success"
                                            style="border-top-left-radius: 50%;border-bottom-left-radius: 50%;"></button>
                                        <input id="jumlah{{ $cart->id }}" class="quantity border-0 text-center"
                                            min="1" max="{{ $cart->product->stok }}" name="quantity"
                                            value="{{ $cart->jumlah }}" type="number" disabled style="width: 50px">
                                        <button
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp() ,cartUpdate({{ $cart->id }})"
                                            class="plus text-white bg-success"
                                            style="border-top-right-radius: 50%; border-bottom-right-radius: 50%;"></button>
                                    </div>
                                </td>
                                <td id="subtotal{{ $cart->id }}" class="subtotal">{{ $cart->total }}</td>
                                <td class="text-center">
                                    <a class="mx-1" onclick="cartDelete({{ $cart->id }})" href="#"><i
                                            class="fa fa-times link-danger"></i></a>
                                </td>
                            </tr>
                        @endif

                    @endforeach
                    <tr class=" text-right">

                        <th scope="col"><img src="{{ asset('assets/avatar/' . $user->avatar) }}"
                                class="img-thumbnail float-left" width="40" alt=""><span
                                class="fw-bold float-left m-2 text-capitalize">{{ $user->name }}</span></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                        <th scope="col">
                            @auth
                                <span class="h5 fw-bold text-black-50">Total</span>

                                <span class="h5 ml-2 fw-bold text-success">Rp {{ $total }}</span>
                                <a href="https://wa.me/{{ $user->no_telp }}?text= *Checkout!*%0A Hallo kak saya {{ Auth::user()->name }}, %0A _Produk yg saya pesan_ %0A  %0A @foreach ($invoice as $buys) {{ $i++ }}. {{ $buys['title'] }}  %0A     jumlah x {{ $buys['jumlah'] }} = *Rp {{ $buys['subtotal'] }}* %0A @endforeach %0A *Total = Rp {{ $total }}*"
                                    target="_blank" class="btn btn-success rounded-6 text-capitalize ml-4">Checkout</a>
                            @endauth

                        </th>
                    </tr>

                </tbody>


                @foreach ($title as $prod)
                    @if ($prod['mitra_id'] == $user->id)
                        <?php $count = count($title); ?>
                        @php
                            $total = 0;
                        @endphp
                    @endif

                @endforeach


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
        </table>
    </div>


    {{-- mobile --}}

    <div class="card d-sm-block d-lg-none">
        <div class="card-header rounded-9 bg-primary">
            <h5 class="text-white text-center">Keranjang</h5>
        </div>
        @foreach ($users as $user)
            <?php $count = 0; ?>
            <div class="card-body" id="toko{{ $user->id }}">
                <img src="{{ asset('assets/avatar/' . $user->avatar) }}" class="img-thumbnail float-left" width="40"
                    alt=""><span class="fw-bold float-left m-2 text-capitalize">{{ $user->name }}</span>
            </div>
            <div class="card-body mt-n4" id="toko{{ $user->id }}">
                @php
                    $invoice = [];
                @endphp
                @foreach ($carts as $cart)
                    @if ($cart->product->user_id == $user->id)
                        @php
                            $total += $cart->total;
                            $buy = [
                                'mitra_id' => $cart->product->user_id,
                                'title' => $cart->product->title,
                                'jumlah' => $cart->jumlah,
                                'subtotal' => $cart->total,
                            ];
                            array_push($invoice, $buy);
                        @endphp
                        <!-- loop -->
                        <div class="row border-top py-4">
                            <?php
                            $decode = json_decode($cart->product->foto, true);
                            for ($i=0; $i < 1 ; $i++) { 
                            ?>
                            <div class="col-4">
                                <a href="#">
                                    <img src="{{ asset('product/' . $decode[0]) }}" class="img-fluid rounded" alt=""
                                        style="height: 60px;width:130px;object-position: center;overflow: hidden;object-fit: cover;">
                                </a>

                                <p class="text-success fw-bold mt-4 "><span>Rp {{ $cart->total }}</span></p>
                            </div>
                            <?php } ?>
                            <div class="col-8 align-self-center">
                                <div class="position-absolute" style="right: 0">
                                    <a class="mx-1" onclick="cartDelete({{ $cart->id }})" href="#"><i
                                            class="fa fa-trash link-danger"></i></a>
                                </div>


                                <p>{{ Str::limit($cart->product->title, 100) }}</p>
                                <p class="fw-bold">Rp <span
                                        id="harga{{ $cart->id }}">{{ $cart->product->harga }}</span></p>
                                <p id="subtotal{{ $cart->id }}" class="subtotal"></p>


                                <div class="number-input form-group border-0 float-right">
                                    <button
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown() ,cartUpdateM({{ $cart->id }})"
                                        class="minus text-white bg-success"
                                        style="border-top-left-radius: 50%;border-bottom-left-radius: 50%;"></button>
                                    <input id="jumlahM{{ $cart->id }}" class="border text-center" min="1"
                                        name="quantity" value="{{ $cart->jumlah }}" type="number"
                                        style="width: 50px;" disabled>
                                    <button
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp() ,cartUpdateM({{ $cart->id }})"
                                        class="plus text-white bg-success"
                                        style="border-top-right-radius: 50%; border-bottom-right-radius: 50%;"></button>
                                </div>
                            </div>
                        </div>
                        <!-- break -->
                    @endif

                @endforeach

                @auth
                    <div class="card-footer">
                        <div class="float-right">
                            <span class="text-black">Total : </span><span class="text-success fw-bold">Rp
                                {{ $total }}</span>
                        </div>
                    </div>
                    <a href="https://wa.me/{{ $user->no_telp }}?text= *Checkout!*%0A Hallo kak saya {{ Auth::user()->name }}, %0A _Produk yg saya pesan_ %0A  %0A @foreach ($invoice as $buys) {{ $i++ }}. {{ $buys['title'] }}  %0A     jumlah x {{ $buys['jumlah'] }} = *Rp {{ $buys['subtotal'] }}* %0A @endforeach %0A *Total = Rp {{ $total }}*"
                        target="_blank" class="btn btn-success rounded-6 text-capitalize">Checkout</a>
                @endauth
            </div>



            @foreach ($title as $prod)
                @if ($prod['mitra_id'] == $user->id)
                    <?php $count = count($title); ?>
                    @php
                        $total = 0;
                    @endphp
                @endif

            @endforeach
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
    </div>
