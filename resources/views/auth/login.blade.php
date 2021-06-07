@extends('layouts.master')
@section('content')
    {{--<style>
        .form-control{

        }
    </style>
    <div class="align-items-center justify-content-between mt-md-5 pt-5">
    <section class="col-4 login_content pt-5 pb-3 px-md-4 px-0 bg-white" >
        <div class="col-12">
            <h4 class="text-dark text-center pb-4" >
                <img src="{{asset('img/AIMS.png')}}" class="img-fluid" width="100">
            </h4>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row p-0 m-0">
                <label for="email" class="col-md-3 text-dark text-left mt-2">{{ __('Email') }}</label>
                <div class="col-md-9">
                    <input id="email" type="email" class="form-control text-xs @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                    @error('email')
                    <span class="text-white" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row p-0 m-0">
                <label for="password" class="col-md-3 text-dark text-left mt-2">{{ __('Password') }}</label>

                <div class="col-md-9">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                    @error('password')
                    <span class="text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row p-0">
                <div class="col-md-9 offset-md-3 ">
                    <div class="row">
                        <div class="form-check col-9 text-center my-auto">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn float-right btn-info btn-sm mt-2">
                                {{ __('Login') }}
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </section>
    <p class="text-center mt-3">AIMS- Al Meezan Meterology Services ERP@2020</p>
    </div>--}}

    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Login</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                    </div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" id="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="text-danger col-12" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" autocomplete="password">

                                    @error('password')
                                    <span class="text-danger col-12" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror



                                </div>
                                <div class="form-group text-left mt-2">
                                    <div class="checkbox checkbox-primary d-inline">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="cr"> {{ __('Remember Me') }}</label>
                                    </div>
                                </div>

                                <button class="btn btn-block btn-primary mb-4" type="submit">LOGIN</button>
                            </form>
                            <p class="mb-2 text-muted">Forgot password? <a class="f-w-400">Reset</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

