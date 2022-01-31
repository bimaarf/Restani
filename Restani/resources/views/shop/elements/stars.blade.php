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
        {{ $mean / count($ratting) }} <small class="text-black-50">({{ count($ratting) }} Ulasan)</small>
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
