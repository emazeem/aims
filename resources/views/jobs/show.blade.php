@extends('layouts.master')
@section('content')
    <style>
        .line-through{
            -webkit-text-decoration-line: line-through; /* Safari */
            text-decoration-line: line-through;
        }

    </style>
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light"><i class="feather icon-eye"></i> Job Detail</h3>
            <div class="float-right">
                @can('print-job-form')
                    <a onclick="window.open('{{url('/jobs/print/jobform/'.$job->id)}}','newwindow','width=1100,height=1000');return false;"
                       href="{{url('/jobs/print/jobform/'.$job->id)}}" title='Print'
                       class='pull-left btn btn-sm btn-info'><i
                                class="fa fa-print"></i> {{$job->cid}}</a>
                @endcan
                @can('print-delivery-note')
                    @if($job->status>=0)
                        @if(count($job->dn)>0)
                            <a onclick="window.open('{{url('/jobs/print/DN/'.$job->id)}}','newwindow','width=1100,height=1000');return false;"
                               href="{{url('/jobs/print/DN/'.$job->id)}}" title='Print'
                               class='pull-left btn btn-sm btn-info'><i
                                        class="fa fa-print"></i> Merge DN</a>
                        @endif
                    @endif
                    @if($job->status>=0)
                        <a data-toggle="modal" data-target="#add_delivery_note" href
                           class='pull-left btn btn-sm btn-success'><i
                                    class="feather icon-plus-circle"></i> DN</a>
                    @endif
                    @foreach($job->dn as $dn)
                        <a onclick="window.open('{{url('/delivery_note/print/DN/'.$dn->id)}}','newwindow','width=1100,height=1000');return false;"
                           href="{{url('/delivery_note/print/DN/'.$dn->id)}}" title='Print'
                           class='pull-left btn btn-sm btn-info'><i
                                    class="fa fa-print"></i> {{$dn->cid}}</a>
                    @endforeach
                @endcan
                @include('delivery_note.create')
            </div>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered table-sm bg-white">
                <tr>
                    <th>ID</th>
                    <td>{{$job->cid}}</td>
                </tr>
                <tr>
                    <th>Quote ID</th>
                    <td>{{$job->quotes->cid}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$job->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>

                        @if($job->status==0)
                            <span class="badge badge-danger px-2 py-1">Pending</span>
                        @endif
                        @if($job->status>0)
                            <span class="badge badge-primary px-2 py-1">Closed</span>
                        @endif

                    </td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                        @if($labjobs->count()>0 and $sitejobs->count()==0)
                            LAB
                        @elseif($labjobs->count()==0 and $sitejobs->count()>0)
                            SITE
                        @else
                            @if($labjobs->count()==0 and $sitejobs->count()==0)
                                ----
                            @else
                                LAB+SITE

                            @endif
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Turnaround</th>
                    <td>{{$job->quotes->turnaround}} Days</td>
                </tr>
                @if($labjobs->count()>0)
                    <tr>
                        <th>Mode of Receiving</th>
                        <td>
                            <form method="post" id="receiving-mode-form" class="row p-0 m-0">
                                @csrf
                                <input type="hidden" name="id" value="{{$job->id}}">
                                <input type="hidden" name="type" value="0">
                                <div class="form-group col-md-6 col-12 p-0 m-0">
                                    <label for="receiving_mode"></label>
                                    <select class="form-control form-control-sm float-left" name="receiving_mode"
                                            id="receiving_mode">
                                        <option disabled selected>--Select Receiving Mode</option>
                                        <option value="By Courier/Cargo">By Courier/Cargo</option>
                                        <option value="By AIMS Team">By AIMS Team</option>
                                        <option value="By Customer">By Customer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12 p-0 m-0">
                                    <label for="receiving_details"></label>
                                    <input class="form-control form-control-sm float-left" id="receiving_details" placeholder="Enter Details of Receiving" name="receiving_details"/>
                                </div>

                                <div class="form-group mt-2">
                                    @foreach($labjobs as $item)
                                        <div class='checkbox checkbox-fill checkbox-warning d-inline'>
                                            <input type='checkbox' checked data-id='{{$item->id}}' name='receiving_items[]' {{in_array($item->id,$already_received_items)?'disabled':''}} multiple class='receiving_items' id='receiving_items{{$item->id}}' value="{{$item->id}}">
                                            <label class='cr {{in_array($item->id,$already_received_items)?'line-through':''}}'  for='receiving_items{{$item->id}}' >{{$item->item->capabilities->name}}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col p-0 m-0 mt-2 text-right">
                                    <button class="btn btn-warning btn-sm rounded receiving-mode-btn ml-2" type="submit"><i
                                                class="fa fa-plus-square"></i> Receiving</button>
                                </div>
                            </form>
                        </td>
                    </tr>

                        @foreach($job->receivings as $k=>$receiving)
                            @if($receiving->type==0)
                        <tr>
                            <th>
                                Mode of Receiving : <span class="font-weight-normal">{{$receiving->mode}}</span> (# {{$k+1}})<br>
                                Details : <span class="font-weight-normal">{{$receiving->details}}</span>
                            </th>
                            <td>
                                @foreach(explode(',',$receiving->items) as $item)
                                    <span class="mx-1 rounded bg-warning px-2">
                                        {{\App\Models\Jobitem::find($item)->item->capabilities->name}}
                                    </span>
                                @endforeach
                                <b class="float-right">{{date('d-m-Y',strtotime($receiving->created_at))}}</b>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                    <tr>
                        <th>Mode of Delivery</th>
                        <td>
                            <form method="post" id="delivery-mode-form" class="row p-0 m-0">
                                @csrf
                                <input type="hidden" name="id" value="{{$job->id}}">
                                <input type="hidden" name="type" value="1">
                                <div class="form-group col-md-6 col-12 p-0 m-0">
                                    <label for="delivery_mode"></label>
                                    <select class="form-control form-control-sm float-left" name="delivery_mode"
                                            id="delivery_mode">
                                        <option disabled selected>--Select Delivery Mode</option>
                                        <option value="By Courier/Cargo">By Courier/Cargo</option>
                                        <option value="By AIMS Team">By AIMS Team</option>
                                        <option value="By Customer">By Customer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12 p-0 m-0">
                                    <label for="delivery_details"></label>
                                    <input class="form-control form-control-sm float-left" id="delivery_details" placeholder="Enter Details of Delivery" name="delivery_details"/>
                                </div>

                                <div class="form-group mt-2">
                                    @foreach($labjobs as $item)
                                        @if(in_array($item->id,$already_received_items))
                                        <div class='checkbox checkbox-fill d-inline'>
                                            <input type='checkbox' checked name='delivering_items[]' {{in_array($item->id,$already_delivered_items)?'disabled':''}} multiple class='delivering_items' id='delivering_items{{$item->id}}' value="{{$item->id}}">
                                            <label class='cr {{in_array($item->id,$already_delivered_items)?'line-through':''}}' for='delivering_items{{$item->id}}' >{{$item->item->capabilities->name}}</label>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col p-0 m-0 mt-2 text-right">
                                    <button class="btn btn-success btn-sm rounded delivery-mode-btn ml-2" type="submit"><i
                                                class="fa fa-plus-square"></i> Delivery</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @foreach($job->receivings as $k=>$delivery)
                        @if($delivery->type==1)
                            <tr>
                                <th>
                                    Mode of Delivery : <span class="font-weight-normal">{{$delivery->mode}}</span> (# {{$k+1}})<br>
                                    Details : <span class="font-weight-normal">{{$delivery->details}}</span>
                                </th>
                                <td>
                                    @foreach(explode(',',$delivery->items) as $item)
                                        <span class="mx-1 rounded bg-success px-2">
                                        {{\App\Models\Jobitem::find($item)->item->capabilities->name}}
                                    </span>
                                    @endforeach
                                    <b class="float-right">{{date('d-m-Y',strtotime($delivery->created_at))}}</b>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </table>
            @can('complete-job')
                @if($job->status==0)
                    @if($close==true)
                        <form method="post" id="complete-job-form" class="float-right">
                            @csrf
                            <input type="hidden" name="id" value="{{$job->id}}">
                            <button class="btn btn-danger btn-sm complete-job-btn" type="submit"><i
                                        class="fa fa-hourglass-start" aria-hidden="true"></i> Close
                            </button>
                        </form>
                    @endif
                @endif
            @endcan
        </div>
        @if($job->status==0)
            @include('jobs.create')
        @endif
    </div>
    <script>
        'use strict';
        function inArray(needle, haystack) {
            var length = haystack.length;
            for (var i = 0; i < length; i++) {
                if (haystack[i] == needle) return true;
            }
            return false;
        }
        $(document).ready(function () {
            $(document).on('click', '.complete-job-btn', function (e) {
                e.preventDefault();
                swal({
                    title: "Are you sure to close this job?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var button = $('.complete-job-btn');
                            var previous = $(button).html();
                            button.attr('disabled', 'disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                            var request_method = $("#complete-job-form").attr("method");
                            var form_data = $("#complete-job-form").serialize();

                            $.ajax({
                                url: "{{route('jobs.complete')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                success: function (data) {
                                    button.attr('disabled', null).html(previous);
                                    swal('success', data.success, 'success').then((value) => {
                                        location.reload();
                                    });

                                },
                                error: function (xhr) {
                                    button.attr('disabled', null).html(previous);
                                    var error = '';
                                    $.each(xhr.responseJSON.errors, function (key, item) {
                                        error += item;
                                    });
                                    swal("Failed", error, "error");
                                },
                            });

                        }
                    });

            });

            $('.select-2-users').select2();
            $('.select-2-asset').select2();


            $(document).on('click', '.assign-lab-task', function () {
                var id = $(this).attr('data-id');
                $('#assign-lab-task').modal('show');
                $('#lab_task_id').val(id);
                $('.select-2-asset').empty();
                $.ajax({
                    url: "{{url('suggestions/for_lab_job')}}/" + id,
                    type: "GET",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $.each(data['assets'], function (i, v) {
                            var selection = '';
                            if (inArray(v.id, data['suggestions'])) {
                                selection = 'selected';
                            }

                            $('.select-2-asset').append(
                                '<option value="' + v.id + '" ' + selection + '>' + v.code + '-' + v.name + '-' + v.range + '-' + v.accuracy + '-' + v.resolution + '</option>'
                            );
                        });
                    },
                });

            });
            $(document).on('click', '.scan', function () {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $('#scan_id').val(id);
                $('#scan_type').val(type);
                $('#scan').modal('toggle');
                $('#scan').on('shown.bs.modal', function () {
                    $('#scan_url').focus();
                });
            });
            $('#scan_url').change(function () {
                setTimeout(function () {
                    //var data = JSON.stringify( $('#scan_form').serializeArray() );
                    var data = $("#scan_form").serializeArray();
                    var type = null;
                    var id = null;
                    var url = null;
                    $.each(data, function (i, fields) {
                        if (fields.name == 'type') {
                            type = fields.value;
                        }
                        if (fields.name == 'id') {
                            id = fields.value;
                        }
                        if (fields.name == 'url') {
                            url = fields.value;
                        }
                        //console.log(fields.name + ":" + fields.value + " ");
                    });

                    window.location.href = 'https://' + url + '/' + type + '/' + id;
                }, 2000);
            });
            $("#receiving-mode-form").on('submit', (function (e) {
                e.preventDefault();
                var button = $('.receiving-mode-btn');
                var previous = $(button).html();
                button.attr('disabled', 'disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('jobs.modes')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled', null).html(previous);
                        swal("Success", data.success, "success").then(response => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled', null).html(previous);
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
            $("#delivery-mode-form").on('submit', (function (e) {
                e.preventDefault();
                var button = $('.delivery-mode-btn');
                var previous = $(button).html();
                button.attr('disabled', 'disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('jobs.modes')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled', null).html(previous);
                        swal("Success", data.success, "success").then(response => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        button.attr('disabled', null).html(previous);
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));


            $("#add_delivery_note_form").on('submit', (function (e) {
                e.preventDefault();
                var val = [];
                $('.delivery_items:checked').each(function (i) {
                    val[i] = $(this).attr('data-id');
                });
                $('#delivery_item_id').val(val);
                var button = $('.delivery-note-add-btn');
                var previous = $(button).html();
                button.attr('disabled', 'disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('delivery_note.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        button.attr('disabled', null).html(previous);
                        swal('success', data.success, 'success').then((value) => {
                            $('#add_delivery_note').modal('hide');
                            location.reload();
                        });

                    },
                    error: function (xhr) {

                        button.attr('disabled', null).html(previous);
                        var error = '';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error += item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
        });
    </script>
    <div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Scan your Equipment</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="scan_form">
                        @csrf
                        <input type="text" value="" name="type" id="scan_type" class="form-control" hidden>
                        <input type="text" value="" name="id" id="scan_id" class="form-control" hidden>
                        <input type="text" value="" class="form-control" id="scan_url" name="url">
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @include('assign_item.labjob')


    <div class="x_content">

        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lab-tab" data-toggle="tab" href="#lab" role="tab" aria-controls="home"
                   aria-selected="true">Lab Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="site-tab" data-toggle="tab" href="#site" role="tab" aria-controls="profile"
                   aria-selected="false">Site Items</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="lab" role="tabpanel" aria-labelledby="lab-tab">
                @if(count($labjobs)>0)
                    <div class="col-12">
                        <div class="row table-responsive">
                            <table class='table mt-3 table-bordered table-sm table-hover bg-white'>
                                <thead>
                                <tr>
                                    <th class="px-1 py-2" title="Capability & Parameter">Capabilities<br>[Parameter]
                                    </th>
                                    <th class="px-1 py-2" title="Range">Range</th>
                                    <th class="px-1 py-2" title="Accreditation">Accred.</th>
                                    <th class="px-1 py-2" title="Status">Status</th>
                                    <th class="px-1 py-2" title="Equipment ID / Serial">ID<br>Serial</th>
                                    <th class="px-1 py-2" title="Make">Make</th>
                                    <th class="px-1 py-2" title="Model">Model</th>
                                    <th class="px-1 py-2" title="Accessories">Acce.</th>
                                    <th class="px-1 py-2" title="Visual Inspection">V.I</th>
                                    <th class="px-1 py-2" title="Start / End">Start<br>End</th>
                                    <th class="px-1 py-2" title="Assigned Technician / Engineer">Tech</th>
                                    <th class="px-1 py-2" title="Assigned Assets">Assets</th>
                                    <th class="px-1 py-2" title="Started At / Ended At">Started <br> Ended</th>
                                    <th class="px-1 py-2" title="Certificate #">Cert#</th>
                                    <th class="px-1 py-2" title="Check In By">Check-in By</th>
                                    <th class="px-1 py-2" title="Action">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($labjobs as $k=>$labjob)
                                    <tr>
                                        <td class="p-1 m-0">
                                            {{\App\Models\Capabilities::find($labjob->item->capability)->name}}
                                            <br>[
                                            <small>
                                                {{\App\Models\Parameter::find($labjob->item->parameter)->name}}
                                            </small>
                                            ]
                                        </td>
                                        <td class="p-1 m-0">{{$labjob->item->range}}</td>
                                        <td class="p-1 m-0">{{$labjob->item->accredited}}</td>
                                        <td class="p-1 m-0">
                                            @if($labjob->status==0)

                                                <span class="badge badge-primary">Pending</span>
                                            @elseif($labjob->status==1)

                                                <span class="badge badge-danger">Check-in</span>
                                            @elseif($labjob->status==2)

                                                <span class="badge badge-success">Assigned</span>
                                            @elseif($labjob->status==3)
                                                <span class="badge badge-success">Started</span>
                                            @elseif($labjob->status==4)
                                                <span class="badge badge-success">Ended</span>
                                                {{--                                                    <span class="badge badge-success">Calculated</span>--}}
                                            @elseif($labjob->status==5)
                                                <span class="badge badge-success">Ended</span>
                                            @endif
                                        </td>
                                        <td class="p-1 m-0">{{$labjob->eq_id}}<br>{{$labjob->serial}}</td>
                                        <td class="p-1 m-0">{{$labjob->make}}</td>
                                        <td class="p-1 m-0">{{$labjob->model}}</td>
                                        <td class="p-1 m-0">{{$labjob->accessories}}</td>
                                        <td class="p-1 m-0">{{$labjob->visual_inspection}}</td>
                                        <td class="p-1 m-0">@if($labjob->status>1){{date('d M,y',strtotime($labjob->start))}}@endif
                                            <br>@if($labjob->status>1){{date('d M,y',strtotime($labjob->end))}}@endif
                                        </td>
                                        <td class="p-1 m-0">
                                            @if($labjob->status>1)
                                                @if($labjob->assign_user)
                                                    {{$labjob->assignuser->fname.' '.$labjob->assignuser->lname}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="p-1 m-0">
                                            @if($labjob->status>1)
                                                @if($labjob->assign_assets)
                                                    @php $assets=explode(',',$labjob->assign_assets); @endphp
                                                    @foreach($assets as $asset)
                                                        <span class="badge border py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                                    @endforeach
                                                @endif
                                            @endif

                                        </td>
                                        <td class="p-1 m-0">
                                            @if($labjob->status>2)
                                                {{date(' h:i A d M,y',strtotime($labjob->started_at))}}
                                            @endif
                                            <br>
                                            @if($labjob->status>3)
                                                {{date(' h:i A d M,y',strtotime($labjob->ended_at))}}
                                            @endif
                                        </td>
                                        <td class="p-1 m-0">
                                            {{$labjob->cid}}
                                        </td>
                                        <td class="p-1 m-0">

                                            {{$labjob->receiving_user->fname}} {{$labjob->receiving_user->lname}}
                                            on {{$labjob->check_in}}
                                        </td>
                                        <td class="p-1 m-0">
                                            <a href="#" data-id="{{$labjob->id}}" data-type="lab"
                                               class="btn bg-white border btn-sm scan"><i class="fa fa-search"></i></a>
                                            @if($job->status==0)
                                                @can('create-lab-task-assign')
                                                    <button type="button" data-id="{{$labjob->id}}"
                                                            class="btn btn-sm bg-white border pull-right assign-lab-task">
                                                        <i class="fa fa-plus-square"></i> Assign
                                                    </button>
                                                @endcan
                                                @can('lab-item-receiving-update')
                                                    @if($labjob->status>0)
                                                        <a href="#" data-id="{{$labjob->id}}"
                                                           class="btn edit bg-white border btn-sm"><i
                                                                    class="fa fa-edit"></i>
                                                            Receiving</a>
                                                    @endif
                                                @endcan
                                                <a onclick="window.open('{{url('jobs/print/jobtag/'.$labjob->id)}}','newwindow','width=500,height=520');return false;"
                                                   href="{{url('jobs/print/jobtag/'.$labjob->id)}}"
                                                   class="btn bg-white border btn-sm"><i
                                                            class="fa fa-tag"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{--@foreach($labjobs as $k=>$labjob)
                                <div class="col-md-4 col-12 mt-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#" data-id="{{$labjob->id}}" data-type="lab"
                                               class="btn btn-light border btn-sm scan"><i class="fa fa-search"></i></a>
                                            @if($job->status==0)
                                                @can('create-lab-task-assign')
                                                    <button type="button" data-id="{{$labjob->id}}"
                                                            class="btn btn-sm btn-light border pull-right assign-lab-task">
                                                        <i class="fa fa-plus-square"></i> Assign
                                                    </button>
                                                @endcan
                                                @can('lab-item-receiving-update')
                                                    @if($labjob->status>0)
                                                        <a href="#" data-id="{{$labjob->id}}"
                                                           class="btn edit btn-light border btn-sm"><i
                                                                    class="fa fa-edit"></i>
                                                            Receiving</a>
                                                    @endif
                                                @endcan
                                                    <a onclick="window.open('{{url('jobs/print/jobtag/'.$labjob->id)}}','newwindow','width=500,height=520');return false;"
                                                       href="{{url('jobs/print/jobtag/'.$labjob->id)}}"
                                                       class="btn btn-light border btn-sm"><i
                                                                class="fa fa-tag"></i>
                                                    </a>
                                            @endif
                                        </div>
                                        <div class="card-body">

                                            <p class="m-0">↪ <b>Status : </b>
                                                @if($labjob->status==0)

                                                    <span class="badge badge-primary">Pending</span>
                                                @elseif($labjob->status==1)

                                                    <span class="badge badge-danger">Checked-in</span>
                                                @elseif($labjob->status==2)

                                                    <span class="badge badge-success">Assigned</span>
                                                @elseif($labjob->status==3)
                                                    <span class="badge badge-success">Started</span>
                                                @elseif($labjob->status==4)
                                                    <span class="badge badge-success">Ended</span>
                                                    --}}{{--                                                    <span class="badge badge-success">Calculated</span>--}}{{--
                                                @elseif($labjob->status==5)
                                                    <span class="badge badge-success">Ended</span>
                                                @endif
                                            </p>

                                            <p class="m-0">↪ <b>Parameter
                                                    : </b>{{\App\Models\Parameter::find($labjob->item->parameter)->name}}
                                            </p>
                                            <p class="m-0">↪ <b>Capability
                                                    : </b>{{\App\Models\Capabilities::find($labjob->item->capability)->name}}
                                            </p>
                                            <p class="m-0">↪ <b>Range : </b>{{$labjob->item->range}}</p>
                                            <p class="m-0">↪ <b>Accredited : </b>{{$labjob->item->accredited}}</p>
                                            @if($labjob->cid)
                                                <p class="m-0">↪ <b>Certificate # : </b>{{$labjob->cid}}</p>
                                            @endif
                                            @if($labjob->status<1)
                                                <span class="badge badge-info px-3 py-2 m-1">Waiting for store entry</span>
                                            @else
                                                <p class="m-0">↪ <b>Equipment ID : </b>{{$labjob->eq_id}}</p>
                                                <p class="m-0">↪ <b>Serial : </b>{{$labjob->serial}}</p>
                                                <p class="m-0">↪ <b>Make : </b>{{$labjob->make}}</p>
                                                <p class="m-0">↪ <b>Model : </b>{{$labjob->model}}</p>
                                                <p class="m-0">↪ <b>Accessories : </b>{{$labjob->accessories}}</p>
                                                <p class="m-0">↪ <b>Visual Inspection
                                                        : </b>{{$labjob->visual_inspection}}</p>
                                                <p class="m-0">↪ <b>Receiving By
                                                        : </b>{{$labjob->receiving_user->fname}} {{$labjob->receiving_user->lname}}
                                                </p>
                                            @endif
                                            @if($labjob->status<2)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Assigned yet</span>
                                            @else
                                                <p class="m-0">↪ <b>Start : </b>{{$labjob->start}}</p>
                                                <p class="m-0">↪ <b>End : </b>{{$labjob->end}}</p>
                                                <p class="m-0">↪ <b>Assign User : </b>
                                                    @if($labjob->assign_user)
                                                        {{\App\Models\User::find($labjob->assign_user)->fname}} {{\App\Models\User::find($labjob->assign_user)->lname}}
                                                    @endif
                                                </p>
                                                <p class="m-0">↪ <b>Assign Asset : </b>
                                                    <br>
                                                    @if($labjob->assign_assets)
                                                        @php $assets=explode(',',$labjob->assign_assets); @endphp
                                                        @foreach($assets as $asset)
                                                            <span class="badge border py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                                        @endforeach
                                                    @endif
                                                </p>
                                            @endif
                                            @if($labjob->status<3)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Started yet</span>

                                            @else
                                                <p class="m-0">↪ <b>Started : </b>{{$labjob->started_at}}</p>
                                            @endif
                                            @if($labjob->status<4)
                                                <span class="badge badge-info px-3 py-2 m-1">Not Ended yet</span>
                                            @else
                                                <p class="m-0">↪ <b>Ended : </b>{{$labjob->ended_at}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            --}}
                        </div>
                    </div>

                @endif

            </div>
            <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                @if(count($job->siteplanings)>0)
                    @foreach($job->siteplanings as $k=>$siteplaning)
                        <div class="col-12 card bg-light">
                            <div class="card-header">
                                <h4 class="font-weight-light card-title float-left">Planning # {{$k+1}}</h4>
                                @can('create-gate-pass')
                                    <button type="button"
                                            class="btn btn-sm btn-primary shadow-sm float-right add-gate-pass"
                                            data-id="{{$siteplaning->id}}"><i class="feather icon-plus-circle"></i> Gate
                                        Pass
                                    </button>
                                @endcan
                            </div>
                            <div class="table-responsive mb-2">
                                @can('print-gate-pass')
                                    @if(count($siteplaning->gatepasses)>0)
                                        <table class="table bg-white table-bordered table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date/Time Out</th>
                                                <th>Date/Time In</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($siteplaning->gatepasses as $gatepass)
                                                <tr>
                                                    <td>{{$gatepass->cid}}</td>
                                                    <td>{{$gatepass->out->format('d-m-Y h:i A')}}</td>
                                                    <td>{{$gatepass->in?$gatepass->in->format('d-m-Y h:i A'):''}}</td>
                                                    <td>
                                                        <?php
                                                        $showgp = true;
                                                        foreach ($gatepass->gpitems as $i) {
                                                            if ($i->out_fcb == null) {
                                                                $showgp = false;
                                                            }
                                                        }
                                                        ?>
                                                        @if($showgp==true)
                                                            <a title='Gatepass'
                                                               onclick="window.open('{{url('gate_pass/print/'.$gatepass->id)}}','newwindow','width=1100,height=1000');return false;"
                                                               class='btn btn-sm btn-info'
                                                               href="{{url('gate_pass/print/'.$gatepass->id)}}"><i
                                                                        class="fa fa-print"></i></a>
                                                            <button class="btn btn-sm btn-success gp-item-receive"
                                                                    data-id="{{$gatepass->id}}"> GP Receiving <i
                                                                        class="feather icon-chevron-down"></i></button>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                @endcan
                            </div>
                            <div class="table-responsive mb-2">
                                <table class="table bg-white table-bordered table-hover table-sm">
                                    <tr>
                                        <th>Assigned Assets</th>
                                        <td>
                                            @php $all_assets=explode(',',$siteplaning->assigned_assets);  @endphp
                                            @if(isset($siteplaning->assigned_assets))
                                                @foreach($all_assets as $asset)
                                                    <span class="badge border bg-white">
                                        {{\App\Models\Asset::find($asset)->name}}
                                                        ( {{\App\Models\Asset::find($asset)->code}} )
                                                </span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Assigned Technicians</th>
                                        <td>
                                            @php $all_users=explode(',',$siteplaning->assigned_users); @endphp
                                            @if(isset($siteplaning->assigned_users))

                                                @foreach($all_users as $user)
                                                    <span class="badge border bg-white">
                                                        {{\App\Models\User::find($user)->fname}} {{\App\Models\User::find($user)->lname}}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Assigned Capabilities</th>
                                        <td>
                                            @php $quoteItems=explode(',',$siteplaning->quote_items); @endphp
                                            @if(isset($quoteItems))
                                                @foreach($quoteItems as $item)
                                                    <span class="badge border bg-white">
                                                        {{\App\Models\QuoteItem::find($item)->capabilities->name}}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row table-responsive p-0 m-0">
                                <table class='table mt-3 table-bordered table-sm table-hover bg-white'>
                                    <thead>
                                    <tr>
                                        <th class="px-1 py-2" title="Capability & Parameter">Capabilities<br>[Parameter]
                                        </th>
                                        <th class="px-1 py-2" title="Range">Range</th>
                                        <th class="px-1 py-2" title="Accreditation">Accred.</th>
                                        <th class="px-1 py-2" title="Status">Status</th>
                                        <th class="px-1 py-2" title="Equipment ID / Serial">ID<br>Serial</th>
                                        <th class="px-1 py-2" title="Make">Make</th>
                                        <th class="px-1 py-2" title="Model">Model</th>
                                        <th class="px-1 py-2" title="Accessories">Acce.</th>
                                        <th class="px-1 py-2" title="Visual Inspection">V.I</th>
                                        <th class="px-1 py-2" title="Start / End">Start<br>End</th>
                                        <th class="px-1 py-2" title="Assigned Technician / Engineer">Tech</th>
                                        <th class="px-1 py-2" title="Assigned Assets">Assets</th>
                                        <th class="px-1 py-2" title="Started At / Ended At">Started <br> Ended</th>
                                        <th class="px-1 py-2" title="Certificate #">Cert#</th>
                                        <th class="px-1 py-2" title="Action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\Jobitem::whereIn('item_id',$quoteItems)->get() as $sitejob)
                                        <tr>
                                            <td class="p-1 m-0">
                                                {{\App\Models\Capabilities::find($sitejob->item->capability)->name}}
                                                <br>[
                                                <small>
                                                    {{\App\Models\Parameter::find($sitejob->item->parameter)->name}}
                                                </small>
                                                ]
                                            </td>
                                            <td class="p-1 m-0">{{$sitejob->item->range}}</td>
                                            <td class="p-1 m-0">{{$sitejob->item->accredited}}</td>
                                            <td class="p-1 m-0">

                                                @if($sitejob->status==0)
                                                    <span class="badge badge-primary">Pending</span>
                                                @elseif($sitejob->status==1)
                                                    <span class="badge badge-success">Received</span>
                                                @elseif($sitejob->status==2)
                                                    <span class="badge badge-danger">Assigned</span>
                                                @elseif($sitejob->status==3)
                                                    <span class="badge badge-success">Started</span>
                                                @elseif($sitejob->status==4)
                                                    <span class="badge badge-success">Ended</span>
                                                @endif
                                            </td>
                                            <td class="p-1 m-0">{{$sitejob->eq_id}}<br>{{$sitejob->serial}}</td>
                                            <td class="p-1 m-0">{{$sitejob->make}}</td>
                                            <td class="p-1 m-0">{{$sitejob->model}}</td>
                                            <td class="p-1 m-0">{{$sitejob->accessories}}</td>
                                            <td class="p-1 m-0">{{$sitejob->visual_inspection}}</td>
                                            <td class="p-1 m-0">@if($sitejob->status>1){{date('d M,y',strtotime($sitejob->start))}}@endif
                                                <br>@if($sitejob->status>1){{date('d M,y',strtotime($sitejob->end))}}@endif
                                            </td>
                                            <td class="p-1 m-0">
                                                @if($sitejob->status>1)
                                                    @if($sitejob->assign_user)
                                                        {{$sitejob->assignuser->fname.' '.$sitejob->assignuser->lname}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="p-1 m-0">
                                                @if($sitejob->status>1)
                                                    @if($sitejob->assign_assets)
                                                        @php $assets=explode(',',$sitejob->assign_assets); @endphp
                                                        @foreach($assets as $asset)
                                                            <span class="badge border py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                                        @endforeach
                                                    @endif
                                                @endif

                                            </td>
                                            <td class="p-1 m-0">
                                                @if($sitejob->status>2)
                                                    {{date(' h:i A d M,y',strtotime($sitejob->started_at))}}
                                                @endif
                                                <br>
                                                @if($sitejob->status>3)
                                                    {{date(' h:i A d M,y',strtotime($sitejob->ended_at))}}
                                                @endif
                                            </td>
                                            <td class="p-1 m-0">
                                                {{$sitejob->cid}}
                                            </td>
                                            <td class="p-1 m-0">
                                                <a href="#" data-id="{{$sitejob->id}}" data-type="site"
                                                   class="btn bg-white border btn-sm scan"><i class="fa fa-search"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @include('gatepass.index')
@endsection