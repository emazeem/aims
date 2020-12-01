@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h2 class="float-left">{{$show->id}}'s Detail</h2>

            {{--<button type="button" class="btn btn-primary create-jobs" data-id="{{$show->id}}">
                <i class='fa fa-plus'></i> Create Jobs
            </button>
            --}}
            <a class="btn btn-primary float-right" href="{{url('/jobs/manage/create/'.$show->id)}}">
                <i class='fa fa-plus'></i> Create Jobs
            </a>


            <table class="table table-striped bg-white table-sm table-bordered mt-2">
                <tr>
                    <td><b>Quote #</b></td>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <td><b>Jobs Created</b></td>
                    <td>{{$jobs->count()}}</td>
                </tr>

                <tr>
                    <td><b>Customer</b></td>
                    <td>{{$show->customers->reg_name}}</td>
                </tr>
                <tr>
                    <td><b>{{$show->name}} Jobs</b></td>
                    <td>{{$jobs->count()}}</td>
                </tr>
                @if(count($jobs)>0)
                <tr>
                    <td><b>All Jobs ({{count($jobs)}})</b></td>
                    <td>
                        @foreach($jobs as $job)
                            <a class="btn btn-sm btn-outline-danger delete" href="javascript:void(0);" data-id="{{$job->id}}">JOB # {{$job->id}} <i class="fa fa-trash"></i></a>
                            <form id="delete_job" class="float-left mr-1">
                                @csrf
                                <input type="hidden" name="id" value="{{$job->id}}">
                            </form>
                        @endforeach
                    </td>
                </tr>
                @endif
                <tr>
                    <td><b>Created on</b></td>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <td><b>Updated on</b></td>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal fade" id="create_jobs" tabindex="-1" role="dialog" aria-labelledby="create_jobs" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit_session">Create Jobs</h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_jobs">
                    @csrf
                    <input type="hidden" value="" id="quote_id" name="id">

                        <div class="group-checkbox"></div>


                </div>
                <div class="modal-footer">
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.create-jobs', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('/jobs/manage/get_items')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        $(".loading").fadeIn();
                    },
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Permission denied for this action." , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        $('#create_jobs').modal('toggle');
                        $('#quote_id').val(id);
                        $.each(data, function(key, value) {
                            //$('select[name="items"]').append('<option value="'+value.id+'">'+value.capability+'</option>');
                        });
                    },
                    error: function(){},
                });
            });
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this job?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '{{csrf_token()}}';
                            e.preventDefault();
                            $.ajax({
                                url: "{{route('jobs.manage.delete')}}",
                                type: "POST",
                                dataType: "JSON",
                                data: {'id': id,_token: '{{csrf_token()}}'},
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal('success',data.success,'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function(data){
                                    swal("Failed", data.error , "error");
                                },
                            });

                        }
                    });

            });
        });
    </script>

@endsection






