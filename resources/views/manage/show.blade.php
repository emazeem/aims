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
    <div class="row">
        <div class="col-12">
            <h3 class="font-weight-light float-left"><i class="feather icon-eye"></i> {{$show->cid}}</h3>
            @can('create-job')
                @if($createjob==true)
                    <button class="btn btn-primary btn-sm float-right create" data-id="{{$show->id}}"><i class="feather icon-plus-circle"></i> JOB</button>
                @endif
            @endcan
        </div>
        <div class="col-12">
            <table class="table table-hover bg-white table-bordered table-sm mt-2 detail-table">
                <tr>
                    <td><b>Quote #</b></td>
                    <td>{{$show->cid}}</td>
                </tr>
                <tr>
                    <td><b>Customer</b></td>
                    <td>{{$show->customers->reg_name}}</td>
                </tr>
                @if(count($jobs)>0)
                    <tr>
                        <td><b>All Jobs ({{count($jobs)}})</b></td>
                        <td>
                            @can('jobs-view')
                                @foreach($jobs as $job)
                                <a class="badge badge-light border hover px-3 p-2 mb-1"
                                   href="{{url('jobs/view/'.$job->id)}}" data-id="{{$job->id}}">
                                    {{$job->cid}}
                                </a>
                                <span class="badge badge-light border hover px-3 p-2 delete" style="cursor: pointer"
                                      href="javascript:void(0);" data-id="{{$job->id}}">
                                <i class="fa fa-trash"></i>
                            </span>
                                <br>
                                <form id="delete_job" class="float-left mr-1">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$job->id}}">
                                </form>
                            @endforeach
                            @endcan
                        </td>
                    </tr>
                @endif
                <tr>
                    <td><b>Created on</b></td>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this job?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('jobs.manage.delete')}}",
                                type: "POST",
                                dataType: "JSON",
                                data: {'id': id, _token: '{{csrf_token()}}'},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {});
                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.create', function (e) {
                swal({
                    title: "Are you sure to create job against {{$show->cid}}?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');

                            e.preventDefault();
                            $.ajax({
                                url: "{{route('jobs.store')}}",
                                type: "POST",
                                dataType: "JSON",
                                data: {'id': id, _token: '{{csrf_token()}}'},
                                success: function(data)
                                {
                                    swal('success',data.success,'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function(xhr)
                                {
                                    var error='';
                                    $.each(xhr.responseJSON.errors, function (key, item) {
                                        error+=item;
                                    });
                                    swal("Failed", error, "error");
                                }
                            });

                        }
                    });

            });

        });
    </script>
@endsection






