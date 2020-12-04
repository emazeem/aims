@extends('layouts.master')
@section('content')
    @php
        $user=auth()->user();
    @endphp
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            $( document ).ready(function() {
                swal("Failed", "{{session('error')}}", "error");
            });

        </script>
    @endif

    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="border-bottom text-dark pb-2">Change Password</h2>
        </div>
        <div class="col-md-4 col-12"></div>
        <div class="col-md-4 mt-4 col-12">
            <div class="text-center">
            </div>
            <form class="form-horizontal" action="{{route('change-password')}}" method="post" autocomplete="off">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="oldpassword" class="text-xs control-label">Old Password</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                               placeholder="Old Password">
                        @if ($errors->has('oldpassword'))
                            <span class="text-danger text-xs">
                              <strong>{{ $errors->first('oldpassword') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="newpassword" class="text-xs control-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="New Password">
                        @if ($errors->has('password'))
                            <span class="text-danger text-xs">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="text-xs control-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-xs">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                    @endif
                </div>
                <input type="submit" class="btn btn-warning btn-block">
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection