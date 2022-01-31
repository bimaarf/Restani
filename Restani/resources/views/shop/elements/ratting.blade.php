@if ($num > 0)
    Penilaian Produk : <br>
    @if ($mean / count($ratting) > 0 && $mean / count($ratting) < 2)
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
    @endif
    @if ($mean / count($ratting) >= 2 && $mean / count($ratting) < 3)
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
    @endif
    @if ($mean / count($ratting) >= 3 && $mean / count($ratting) < 4)
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
    @endif
    @if ($mean / count($ratting) >= 4 && $mean / count($ratting) < 5)
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star" style="font-size: 14px;"></span>
    @endif
    @if ($mean / count($ratting) == 5)
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
    @endif
    {{ $mean / count($ratting) }} <small>({{ count($ratting) }})</small>
    @foreach ($rat->where('user_id', Auth::user()->id) as $item)
        <div class="d-flex justify-content-center">
            <form class="rating display-1">
                <label>
                    <input type="radio" @if ($item->stars == 1) checked @endif name="stars" id="radio"
                        onclick="ratUpd({{ $product->id }})" class="stars" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" @if ($item->stars == 2) checked @endif name="stars" id="radio"
                        onclick="ratUpd({{ $product->id }})" class="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" @if ($item->stars == 3) checked @endif name="stars" id="radio"
                        onclick="ratUpd({{ $product->id }})" class="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" @if ($item->stars == 4) checked @endif name="stars" id="radio"
                        onclick="ratUpd({{ $product->id }})" class="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" @if ($item->stars == 5) checked @endif name="stars" id="radio"
                        onclick="ratUpd({{ $product->id }})" class="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </form>
        </div>
    @endforeach

@else
    @auth

        <div class="d-flex justify-content-center">
            <form class="rating display-1">
                <label>
                    <input type="radio" name="stars" id="radio" onclick="ratAdd({{ $product->id }})"
                        class="stars" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" id="radio" onclick="ratAdd({{ $product->id }})"
                        class="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" id="radio" onclick="ratAdd({{ $product->id }})"
                        class="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" id="radio" onclick="ratAdd({{ $product->id }})"
                        class="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" id="radio" onclick="ratAdd({{ $product->id }})"
                        class="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </form>
        </div>
    @endauth

@endif
<!-- foreach -->
@foreach ($ratting as $rats)

    <div class="d-flex flex-start my-4">
        <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('assets/avatar/' . $rats->user->avatar) }}"
            alt="avatar" width="40" height="40" />
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1 fw-bold text-capitalize">
                        {{ $rats->user->name }} <span class="small" style="font-size: 12px"> -
                            {{ $rats->created_at }}</span>
                    </p>
                </div>
                <p class="small mb-0">
                    @if ($rats->stars == 1)
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                    @endif
                    @if ($rats->stars == 2)
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                    @endif
                    @if ($rats->stars == 3)
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                    @endif
                    @if ($rats->stars == 4)
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star" style="font-size: 14px;"></span>
                    @endif
                    @if ($rats->stars == 5)
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                        <span class="fa fa-star text-warning" style="font-size: 14px;"></span>
                    @endif

                </p>
            </div>

        </div>
    </div>

@endforeach
