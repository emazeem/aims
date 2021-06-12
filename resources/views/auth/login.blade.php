@extends('layouts.master')
@section('content')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <img src="img/rubic-white-bg.png" alt="" class="img-fluid mb-4">
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

