<!-- foreach -->
@foreach ($comments as $comment)

    <div class="d-flex flex-start my-4">
        <img class="rounded-circle shadow-1-strong me-3"
            src="{{ asset('assets/avatar/' . $comment->user->avatar) }}" alt="avatar" width="40" height="40" />
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1 fw-bold text-capitalize">
                        {{ $comment->user->name }} <span class="small"
                            style="font-size: 12px"> - {{ $comment->created_at }}</span>
                    </p>
                    <a href="#!" onclick="subComment({{ $comment->id }})"><i class="fas fa-reply fa-xs"></i><span
                            class="small">
                            reply</span></a>
                </div>
                <p class="small mb-0">
                    {{ $comment->message }}
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12 input-group d-none" id="form-sub{{ $comment->id }}">
                    <input id="sub-message{{ $comment->id }}" type="text" value=""
                        class="form-control border-0 border-bottom" maxlength="250" name="message" placeholder='Ketikkan komentar..'
                        style="border-color: inherit;
                                        -webkit-box-shadow: none;
                                        box-shadow: none;">

                    <button onclick="addSub({{ $comment->id }})" type="submit"
                        class="btn btn-outline-success fas fa-paper-plane"></button>
                </div>
            </div>

            @foreach ($subs->where('comment_id', $comment->id) as $sub)
                <div class="d-flex flex-start mt-4">
                        <img class="rounded-circle shadow-1-strong me-3"
                            src="{{ asset('assets/avatar/' . $sub->user->avatar) }}" alt="avatar" width="30"
                            height="30" />
                    <div class="flex-grow-1 flex-shrink-1">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1 fw-bold text-capitalize">
                                    {{ $sub->user->name }} <span class="small" style="font-size: 12px">- {{ $sub->created_at }}</span>
                                </p>
                            </div>
                            <p class="small mb-0">
                                {{ $sub->message }}
                            </p>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>

@endforeach
