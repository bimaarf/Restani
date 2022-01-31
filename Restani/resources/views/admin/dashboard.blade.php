@extends('layouts.pages.main')
@section('content')
    <main class="mt-4 d-lg-block container">
        <div class="row">
            <div class="col-lg-4">
                <nav class="d-lg-block collapse" style="z-index: 9; height: 700px">
                    <!-- Search form -->
                    <div class="card"
                        style="border-top-left-radius: 50px; border-bottom-left-radius: 50px; height:100%;">
                        <div class="position-sticky">
                            <div class="list-group list-group-flush pt-4 mx-4">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{ asset('assets/avatar/' . Auth::user()->avatar) }}"
                                            class="img-thumbnail rounded-circle" alt="">
                                    </div>
                                    <div class="col-9 align-self-center">
                                        <h4 class="text-capitalize text-black-100">{{ Auth::user()->name }}</h4>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="list-group-item list-group-item-action rounded-6 {{ Route::is('admin.dashboard') ? 'active' : '' }} mt-3">
                                    <div class="row">
                                        <div class="col-2 far fa-circle fs-1"></div>
                                        <div class="col-1"></div>
                                        <div class="col-8 align-self-center">
                                            <span class="fs-6 ">Dashboard</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('admin.product') }}"
                                    class="list-group-item list-group-item-action rounded-6 {{ Route::is('admin.product') ? 'active' : '' }} mt-3"
                                    style="margin-bottom: 40vh">
                                    <div class="row">
                                        <div class="col-2 far fa-circle fs-1"></div>
                                        <div class="col-1"></div>
                                        <div class="col-8 align-self-center">
                                            <span class="fs-6 ">Product</span>
                                        </div>
                                    </div>
                                </a>



                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-8 badan">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.dashboard') }}">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" name="name" placeholder="Cari username"
                                    aria-label="Search" value="{{ request('name') }}" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">xyz</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)

                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-capitalize">{{ $user->name }}</td>
                                    <td>
                                        @if ($user->hasRole('user'))
                                            User
                                        @endif
                                        @if ($user->hasRole('mitra'))
                                            Mitra
                                        @endif
                                    </td>
                                    <td><button type="button" class="btn btn-sm btn-primary" data-mdb-toggle="modal"
                                            data-mdb-target="#user{{ $user->id }}">
                                            Lihat
                                        </button></td>
                                </tr>
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal top fade" id="user{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="true"
                                    data-mdb-keyboard="true">
                                    <div class="modal-dialog   modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="p-4" style="background-color: #f8f9fa;">
                                                    <div class="input-group form-group">
                                                        <label class="pr-4">Username</label>
                                                        <input class="form-control mx-3 bg-transparent border-0" type="text"
                                                            value="{{ $user->name }}" disabled>
                                                    </div>
                                                    <div class="input-group form-group">
                                                        <label class="pr-4"
                                                            style="margin-right: 25px">Email</label>
                                                        <input class="form-control mx-4 bg-transparent border-0" type="text"
                                                            value="{{ $user->email }}" disabled>
                                                    </div>
                                                    <div class="input-group form-group">
                                                        <label class="pr-4" style="margin-right: 12px">No.
                                                            Telp</label>
                                                        <input name="no_telp" id="no_telp"
                                                            class="form-control mx-4 bg-transparent border-0" type="number"
                                                            value="{{ $user->no_telp }}" required placeholder="628XXX"
                                                            disabled>
                                                        <a href="https://wa.me/{{ $user->no_telp }}"
                                                            class="link-success" target="__blank"><i
                                                                class="fab fa-whatsapp"></i></a>
                                                    </div>

                                                    <div class="input-group form-group">
                                                        <label style="margin-right: 25px">Jenis Akun</label>
                                                        @if ($user->hasRole('user'))
                                                            <p class="ml-4 text-info">User</p>
                                                        @endif
                                                        @if ($user->hasRole('admin'))
                                                            <p class="ml-4">Admin</p>
                                                        @endif
                                                        @if ($user->hasRole('mitra'))
                                                            <p class="ml-4">Mitra</p>
                                                        @endif
                                                    </div>
                                                    <div class="input-group form-group">
                                                        <label style="margin-right: 25px">Jenis Kelamin</label>
                                                        <p class="ml-1">{{ $user->jenis_kelamin }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                        <caption>
                            Daftar pengguna
                        </caption>

                    </table>
                </div>
                {{ $users->links() }}

            </div>
        </div>
    </main>

@endsection
