@extends('layouts.pages.main')
@section('content')
    <div class="container mt-4">
        <div id="table"></div>
    </div>
    <script>
        window.onload = function() {
            table();
        }
    </script>

@endsection
