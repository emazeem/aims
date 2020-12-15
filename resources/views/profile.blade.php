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
            <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#changeprofile"><i
                        class="fa fa-upload"></i> Upload Profile
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="border-left-primary shadow h-100 py-2 p-5 text-center">
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}"
                         class="img-fluid">
                @else
                    <img src="{{url('img/profile.png')}}" class="img-fluid">
                @endif
                <p class="text-center mt-4">{{auth()->user()->fname}} {{auth()->user()->lname}}
                    <br>
                    <small>Member since {{date('Y',strtotime(auth()->user()->created_at))}}</small>

                </p>
            </div>
        </div>
        <div class="col-12 col-md-6">

            <div class="border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="col-auto ">
                                <h3 class="text-primary "><i class="fas fa-user"></i> Personal Details</h3>

                            </div>
                            <table class="table table-striped table-sm border mt-5 bg-white ">
                                <tr>
                                    <th class="text-primary">Name :</th>
                                    <td>{{auth()->user()->fname}} {{auth()->user()->lname}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Father Name :</th>
                                    <td>{{auth()->user()->father_name}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Phone :</th>
                                    <td>{{auth()->user()->phone}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">CNIC :</th>
                                    <td>{{auth()->user()->cnic}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Email :</th>
                                    <td>{{auth()->user()->email}}</td>
                                </tr>
                            </table>
                            <table class="table table-striped table-sm border mt-5 bg-white ">

                                <tr>
                                    <th class="text-primary">Date of Birth :</th>
                                    <td>{{date('d M, Y',strtotime(auth()->user()->dob))}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Joining :</th>
                                    <td>{{date('d M, Y',strtotime(auth()->user()->joining))}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Address :</th>
                                    <td>{{auth()->user()->address}}</td>
                                </tr>
                            </table>
                            <table class="table table-striped table-sm border mt-5 bg-white ">
                            <tr>
                                    <th class="text-primary">Department :</th>
                                    <td> {{auth()->user()->departments->name}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Designation :</th>
                                    <td> {{auth()->user()->designations->name}}</td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Roles :</th>
                                    <td> {{auth()->user()->roles->name}}</td>
                                </tr>
                            </table>
                            @if(auth()->user()->cv)
                            <div class="border bg-white col-12 mt-5 text-center pt-3">
                                <p class="fa-2x text-primary">Curriculum Vitae
                                <a href="{{Storage::disk('local')->url('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)}}" target="_blank" class="btn btn-white btn-sm"> ( {{number_format((Storage::disk('local')->size('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)/1024),2)}}
                                KBs ) <i class="fa fa-download fa-1x ml-2"></i></a>
                                </p>
                            </div>
                            @endif

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
    </div>

@endsection