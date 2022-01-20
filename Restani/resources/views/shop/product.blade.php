@extends('layouts.pages.main')
@section('shop', 'active')
@section('content')
    <div class="container-lg mt-4">
        @include('shop.modal.modal_add_product')
        <div id="product">

        </div>
            
    </div>
    <script>
        window.onload = function() {
            shopElement();
        }
    </script>
@endsection
<script>

</script>
