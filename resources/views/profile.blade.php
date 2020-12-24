@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="text-right col-12 my-2">
            <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#changeprofile"><i class="fa fa-upload"></i> Upload Profile</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="border-left-primary shadow h-100 p-3 ">
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid">
                @else
                    <img src="{{url('img/profile.png')}}" class="img-fluid">
                @endif
                <h4 class="mt-4 text-success text-center border-bottom border-success">{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
                    <p><i class="fa fa-map-marker user-profile-icon"></i>  {{auth()->user()->address}}</p>
                    <p><i class="fa fa-phone"></i> {{auth()->user()->phone}}</p>
                    <p>
                        <i class="fa fa-envelope"></i> {{auth()->user()->email}}
                    </p>
                    <p><i class="fa fa-briefcase user-profile-icon"></i> {{auth()->user()->designations->name}} - {{auth()->user()->departments->name}}</p>
                    <p class="text-center"><small class="text-center"> Member since {{date('Y',strtotime(auth()->user()->created_at))}} <i class="fa fa-clock-o"></i></small></p>

            </div>
        </div>
        <div class="col-12 col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3 class="pull-left"><i class="fa fa-sort"></i> My Profile </h3>
                            @if(auth()->user()->cv)
                                <a href="{{Storage::disk('local')->url('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)}}" target="_blank" class="btn btn-app btn-lg pull-right">
                                    <i class="fa fa-cloud-download"></i>
                                    Curriculum Vitae ( {{number_format((Storage::disk('local')->size('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)/1024),2)}} KBs )

                                </a>
                            @endif
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <h3 class="text-danger bg-light p-2"><i class="fa fa-caret-right"></i> {{auth()->user()->roles->name}}</h3>
                            <h6><i class="fa fa-toggle-right text-danger"></i> Father Name <i class="fa fa-caret-right ml-2"></i>  {{auth()->user()->father_name}}</h6>
                            <h6><i class="fa fa-info text-danger"></i> CNIC <i class="fa fa-caret-right ml-2"></i>  {{auth()->user()->cnic}}</h6>
                            <h6><i class="fa fa-calendar text-danger"></i> Date of Birth <i class="fa fa-caret-right ml-2"></i>  {{date('d M Y',strtotime(auth()->user()->dob))}}</h6>
                            <h6><i class="fa fa-calendar text-danger"></i> Date of Joining <i class="fa fa-caret-right ml-2"></i>  {{date('d M Y',strtotime(auth()->user()->joining))}}</h6>

                            @if(auth()->user()->signature)
                                <div class="text-right">
                                    <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="200" class="img-fluid">
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="modal fade" id="changeprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/set_profile')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection