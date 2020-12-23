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
                    <th>CV</th>
                    <td>
                        <div class="border p-2 col-6">
                            <div class="bg-white p-2">
                                <?php $name=explode('-',$show->cv); ?>
                                <a download href="{{Storage::disk('local')->url('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)}}">
                                    <i class="fa fa-save fa-2x"> {{$name[1]}}</i>
                                </a>
                            </div>

                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td><img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}"   class="img-fluid" width="50"></td>
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