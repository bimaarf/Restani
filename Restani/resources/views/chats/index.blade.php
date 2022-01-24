@extends('layouts.pages.main')
@section('content')
    <div class="container mt-4">
        <div class="card" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
            <div class="row">
                <div class="col-lg-3 bg-success" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
                    <ul class="list-unstyled overflow-y-scroll" style="position: relative; height: 600px;">
                        @foreach ($rooms as $room)

                            <li id="select{{ $room->id }}" onclick="target({{ $room->id }})" class="p-2 ml-4 my-4 border"
                                style="border-top-left-radius: 50px;border-bottom-left-radius: 50px; ">
                                @if (Auth::user()->hasRole('user'))

                                    @foreach ($users->where('id', $room->mitra_id) as $user)
                                        <a href="#"><img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" class=" rounded-circle img-thumbnail"
                                                width="50" alt="avatar">
                                            <input class="text-capitalize" type="hidden" id="reqTit{{ $room->id }}" value="{{ $user->name }}">
                                            <span class="h6 ml-4 text-white text-capitalize">{{ $user->name }}</span>
                                        </a>
                                    @endforeach
                                @endif
                                @if (Auth::user()->hasRole('mitra'))

                                    @foreach ($users->where('id', $room->user_id) as $user)
                                        <a href="#"><img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" class=" rounded-circle img-thumbnail"
                                                width="50" alt="avatar">
                                                <input class="text-capitalize" type="hidden" id="reqTit{{ $room->id }}" value="{{ $user->name }}">
                                            <span class="h6 ml-4 text-white text-capitalize">{{ $user->name }}</span>
                                        </a>
                                    @endforeach
                                @endif

                            </li>

                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="card-header">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" class=" rounded-circle img-thumbnail" width="50" alt="avatar">
                        <span class="h6 ml-4" id="title"></span>
                    </div>
                    <div class="card-body">
                        <div class="pt-3 pe-3 overflow-scroll" id="box" data-mdb-perfect-scrollbar="true"
                            style="position: relative; height: 400px;">

                        </div>
                        <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                alt="avatar 3" style="width: 40px; height: 100%;">
                            <input name="chat" type="text" class="form-control form-control-lg" id="chatq"
                                placeholder="Type message">
                            <a class="ms-1 text-muted" href="#!"><i class="fas fa-paperclip"></i></a>
                            <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a>
                            <a onclick="store()" class="ms-3" href="#!"><i class="fas fa-paper-plane"></i></a>

                        </div>
                        <input type="text" id="target-user" name="room_id" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function box(id) {

        const url = "/chatting/box/" + id
        $.get(url, {}, function(chattings, status) {
            const query = "#box"
            // console.log(query);
            $(query).html(chattings);

            // scroll down
            $(query).stop().animate({
                scrollTop: 10000
            }, 1000);
            $(query).attr({
                scrollTop: 10000
            });
            // end scroll

        });
    }


    function target(id) {

        const target = $("#target-user").val(id);
        const title = $("#reqTit"+id).val();

        document.getElementById('title').innerHTML = title;
        document.getElementById('title').style.textTransform = "capitalize";
        $("#target-user").val(id);

        box(id)
        // document.getElementById("select" + id).style.background = 'rgb(3, 94, 56)';
    }

    function store() {
        const url = "/chatting/store";
        const chat = $("#chatq").val();
        const target = $("#target-user").val();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                chat: chat,
                room_id: target
            },
            success: function(response) {
                $("#chatq").val('');
                box(target);

            }, error: function(response) {
                alert('Pesan tidak boleh kosong!');
            }
        })
    }
</script>
