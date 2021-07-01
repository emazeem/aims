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
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="float-left font-weight-light">
                <i class="feather icon-list"></i>
                Leave Application
            </h3>
            <span class="float-right">
                @can('add-update-my-application')
                    <a href="{{url('leave-applications/edit/'.$show->id)}}" class="btn float-right"><i class="feather icon-edit-2"></i> Edit</a>
                @endcan
                <a href="{{route('leave_application.print',[$show->id])}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
            </span>
        </div>
        <div class="col-12">

            <table class="table table-hover table-sm table-bordered bg-white">
                <tr>
                    <th>Full Name</th>
                    <td>{{$show->users->fname}} {{$show->users->lname}}</td>
                </tr>
                <tr>
                    <th>Nature of Leave</th>
                    <td>{{$show->nature->name}}</td>
                </tr>
                <tr>
                    <th>Type of Leave</th>
                    <td>{{$show->type_of_leave==1?'Full Day':'Half Day'}}
                        {{$show->type_time?'['.$show->type_time.']':''}}</td>
                </tr>

                <tr>
                    <th>From</th>
                    <td>{{$show->from->format('d/m/Y')}}</td>
                </tr>

                <tr>
                    <th>To</th>
                    <td>{{$show->to->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th>Reason</th>
                    <td>{{$show->reason}}</td>
                </tr>
                <tr>
                    <th>Contact/Phone</th>
                    <td>{{$show->address_contact}}</td>
                </tr>
                <tr>
                    <th>Department Head</th>
                    <td>{{$show->head->fname}} {{$show->head->lname}}</td>
                </tr>
                <tr>
                    <th>CEO</th>
                    <td>{{$show->ceo->fname}} {{$show->ceo->lname}}</td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('d/m/Y',strtotime($show->created_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection

