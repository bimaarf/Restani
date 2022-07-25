@extends('layouts.pages.main')
@section('content')
    <div class="container mt-4">
        <div class="card" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
            <div class="row">
                <div class="col-lg-3 d-lg-block bg-success" id="user-list"
                    style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
                    <ul class="list-unstyled overflow-y-scroll" style="position: relative; height: 600px;">
                        @foreach ($rooms as $room)
                            <li id="select{{ $room->id }}" onclick="target({{ $room->id }})"
                                class="p-2 ml-4 my-4 border"
                                style="border-top-left-radius: 50px;border-bottom-left-radius: 50px; ">
                                @if (Auth::user()->hasRole('user'))
                                    @foreach ($users->where('id', $room->mitra_id) as $user)
                                        <a href="#"><img
                                                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                class=" rounded-circle img-thumbnail" width="50" alt="avatar">
                                            <input class="text-capitalize" type="hidden" id="reqTit{{ $room->id }}"
                                                value="{{ $user->name }}">
                                            <span class="h6 ml-4 text-white text-capitalize">{{ $user->name }}</span>
                                        </a>
                                    @endforeach
                                @endif
                                @if (Auth::user()->hasRole('mitra|admin'))
                                    @foreach ($users->where('id', $room->user_id) as $user)
                                        <a href="#"><img
                                                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                class=" rounded-circle img-thumbnail" width="50" alt="avatar">
                                            <input class="text-capitalize" type="hidden" id="reqTit{{ $room->id }}"
                                                value="{{ $user->name }}">
                                            <span class="h6 ml-4 text-white text-capitalize">{{ $user->name }}</span>
                                        </a>
                                    @endforeach
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-9 d-sm-block collapse d-lg-block" id="chat-list">
                    <div class="card-header">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            class=" rounded-circle img-thumbnail" width="50" alt="avatar">
                        @if (session()->has('rooma'))
                            <span class="h6 ml-4 text-capitalize" id="title">
                                @foreach ($users->where('id', $rooma['mitra_id']) as $usr)
                                    {{ $usr->name }}
                                @endforeach
                            </span>
                        @else
                            <span class="h6 ml-4" id="title"></span>
                        @endif
                        <span class="fa fa-bars d-sm-block d-lg-none fa-pull-right d-flex align-middle mt-3"
                            onclick="sunting()"></span>
                    </div>
                    <div class="card-body">
                        <div class="pt-3 pe-3 overflow-scroll " id="box" data-mdb-perfect-scrollbar="true"
                            style="position: relative; height: 400px;">
                            <div class="d-flex justify-content-center">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfnNXBGB8Kmgi6GLJPu8MhONGhZXVxyX9e9NCFjv2SULnLHWoiF0JBbsBgkFcPRels1NE&usqp=CAU"
                                    alt="">

                            </div>
                        </div>

                        <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                alt="avatar 3" style="width: 40px; height: 100%;">
                            <input name="chat" type="text" class="form-control form-control-lg" id="chatq"
                                placeholder="Type message" required>
                            <a  onclick="store()" class="ms-3" href="#!"><i class="fas fa-paper-plane"></i></a>

                        </div>
                        @if (session()->has('rooma'))
                            <input type="hidden" id="target-user" name="room_id" required
                                value="@foreach ($rooms->where('mitra_id', $rooma['mitra_id']) as $room){{ $room->id }} @endforeach">

                            @foreach ($rooms->where('mitra_id', $rooma['mitra_id']) as $room)
                                <script>
                                    target({{ $room->id }})
                                </script>
                            @endforeach
                        @else
                            <input type="hidden" id="target-user" name="room_id" value="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var condition = true;

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
        const title = $("#reqTit" + id).val();
        document.getElementById('title').innerHTML = title;
        document.getElementById('title').style.textTransform = "capitalize";
        $("#target-user").val(id);
        sunting()
        box(id);

    }

    function store() {
        if ($('#chatq').val() === '') return alert('Pesan tidak boleh kosong')
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
                $("#chatq").val('')
                box(target);

            },
            error: function(response) {
                alert('Pesan tidak boleh kosong!');
            }
        })
    }

    function sunting() {
        if (condition == true) {
            $('#user-list').addClass('d-sm-none collapse')
            $('#chat-list').removeClass('d-sm-block collapse')
            condition = false;

        } else if (condition == false) {
            $('#user-list').removeClass('d-sm-block collapse')
            $('#chat-list').addClass('d-sm-none collapse')
            condition = true;
        }
        console.log(condition);

    }
</script>
