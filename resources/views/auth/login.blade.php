@extends('layouts.app')
@section('content')
    <div class="row justify-content-center pt-md-5">
        <div class="col-md-5 col-12 mb-5 mt-4">
            <div class="card bg-transparent mt-md-5 mt-4" style="border-radius: 0">
                <div class="card-header py-md-3 text-center" style="background-color: rgba(255,255,255,0.5)">
                    <img src="{{asset('img/AIMS.png')}}" class="img-fluid" width="100">
                </div>
                <div class="card-body" style="background-color: rgba(255,255,255,0.2)">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-3 text-light col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                                @error('email')
                                    <span class="text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 text-light col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-light" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn float-right btn-outline-light">
                                    {{ __('Login') }}
                                </button>
                            </div></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection