@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <style>
        th{
            float: right;
        }
    </style>
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light pb-1"><i class="feather icon-eye"></i> Personnel</h3>
        </div>
        <div class="col-8">
            <table class="table table-borderless bg-white table-sm table-responsive-sm table-hover font-13">
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
                @if($show->cv)
                    <tr>
                    <th>CV</th>
                    <td>
                        <a href="{{Storage::disk('local')->url('public/cv/'.$show->id.'/'.$show->cv)}}" target="_blank" class="btn btn-app btn-lg">
                            <i class="fa fa-cloud-download"></i>
                            Curriculum Vitae ( {{number_format((Storage::disk('local')->size('public/cv/'.$show->id.'/'.$show->cv)/1024),2)}} KBs )
                        </a>
                    </td>
                </tr>
                @endif
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                @if(count($show->parameters)>0)
                <tr>
                    <th>Auth Parameters</th>
                    <td>
                        @foreach ($show->parameters as $paramter)
                            <?php $delete=null; ?>
                        @can('delete-staff-parameter-authorization')
                            <?php $delete='delete-authorization-parameter';?>
                        @endcan
                        <small data-id="{{$paramter->id}}" data-user-id="{{$show->id}}" class="m-1 {{$delete}} badge bg-danger text-light float-left">
                            {{$paramter->name}} <i class="float-right feather icon-delete text-light ml-2"></i></small>
                        @endforeach
                    </td>
                </tr>
                    @endif
            </table>
        </div>
        <div class="col-4">
            <div class="col-12 text-center">
                @if($show->profile)
                    <img src="{{Storage::disk('local')->url('public/profile/'.$show->id.'/'.$show->profile)}}"   class="img-fluid">
                @endif
            </div>
            <div class="col-12 text-right mt-4">
                @if($show->signature)
                    <img src="{{Storage::disk('local')->url('public/signature/'.$show->id.'/'.$show->signature)}}"   class="img-fluid" width="100">
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete-authorization-parameter', function (e) {
                swal({
                    title: "Are you sure to delete this authorization parameter of this user?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var id = $(this).attr('data-id');
                            var user_id = $(this).attr('data-user-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('authorization.destroy')}}",
                                type: 'DELETE',
                                dataType: "JSON",
                                data: {'id': id,'user_id':user_id, _token: token},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });
                                },
                                error: function () {
                                    swal("Failed", "Unable to delete.", "error");
                                },
                            });

                        }
                    });

            });
        });
    </script>
@endsection