@extends('layouts.pages.main')
@section('content')
    <div class="pattern section-wave">
        <div class="geeks">
            <section class="vh-100">
                <div class="container h-100">
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('assets/icon/Driver.svg') }}" class="img-fluid rounded mt-4" width="200vh"
                            alt="">
                        <div class="form-group mt-2">
                            <label for="role"></label>

                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-12 col-xl-11">
                            <div class="card text-black" style="border-radius: 25px;">
                                <div class="card-body p-md-5">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="fw-bold">Login</h5>
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6 form-group">
                                                        <label class="d-flex text-start fw-bold" :value="__('Name')"
                                                            for="name">Nama</label>
                                                        <input class="form-control-lg form-control" type="text" id="name"
                                                            name="name" :value="old('name')" required autofocus>
                                                    </div>
                                                    <div class="col-lg-6 form-group">
                                                        <label class="d-flex text-start fw-bold" :value="__('Name')"
                                                            for="name">Jenis Akun</label>
                                                        <select id="role" name="role" class="form-select">
                                                            @foreach ($roles as $rol)
                                                                @if ($rol->id != 1)

                                                                    <option value="{{ $rol->name }}">{{ $rol->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="d-flex text-start fw-bold" :value="__('Email')"
                                                        for="email">Email</label>
                                                    <input class="form-control-lg form-control" type="email" id="email"
                                                        name="email" :value="old('email')" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="jenis_kelamin"
                                                                class="d-flex text-start fw-bold">Jenis Kelamin</label>
                                                            <select class="form-select form-select-lg" name="jenis_kelamin"
                                                                id="jenis_kelamin">
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="no_telp" class="d-flex text-start fw-bold">No.
                                                                Telepon</label>
                                                            <input class="form-control form-control-lg" name="no_telp"
                                                                id="no_telp" type="number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="d-flex text-start fw-bold">Password</label>
                                                    <input class="form-control form-control-lg" type="password"
                                                        name="password" id="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation"
                                                        class="d-flex text-start fw-bold">Konfirmasi Password</label>
                                                    <input class="form-control form-control-lg" type="password"
                                                        name="password_confirmation" id="password_confirmation">
                                                </div>
                                                <div class="form-check form-check text-start">
                                                    <input type="checkbox" required><small>&nbsp;Saya setuju dengan
                                                        <span class="text-success">Ketentuan, kebijakan privasi</span>
                                                        dan <span class="text-success">biaya.</span></small>

                                                </div>
                                                <input type="submit" class="my-2 btn btn-success btn-lg" value="Register"
                                                    style="width: 100%;">
                                                <span class="text-black-50">Sudah punya akun ?</span><a
                                                    href="{{ route('login') }}" class="text-success">Login</a>
                                            </form>
                                        </div>
                                        <div class="col-lg-6 d-lg-block collapse">
                                            <div class=""
                                                style="background-image: url('https://ecs7.tokopedia.net/blog-tokopedia-com/uploads/2020/07/Featured_Manfaat-Tomat-Buah-Setia-dengan-Khasiat-Tak-Terkira.jpg'); height: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
