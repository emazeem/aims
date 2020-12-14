@extends('layouts.app')
@section('content')
    <div class="row justify-content-center pt-md-5">
        <div class="col-md-4 col-12 mb-5 mt-4">
            <div class="card bg-transparent mt-md-5 mt-4" style="border-radius: 0">
                {{--<div class="card-header py-md-3 text-center" style="background-color: rgba(255,255,255,0.3)">
                </div>--}}
                <div class="card-body pt-4" style="background-color: rgba(255,255,255,0.05)">
                    <h2 class="text-light text-center bg-gradient-secondary p-4">
                        <img src="{{asset('img/AIMS.png')}}" class="img-fluid" width="100">
                        <br>
                    </h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-3 text-light col-form-label">{{ __('Email') }}</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                @error('email')
                                    <span class="text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 text-light col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3 ">
                                <div class="row">
                                    <div class="form-check col-9 text-center">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-light" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn float-right btn-outline-light">
                                            {{ __('Login') }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection