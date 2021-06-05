@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="pull-left pb-1"><i class="fa fa-eye"></i> Log Reviews</h3>
                <span class="pull-right">
                    @if($show->assign_to==auth()->user()->id)
                        @if($show->status==0)
                            <button class="btn btn-success btn-sm start" data-id="{{$show->id}}"><i class="fa fa-hourglass-start"></i> Start </button>
                        @endif
                        @if($show->status==1)
                            <button class="btn btn-danger btn-sm end" data-id="{{$show->id}}"><i class="fa fa-hourglass-end"></i> End </button>
                        @endif
                    @endif
                </span>
            </div>

            <div class="col-12">
                <table class="table text-dark table-sm bg-white table-bordered table-responsive-sm table-hover font-13 log-table">
                    <tr>
                        <th>Title</th>
                        <td>{{$show->title}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{$show->description}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($show->status==0)
                                <span class="badge badge-danger px-2 py-1"> Pending</span>
                            @elseif($show->status==1)
                                <span class="badge badge-info px-2 py-1"> Started</span>
                            @else
                                <span class="badge badge-success px-2 py-1"> Completed</span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th>Priority</th>
                        <td>
                            @if($show->priority==0)
                                <i class="fa fa-arrow-down text-success"></i> LOW
                            @elseif($show->priority==1)
                                <i class="fa fa-arrow-up text-danger"></i> HIGH
                            @else

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{$show->start->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{$show->end->format('d M Y')}}</td>
                    </tr>

                    @if($show->attachment)
                        <tr>
                            <th>Attachment</th>
                            <td>
                                <img src='{{Storage::disk('local')->url('public/log-reviews/'.$show->attachment)}}'
                                     class='img-fluid' width='100'>
                            </td>
                        </tr>
                    @endif
                    @if($show->started)
                        <tr>
                            <th>Started at</th>
                            <td>{{$show->started->format('d M Y h:i A')}}</td>
                        </tr>
                    @endif
                    @if($show->ended)
                        <tr>
                            <th>Completed at</th>
                            <td>{{$show->ended->format('d M Y h:i A')}}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Assigned By</th>
                        <td>{{$show->createdby->fname.' '.$show->createdby->lname}}</td>
                    </tr>
                    <tr>
                        <th>Assigned To</th>
                        <td>{{$show->assignto->fname.' '.$show->assignto->lname}}</td>
                    </tr>

                </table>
            </div>
            <div class="col-12">
                @if($previous)
                    <span class="pull-left">
                    <a href="{{url('/log-reviews/show/'.$previous->id)}}" class="btn btn-light border btn-sm"><i
                                class="fa fa-angle-left"></i> Previous </a>
                </span>
                @endif
                @if($next)
                    <span class="pull-right">
                    <a href="{{url('/log-reviews/show/'.$next->id)}}" class="btn btn-light border btn-sm"> Next <i
                                class="fa fa-angle-right"></i></a>
                </span>
                @endif

            </div>


        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.start', function (e) {
                swal({
                    title: "Are you sure to start this task?",
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
                                url: "{{route('log_reviews.start')}}",
                                type: 'POST',
                                dataType: "JSON",
                                data: {_token: token, id: id},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });
            });
            $(document).on('click', '.end', function (e) {
                swal({
                    title: "Are you sure to end this task?",
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
                                url: "{{route('log_reviews.end')}}",
                                type: 'POST',
                                dataType: "JSON",
                                data: {_token: token, id: id},
                                success: function (data) {
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function (data) {
                                    swal("Failed", data.error, "error");
                                },
                            });

                        }
                    });
            });


        });
    </script>
@endsection


