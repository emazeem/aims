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
                    <td>{{$show->type_of_leave==0?'Full Day':'Half Day'}}
                        <sup>{{$show->type_time==0?'[Morning]':'Evening'}}</sup>
                    </td>
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
                @if($show->head_remarks)
                <tr>
                    <th>Head Remarks</th>
                    <td>{{$show->head_remarks}}</td>
                </tr>
                @endif
                @if($show->ceo_remarks)
                <tr>
                    <th>CEO Remarks</th>
                    <td>{{$show->ceo_remarks}}</td>
                </tr>
                @endif
                @if($show->admin_remarks)
                <tr>
                    <th>Admin Remarks</th>
                    <td>{{$show->admin_remarks}}<br>{{$show->admin_recommendation_date->format('d-m-Y')}}</td>
                </tr>

                @endif

                <tr>
                    <th>Status</th>
                    <td>
                        @if($show->status==0)
                            <span class="badge badge-info">Pending</span>
                        @elseif($show->status==1)
                            <span class="badge badge-danger">Rejected By Dept Head</span>
                        @elseif($show->status==2)
                            <span class="badge badge-success">Approved By Dept Head</span>
                            <span class="badge badge-danger">CEO Approval Pending</span>
                        @elseif($show->status==3)
                            <span class="badge badge-danger">Rejected By CEO</span>
                        @elseif($show->status==4)
                            <span class="badge badge-success">Approved By CEO</span>
                        @else
                        @endif
                    </td>
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
                    <th>Admin / HR</th>
                    <td>{{$show->admin->fname}} {{$show->admin->lname}}</td>
                </tr>

                <tr>
                    <th>Created on</th>
                    <td>{{date('d/m/Y',strtotime($show->created_at))}}</td>
                </tr>
            </table>
        </div>
        @if($show->admin_id==auth()->user()->id)
        <div class="col-12">
            <h4 class="font-weight-light">Admin Remarks</h4>
            <form action="{{route('leave_application.remarks')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$show->id}}">
                <input type="hidden" name="approvalno" value="3">
                <textarea type="text" class="form-control" id="remarks" placeholder="Enter Remarks of Application" name="remarks"></textarea>
                <button type="submit" class="btn btn-sm btn-success btn-block">Save</button>
            </form>
        </div>
            @endif
    </div>

@endsection

