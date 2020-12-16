@extends('layouts.app')
@section('content')

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content pt-5 pb-3 px-4" style="background-color: #f4f4f4">
                    <div class="col-12">
                        <h4 class="text-dark text-center" >
                            <img src="{{asset('img/AIMS.png')}}" class="img-fluid" width="100">
                            <br>

                        </h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row p-0 m-0">
                            <label for="email" class="col-md-3 text-dark col-form-label">{{ __('Email') }}</label>
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
                            <label for="password" class="col-md-3 text-dark col-form-label">{{ __('Password') }}</label>

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
                                    <div class="form-check col-9 text-center">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn float-right btn-primary btn-sm mt-2">
                                {{ __('Login') }}
                            </button>
                        </div>

                    </form>
                </section>
                <p class="text-center mt-3">AIMS- Al Meezan Meterology Services ERP@2020</p>
            </div>

        </div>
@endsection

