@extends('layouts.pages.main')
@section('content')
    <div class="pattern section-wave -mt-1">
        <div class="geeks">
            <section class="vh-100">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-lg-12 col-xl-11">
                            <div class="card text-black" style="border-radius: 25px;">
                                <div class="card-body p-md-5">
                                    <div class="row">
                                        <div class="col-lg-6 d-lg-block collapse">
                                            <div
                                                style="background-image: url('https://ecs7.tokopedia.net/blog-tokopedia-com/uploads/2020/07/Featured_Manfaat-Tomat-Buah-Setia-dengan-Khasiat-Tak-Terkira.jpg'); height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ asset('assets/icon/restani.png') }}" alt="">
                                            <h5 class="fw-bold">Login</h5>
                                            <div class="row" style="font-size: 10px">
                                                <div class="text-left small border col-4 p-2">
                                                    <p>Email : admin@gmail.com</p>
                                                    <p>Pass : admin</p>
                                                </div>
                                                <div class="text-left small border col-4 p-2">
                                                    <p>Email : mitra@gmail.com</p>
                                                    <p>Pass : admin</p>
                                                </div>
                                                <div class="text-left small border col-4 p-2">
                                                    <p>Email : user@gmail.com</p>
                                                    <p>Pass : admin</p>
                                                </div>
                                            </div>
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="d-flex text-start fw-bold" for="email"
                                                        :value="__('Email')">Email</label>
                                                    <input class="form-control-lg form-control" type="email"
                                                        id="email" name="email" :value="old('email')" required
                                                        autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="d-flex text-start fw-bold"
                                                        :value="__('Password')">Password</label>
                                                    <input class="form-control form-control-lg" type="password"
                                                        name="password" id="password" required
                                                        autocomplete="current-password">
                                                </div>
                                                <div class="form-check form-check text-start">
                                                    <input type="checkbox" name="remember"><span
                                                        class="text-black-50">&nbsp;Buat saya tetap masuk</span>
                                                </div>
                                                <input type="submit" class="btn btn-success btn-lg my-2" value="Login"
                                                    style="width: 100%;">
                                                <span class="text-black-50">Tidak punya akun ?</span><a
                                                    href="{{ route('register') }}" class="text-success"> Register</a><br>
                                                <a href="#" class="text-success">Lupa Password ?</a>
                                            </form>
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
