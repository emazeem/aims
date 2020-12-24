@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif

    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> Staff Details</h3>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover font-13">
                <tr>
                    <th>First Name</th>
                    <td>{{$show->fname}}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{$show->lname}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$show->email}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$show->phone}}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{$show->father_name}}</td>
                </tr>
                <tr>
                    <th>CNIC</th>
                    <td>{{$show->cnic}}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{$show->departments->name}}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td>{{$show->designations->name}}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{$show->roles->name}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$show->address}}</td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td><img src="{{Storage::disk('local')->url('public/signature/'.$show->id.'/'.$show->signature)}}"   class="img-fluid" width="100"></td>
                </tr>

                <tr>
                    <th>CV</th>
                    <td>
                        @if(auth()->user()->cv)
                            <a href="{{Storage::disk('local')->url('public/cv/'.$show->id.'/'.$show->cv)}}" target="_blank" class="btn btn-app btn-lg">
                                <i class="fa fa-cloud-download"></i>
                                Curriculum Vitae ( {{number_format((Storage::disk('local')->size('public/cv/'.$show->id.'/'.$show->cv)/1024),2)}} KBs )

                            </a>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection