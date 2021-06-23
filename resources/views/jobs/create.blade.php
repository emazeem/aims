<div class="col-12">
    <h4 class="float-left font-weight-light"><i class="feather icon-plus-circle"></i> Quote Items</h4>
    <a class="btn float-right btn-sm btn-primary assign-site-btn mt-2 shadow-sm"
       style="display: none" href><i class="feather icon-plus-circle"></i> Assign</a>

</div>
<div class="col-12 table-responsive">

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
            @if($item->status!=3)
                <tr>
                    <td>
                        @if(!in_array($item->id,$assigned_items))
                            <label class="form-check-label"
                                   for="{{$item->id}}">{{$item->capabilities->name}}</label>
                        @else
                            <label class="form-check-label"
                                   for="{{$item->id}}">{{$item->capabilities->name}}</label>
                        @endif
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
                        @if($item->location=='lab')
                        @if($item->quantity > $jobitems)
                            @can('lab-item-receiving-store')
                            <a href="#" title="Store Entry" data-id="{{$item->id}}" data-target="{{$job->id}}" class="btn add btn-light border btn-sm"><i class="feather icon-plus"></i></a>
                                @endcan
                            @endif
                        @else
                            <div class='checkbox checkbox-fill d-inline'>
                                <input type='checkbox' data-id='{{$item->id}}' name='action[]' class='actions' id='actions{{$item->id}}'>
                                <label class='cr' for='actions{{$item->id}}'></label>
                            </div>

                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.actions', function (e) {
            var val = [];
            $('.actions:checked').each(function (i) {
                val[i] = $(this).attr('data-id');
            });
            console.log(val.length);
            if (val.length == 0) {
                $('.assign-site-btn').css('display', 'none');
            } else {
                $('.assign-site-btn').css('display', 'block');
            }
        });
        $(document).on('click', '.assign-site-btn', function (e) {
            e.preventDefault();
            var val = [];
            $('.actions:checked').each(function (i) {
                val[i] = $(this).attr('data-id');
            });
            console.log(val);
            window.location.href = '{{url('tasks/assign_site/'.$job->id)}}/' + val;
        });

        $(document).on('click', '.add', function () {
            var id = $(this).attr('data-id');
            var job = $(this).attr('data-target');
            $('#add_id').val(id);
            $('#add_job').val(job);
            $('#add_details').modal('toggle');
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('item/entries/edit/')}}/"+id,
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
        $("#add_delivery_note_form").on('submit',(function(e) {
            e.preventDefault();
            alert(1);
            var button=$('#delivery-note-add-btn');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $.ajax({
                url: "{{route('delivery_note.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_delivery_note').modal('hide');
                        location.reload();
                    });

                },
                error: function(xhr)
                {
                    button.attr('disabled',null).html(previous);
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
    });
</script>
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




                    </div>

            </div>
            <div class="modal-footer">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>



