@extends('layouts.pages.main')
@section('subscribe', 'active')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="car-header">
                <div class="card-header bg-primary" style="border-top-left-radius: 30px; border-top-right-radius: 30px;">
                    <h5 class="text-white text-center">Langganan</h5>
                </div>
                <div class="card-body" id="subscribe">

                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            tableSub();
        }
    </script>

@endsection
