@extends('layouts.auth-layout')

@section('content')
    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Sign In</h2>
                                        <p>Enter your email and password to login</p>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                name="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" name="remember"
                                                    id="form-check-remember">
                                                <label class="form-check-label" for="form-check-remember">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100">SIGN IN</button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div class="">
                                            <div class="seperator">
                                                <hr>
                                                <div class="seperator-text"> <span>Or continue with</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-12">
                                        <div class="mb-4">
                                            <button class="btn  btn-social-login w-100 ">
                                                <img src="{{ asset('admin/assets/img/google-gmail.svg') }}" alt=""
                                                    class="img-fluid">
                                                <span class="btn-text-inner">Google</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-12">
                                        <div class="mb-4">
                                            <button class="btn  btn-social-login w-100">
                                                <img src="{{ asset('admin/assets/img/github-icon.svg') }}" alt=""
                                                    class="img-fluid">
                                                <span class="btn-text-inner">Github</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-12">
                                        <div class="mb-4">
                                            <button class="btn  btn-social-login w-100">
                                                <img src="{{ asset('admin/assets/img/twitter.svg') }}" alt=""
                                                    class="img-fluid">
                                                <span class="btn-text-inner">Twitter</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-center">
                                            <p class="mb-0">Dont't have an account ? <a href="{{ route('register') }}"
                                                    class="text-warning">Sign Up</a></p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
