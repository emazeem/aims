@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <div class="row">
        <table class="table table-hover bg-white table-bordered table-sm mt-2">
            <thead>
            <tr>

                <th>Capability</th>
                <th>Parameter</th>
                <th>Range</th>
                <th>Location</th>
                <th>Accredited</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="text-capitalize">
            @foreach($items as $item)
                <tr>
                    <td>
                        <label class="form-check-label"
                               for="{{$item->id}}">{{$item->capabilities->name}}</label>
                    </td>
                    <td>{{$item->parameters->name}}</td>

                    <td>{{$item->range}}</td>
                    <td>{{$item->location}}</td>
                    <td>{{$item->accredited}}</td>
                    <td class="px-1 mx-0 row">
                        <div class="col-12 mx-0 px-0">
                            <span class="font-weight-bold float-left">Total:</span>
                            <span class="float-right ">{{$item->quantity}}</span>
                        </div>
                        @php $jobitems=\App\Models\Jobitem::where('item_id',$item->id)->get()->count() @endphp

                        <div class="col-12 mx-0 px-0">
                            <span class="font-weight-bold float-left">Balance:</span>
                            <span class="float-right ">{{$item->quantity-$jobitems}}</span>
                        </div>
                    </td>
                    <td>
                        @if($jobitems=\App\Models\Jobitem::where('item_id',$item->id)->get()->count()<$item->quantity)
                            <a href="#" title="Store Entry" data-id="{{$item->id}}" data-target="{{$site->job_id}}" class="btn add btn-light border btn-sm"><i class="feather icon-plus"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="add_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_details_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="" id="add_id" name="id">
                            <input type="hidden" value="" id="add_job" name="job">
                            <div class="form-group col-12  float-left">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="make" name="make" placeholder="make" autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial #" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>

                            <div class="form-group col-12  float-left">
                                <label for="accessories">Accessories</label>
                                <input type="text" class="form-control" id="model" name="accessories" placeholder="Accessories" autocomplete="off" value="NIL">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="OK">
                            </div>


                        </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><i class="feather icon-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.select-2-users').select2();
            $('.select-2-asset').select2();

            $(document).on('click', '.add', function () {
                var id = $(this).attr('data-id');
                var job = $(this).attr('data-target');
                $('#add_id').val(id);
                $('#add_job').val(job);
                $('#add_details').modal('toggle');
            });
            $("#add_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        $('#add_details').modal('toggle');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });
                    },
                    error:  function(xhr, status)
                    {
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    },
                });
            }));
            $(document).on('click', '.assign-site-task', function () {
                var id = $(this).attr('data-id');

                $('#assign-site-task').modal('show');
                $('#site_task_id').val(id);
            });
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{url('item_entries/edit/')}}/"+id,
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#edit_details').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_eq_id').val(data.eq_id);
                        $('#edit_make').val(data.make);
                        $('#edit_serial').val(data.serial);
                        $('#edit_model').val(data.model);
                        $('#edit_accessories').val(data.accessories);
                        $('#edit_visualinspection').val(data.visual_inspection);
                        //Populating Form Data to Edit Ends
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");},
                });
            });
            $("#edit_details_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {

                        if(!data.errors)
                        {
                            $('#edit_details').modal('toggle');
                            swal('success',data.success,'success').then((value) => {
                                location.reload();
                            });

                        }
                    },
                    error:  function(xhr, status, error)
                    {
                        var error;
                        error=null;
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    },
                });
            }));
        });
    </script>

    @foreach($sitejobs as $sitejob)
        <div class="col-md-4 col-12 mt-1">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-id="{{$sitejob->id}}" data-type="lab" class="btn btn-light border btn-sm scan"><i class="fa fa-search"></i></a>
                    @can('create-site-task-assign')
                    <button type="button" data-id="{{$sitejob->id}}" class="btn btn-sm btn-light border pull-right assign-site-task"><i class="fa fa-plus-square"></i> Assign</button>
                    @endcan
                    @can('site-item-receiving-update')
                    @if($sitejob->status>0)
                        <a href="#" data-id="{{$sitejob->id}}" class="btn edit btn-light border btn-sm"><i class="fa fa-edit"></i> Receiving</a>
                    @endif
                    @endcan
                </div>
                <div class="card-body">
                    <p class="m-0">↪ <b>Parameter : </b>{{\App\Models\Parameter::find($sitejob->item->parameter)->name}}</p>
                    <p class="m-0">↪ <b>Capability : </b>{{\App\Models\Capabilities::find($sitejob->item->capability)->name}}</p>
                    <p class="m-0">↪ <b>Range : </b>{{$sitejob->item->range}}</p>
                    <p class="m-0">↪ <b>Accredited : </b>{{$sitejob->item->accredited}}</p>
                    <p class="m-0">↪ <b>Status : </b>
                        @if($sitejob->status==0)
                            <span class="badge badge-primary">Pending</span>
                        @elseif($sitejob->status==1)
                            <span class="badge badge-success">Assigned</span>
                        @elseif($sitejob->status==2)
                            <span class="badge badge-danger">Checked-in</span>
                        @elseif($sitejob->status==3)
                            <span class="badge badge-success">Started</span>
                        @elseif($sitejob->status==4)
                            <span class="badge badge-success">Calculated</span>
                        @elseif($sitejob->status==5)
                            <span class="badge badge-success">Ended</span>
                        @endif
                    </p>
                    @if($sitejob->status<1)
                        <span class="badge badge-info px-3 py-2 m-1">Waiting for store entry</span>
                    @else
                        <p class="m-0">↪ <b>Equipment ID : </b>{{$sitejob->eq_id}}</p>
                        <p class="m-0">↪ <b>Serial : </b>{{$sitejob->serial}}</p>
                        <p class="m-0">↪ <b>Make : </b>{{$sitejob->make}}</p>
                        <p class="m-0">↪ <b>Model : </b>{{$sitejob->model}}</p>
                        <p class="m-0">↪ <b>Accessories : </b>{{$sitejob->accessories}}</p>
                        <p class="m-0">↪ <b>Visual Inspection : </b>{{$sitejob->eq_id}}</p>
                    @endif


                    @if($sitejob->status<2)
                        <span class="badge badge-info px-3 py-2 m-1">Not Assigned yet</span>
                    @else
                        <p class="m-0">↪ <b>Start : </b>{{$sitejob->start}}</p>
                        <p class="m-0">↪ <b>End : </b>{{$sitejob->end}}</p>
                        <p class="m-0">↪ <b>Assign User : </b>
                            @if($sitejob->assign_user)
                                {{\App\Models\User::find($sitejob->assign_user)->fname}}{{\App\Models\User::find($sitejob->assign_user)->lname}}
                            @endif
                        </p>
                        <p class="m-0">↪ <b>Assign Asset : </b>
                            <br>
                            @if($sitejob->assign_assets)
                                @php $assets=explode(',',$sitejob->assign_assets); @endphp
                                @foreach($assets as $asset)
                                    <span class="badge badge-info py-1 px-2">{{\App\Models\Asset::find($asset)->name}}</span>
                                @endforeach
                            @endif

                        </p>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-refresh-cw"></i> Update Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_details_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="" id="edit_id" name="id">
                            <div class="form-group col-12  float-left">
                                <label for="edit_eq_id">Equipment ID</label>
                                <input type="text" class="form-control" id="edit_eq_id" name="eq_id" placeholder="Equipment ID" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="serial">Serial #</label>
                                <input type="text" class="form-control" id="edit_serial" name="serial" placeholder="Serial #" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_model">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" placeholder="Model" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="edit_make" name="make" placeholder="make" autocomplete="off" value="">
                            </div>


                            <div class="form-group col-12  float-left">
                                <label for="edit_accessories">Accessories</label>
                                <input type="text" class="form-control" id="edit_accessories" name="accessories" placeholder="Accessories" autocomplete="off" value="">
                            </div>
                            <div class="form-group col-12  float-left">
                                <label for="edit_visualinspection">Visual Inspection</label>
                                <input type="text" class="form-control" id="edit_visualinspection" name="visualinspection" placeholder="Visual Inspection" autocomplete="off" value="">
                            </div>


                            <div class="col-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="assign-site-task" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Assign Site Task</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="assign_lab_task" method="post">
                        @csrf
                        <input type="hidden" value="" name="id" id="site_task_id">
                        @php $today=date('Y-m-d',time()); @endphp

                        <div class="form-group row">
                            <label for="user" class="col-12 control-label">Select User</label>
                            <div class="col-12">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control select-2-users" id="user" name="user"  style="width: 100%">
                                        <option selected disabled>--Select User</option>
                                        @foreach(\App\Models\User::whereIn('id',explode(',',$site->assigned_users))->get() as $user)
                                            <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assets" class="col-12 control-label">Select Assets</label>
                            <div class="col-12">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <select class="form-control select-2-asset" multiple id="assets" name="assets[]" style="width: 100%">
                                        <option disabled>Select Assets</option>
                                        @foreach(\App\Models\Asset::whereIn('id',explode(',',$site->assigned_assets))->get() as $asset)
                                            <option style="font-size: 11px" value="{{$asset->id}}">{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn lab-items-save-btn btn-primary btn-sm float-right"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var parameter = $(this).val();
                if(parameter) {
                    $.ajax({
                        url: '{{url('scheduling/tasks/respective-assets')}}/'+parameter,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="optassets[]"]').empty();
                            $.each(data, function(index, value) {
                                $('select[name="optassets[]"]').append('<option value="'+ value.id +'">'+ value.code +'-'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="optassets[]"]').empty();
                }
            });




            $("#assign_lab_task").on('submit', (function (e) {
                e.preventDefault();
                var button = $('.lab-items-save-btn');
                var previous = $('.lab-items-save-btn').html();
                button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
                $.ajax({
                    url: '{{route('tasks.store')}}',
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        button.attr('disabled', null).html(previous);
                        swal('success', data.success, 'success').then((value) => {
                            $('#assign-lab-task').modal('hide');
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

@endsection