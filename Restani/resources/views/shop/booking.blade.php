@extends('layouts.pages.main')
@section('booking', 'active')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="car-header">
                <div class="card-header bg-primary" style="border-top-left-radius: 30px; border-top-right-radius: 30px;">
                    <h5 class="text-white text-center">Re-Booking</h5>
                </div>
                <div class="card-body" id="booking">

                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            tableBook();
        }
    </script>
@endsection
