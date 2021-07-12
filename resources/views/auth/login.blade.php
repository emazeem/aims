@extends('layouts.master')
@section('content')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="col-12">
                                <img src="img/AIMS.png" width="90" alt="" class="img-fluid mb-4">
                            </div>
                            <div class="input-group px-0">
                                <h5 class="float-left font-weight-light">Login</h5>
                            </div>
                            <div class="input-group px-0">
                                <div class="text-success float-left success-alert font-weight-bold" role="alert"></div>
                            </div>
                            <form method="POST" id="login-form">
                                @csrf

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email address" name="email" id="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control " placeholder="Password" value="{{ old('password') }}" autocomplete="password">
                                </div>
                                <div class="form-group text-left p-0 m-0">
                                    <div class="text-danger message-alert font-weight-bold" role="alert"></div>
                                </div>
                                <div class="form-group text-left mt-2">
                                    <div class="checkbox checkbox-primary d-inline">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="cr"> {{ __('Remember Me') }}</label>
                                    </div>
                                </div>

                                <button class="btn btn-block login-btn btn-primary mb-4" type="submit">LOGIN</button>
                            </form>
                            <p class="mb-2 text-muted">Forgot password? <a class="f-w-400">Reset</a></p>
                            <p class="mb-2 text-muted">Product By <a class="f-w-400" href="http://rubicsol.com">Rubic Sol</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#login-form").on('submit', (function (e) {
                e.preventDefault();
                var button = $('.login-btn');
                var previous = $(button).html();
                button.attr('disabled', 'disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('login')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function () {
                        button.attr('disabled',null).html(previous);
                        $('.success-alert').html('You are logged in successfully!');
                        setTimeout(function() {
                            window.location.href='{{url('/')}}';
                        },1000);
                    },
                    error: function (xhr) {
                        button.attr('disabled',null).html(previous);
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            if (item){
                                error+=item+' ';
                            }
                        });
                        $('.message-alert').html(error);
                    }
                });
            }));
        });
    </script>
@endsection

