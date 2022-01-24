@if ($num > 0)

<button onclick="favDel({{ $product->id }})" type="submit"
    class="far fa-heart bg-danger rounded-circle p-3 text-white float-right mt-n2 btn btn-lg"></button>
@else

<button onclick="favAdd({{ $product->id }})" type="submit"
    class="far fa-heart bg-primary rounded-circle p-3 text-white float-right mt-n2 btn btn-lg"></button>
@endif
