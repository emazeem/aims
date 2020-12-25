@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
        <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> Forms & Formats</h3>
        <a href="{{url('forms/create/'.$show->id)}}" class="btn btn-sm btn-primary shadow-sm" ><i class="fa fa-plus-circle"></i> Form & Format</a>

    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Sop's</th>
                    <td>
                    @foreach(explode(',',$show->sops) as $sop)
                            <span class="badge badge-dark">
                                {{\App\Models\Sops::find($sop)->name}}
                            </span>
                    @endforeach
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered">
                <tr>

                    <th>Doc #</th>
                    <th>Revision #</th>
                    <th>Issue #</th>
                    <th>Issue Date</th>

                    <th>Reviewed On</th>
                    <th>Reviewed By</th>
                    <th>Status</th>
                    <th>Mode of Storage</th>
                    <th>Location</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
                @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->doc_no}}</td>
                        <td>{{$detail->rev_no}}</td>
                        <td>{{$detail->issue_no}}</td>
                        <td>{{$detail->issue}}</td>
                        <td>{{$detail->reviewed_on}}</td>
                        <td>{{$detail->reviewedby->fname}} {{$detail->reviewedby->lname}}</td>
                        <td>@if($detail->status==0)<span class="badge badge-danger">Inactive</span>@else<span class="badge badge-success">Active</span>@endif</td>
                        <td>{{$detail->mode_of_storage}}</td>
                        <td>{{$detail->location}}</td>
                        <td>{{$detail->file}}
                            <a href="{{Storage::disk('local')->url('SOPS/'.$show->name.'/'.$detail->file)}}" download
                               class="btn border px-2 p-0 m-0 pull-right">
                                <small>Download <i class="fa fa-download"></i></small>
                            </a></td>
                        <td>
                            <a href="{{url('/forms/edit/details/'.$detail->id)}}" class="btn btn-sm btn-primary shadow-sm" ><i class="fa fa-pencil"></i></a>
                            <a class='btn btn-danger btn-sm delete' href='#' data-id='{{$detail->id}}'><i class='fa fa-trash-o'></i></a>
                            <form id="form{{$detail->id}}" method='post' role='form'>
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                <input name="id" type="hidden" value='{{$detail->id}}'>
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete', function(e)
            {
                swal({
                    title: "Are you sure to delete this Forms&Formats?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#form"+id).attr("method");
                            var form_data = $("#form"+id).serialize();
                            $.ajax({
                                url: "{{url('forms/destroy')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
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