@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="user-profile user-card mb-4">
        <div class="card-header border-0 p-0 pb-0">
            <div class="cover-img-block">
                <img src="assets/images/profile/cover.jpg" width="1500" alt="" class="img-fluid">
                <div class="overlay"></div>
            </div>
        </div>
        <div class="card-body py-0">
            <div class="user-about-block m-0">
                <div class="row">
                    <div class="col-md-4 text-center mt-n5">
                        <div class="change-profile text-center">
                            <div class="dropdown w-auto d-inline-block">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="profile-dp">
                                        <div class="position-relative d-inline-block">
                                            @if(auth()->user()->profile)
                                                <img class="img-radius img-fluid wid-100 hei-100" style="object-fit: cover" src="{{Storage::disk('local')->url('/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}">
                                            @else
                                                <img class="img-radius img-fluid wid-100 hei-100" style="object-fit: cover" src="{{url('img/profile.png')}}">
                                            @endif
                                        </div>
                                        <div class="overlay">
                                            <span>change</span>
                                        </div>
                                    </div>
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeprofile"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>

                                </div>
                            </div>
                        </div>

                        <h5 class="mb-1">{{auth()->user()->fname}} {{auth()->user()->lname}}</h5>
                        <p class="mb-2 text-muted">{{auth()->user()->roles->name}}</p>
                    </div>
                    <div class="col-md-8 mt-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="www.aimscal.com" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-globe mr-2 f-18"></i>www.aimscal.com</a>
                                <div class="clearfix"></div>
                                <a href class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>{{auth()->user()->email}}</a>
                                <div class="clearfix"></div>
                                <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone mr-2 f-18"></i>{{auth()->user()->phone}}</a>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <i class="feather icon-briefcase mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->departments->name}}
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="feather icon-more-horizontal mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->designations->name}}
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->address}}
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="feather icon-clock mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            Member since {{date('Y',strtotime(auth()->user()->created_at))}}
                                        </p>
                                    </div>
                                </div>
                                @if(auth()->user()->cv)
                                <div class="media">
                                    <i class="feather icon-clock mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            <a href="{{Storage::disk('local')->url('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)}}" target="_blank" class="btn btn-app btn-lg pull-right">
                                                <i class="fa fa-cloud-download"></i>
                                                Curriculum Vitae ( {{number_format((Storage::disk('local')->size('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)/1024),2)}} KBs )
                                            </a>
                                          </p>
                                    </div>
                                </div>
                                @endif
                                @if(auth()->user()->signature)
                                <div class="media">
                                    <i class="feather icon-clock mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="200" class="img-fluid">
                                          </p>
                                    </div>
                                </div>
                                @endif




                            </div>
                        </div>
                        <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-reset active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-user mr-2"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-reset" id="attendance-tab" data-toggle="tab" href="#attendance" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-clock mr-2"></i> Attendance</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- profile header end -->

    <!-- profile body start -->
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Personal details</h5>
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->fname}}
                                    {{auth()->user()->lname}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->dob->format('d M Y')}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->email}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Joining Date</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->joining->format('d M Y')}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Address</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->address}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Phone</label>
                                <div class="col-sm-9">
                                    {{auth()->user()->phone}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Attendance</h5>
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                            <table class="table table-hover table-sm bg-white">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendence)
                                    <tr>
                                        <td>{{$attendence->check_in_date}}</td>
                                        <td>{{$attendence->day}}</td>
                                        <td>{{$attendence->check_in_date}} {{date('h:i A',strtotime($attendence->check_in))}}</td>
                                        <td>{{$attendence->check_out_date}} {{date('h:i A',strtotime($attendence->check_out))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Friends</h5>
                    <span class="badge badge-light-primary float-right">{{count(\App\Models\User::all())}}</span>
                </div>
                <div class="card-body">
                    <ul class="list-inline">
                        @foreach(\App\Models\User::all() as $user)
                            <li class="list-inline-item">
                                <a href="#">
                                    @if($user->profile)
                                        <img src="{{Storage::disk('local')->url('/profile/'.$user->id.'/'.$user->profile)}}" alt="user image" class="img-radius mb-2 wid-50 hei-50" style="object-fit: cover" data-toggle="tooltip" title="{{$user->fname.' '.$user->lname}}">
                                    @else
                                        <img src="{{url('img/profile.png')}}" alt="user image" class="img-radius mb-2 wid-50 hei-50" style="object-fit: cover" data-toggle="tooltip" title="{{$user->fname.' '.$user->lname}}">
                                    @endif

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- profile body end -->
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

                        <form method="post" class="dropzone" action="{{url('/set_profile')}}" enctype="multipart/form-data">
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