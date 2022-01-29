@foreach ($chats as $chat)

    @if ($chat->user_id != Auth::id())
        <div class="d-flex flex-row justify-content-start">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1"
                style="width: 45px; height: 100%;">
            <div>
                <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                    {{ $chat->chat }}
                </p>
                <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ $chat->created_at }}</p>
            </div>
        </div>
    @endif
    @if ($chat->user_id == Auth::id())

        <div class="d-flex flex-row justify-content-end">
            <div>
                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                    {{ $chat->chat }}
                </p>
                <p class="small me-3 mb-3 rounded-3 text-muted">{{ $chat->created_at }}</p>
            </div>
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1"
                style="width: 45px; height: 100%;">
        </div>
    @endif
@endforeach
