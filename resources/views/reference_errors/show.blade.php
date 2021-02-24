@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="card">
        <div class="card-body">
            <h3 class="pull-left"><i class="fa fa-eye"></i> Manage Reference Errors & Uncertainty</h3>
            <table class="table table-bordered table-sm table-hover">
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Assets</th>
                    <td>{{$show->assets->name}}</td>
                </tr>
            </table>
            @foreach($units as $unit)
                <h5 class="float-left text-danger">{{\App\Models\Unit::find($unit)->unit}}</h5>
            <table class="table table-bordered table-hover table-sm">
                <tr class="bg-light">
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                    @if($show->assets->parameter==13)
                        <th>Action</th>
                    @endif
                </tr>
                @foreach($multiples as $key=>$multiple)
                    @if($multiple->unit==$unit)
                    <tr>
                        <td>{{($multiple->channel)?$multiple->channel.' #  ':''}}  {{$multiple->uuc}} </td>
                        <td>{{$multiple->ref}}</td>
                        <td>{{$multiple->error}}</td>
                        <td>{{$multiple->uncertainty}}</td>
                        @if($show->assets->parameter==13)
                            <th>
                                @php $available=\App\Models\Massreference::where('parent_id',$multiple->id)->first(); @endphp
                                @if($available)
                                    <button type="button" class="btn btn-sm btn-success balance-details-edit" data-id="{{$available->id}}"><i class="fa fa-edit"></i></button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-primary balance-details" data-id="{{$multiple->id}}"><i class="fa fa-plus-circle"></i></button>
                                @endif
                            </th>
                        @endif
                    </tr>
                    @endif
                @endforeach
            </table>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="balance_details" tabindex="-1" role="dialog" aria-labelledby="balance_details" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="add_session"><i class="fa fa-plus-circle"></i> Add Balance Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <small><i class="fa fa-times-circle"></i></small>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_balance_details">
                        @csrf
                        <input type="hidden" value="" name="reference" id="reference">
                        <div class="row">
                            <div class="col-12">
                                <label for="density" class="p-0 m-0"><small>Density in kg/m<sup>3</sup></small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control" type="text" id="density" name="density" placeholder="Density">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="expanded_uncertainty" class="p-0 m-0"><small>Expanded Uncertainty kg/m<sup>3</sup></small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control" type="text" id="expanded_uncertainty" name="expanded_uncertainty" placeholder="Expanded Uncertainty">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="volume" class="p-0 m-0"><small>Volume in m<sup>3</sup> </small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                <input class="form-control" type="text" id="volume" name="volume" placeholder="Volume">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="gradient_temp" class="p-0 m-0"><small>Gradient Temperature </small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="1">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="2">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="3">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="5">
                                </div>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="7">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder='10'>
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="15">
                                    <input class="form-control col-3" type="text" id="gradient_temp" name="gradient_temp[]" placeholder="20">
                                </div>

                            </div>

                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-balance_details" tabindex="-1" role="dialog" aria-labelledby="balance_details" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="add_session"><i class="fa fa-refresh"></i> Edit Balance Details</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <small><i class="fa fa-close"></i></small>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_balance_details">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="row">
                            <div class="col-12">
                                <label for="density" class="p-0 m-0"><small>Density in kg/m<sup>3</sup></small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control" type="text" id="edit_density" name="density" placeholder="Density">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="expanded_uncertainty" class="p-0 m-0"><small>Expanded Uncertainty kg/m<sup>3</sup></small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control" type="text" id="edit_expanded_uncertainty" name="expanded_uncertainty" placeholder="Expanded Uncertainty">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="volume" class="p-0 m-0"><small>Volume in m<sup>3</sup> </small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                <input class="form-control" type="text" id="edit_volume" name="volume" placeholder="Volume">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="gradient_temp" class="p-0 m-0"><small>Gradient Temperature </small></label>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control col-3" type="text" id="gradient_temp1" name="gradient_temp[]" placeholder="1">
                                    <input class="form-control col-3" type="text" id="gradient_temp2" name="gradient_temp[]" placeholder="2">
                                    <input class="form-control col-3" type="text" id="gradient_temp3" name="gradient_temp[]" placeholder="3">
                                    <input class="form-control col-3" type="text" id="gradient_temp4" name="gradient_temp[]" placeholder="5">
                                </div>
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <input class="form-control col-3" type="text" id="gradient_temp5" name="gradient_temp[]" placeholder="7">
                                    <input class="form-control col-3" type="text" id="gradient_temp6" name="gradient_temp[]" placeholder='10'>
                                    <input class="form-control col-3" type="text" id="gradient_temp7" name="gradient_temp[]" placeholder="15">
                                    <input class="form-control col-3" type="text" id="gradient_temp8" name="gradient_temp[]" placeholder="20">
                                </div>

                            </div>

                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-save"></i> Update</button>
                </div>
                </form>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $(document).on('click', '.balance-details', function() {
                var id = $(this).attr('data-id');
                $('#balance_details').modal('show');
                $('#reference').val(id);
            });
            $("#add_balance_details").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('mass.reference.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
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
            }));
            $("#edit_balance_details").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('mass.reference.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
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
            }));
            $(document).on('click', '.balance-details-edit', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('mass-reference/edit')}}/"+id,
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
                        $('#edit-balance_details').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#edit_density').val(data.id);
                        $('#edit_expanded_uncertainty').val(data.expanded_uncertainty);
                        $('#edit_volume').val(data.volume);
                        $('#gradient_temp1').val(data['gradient_temp'][0]);
                        $('#gradient_temp2').val(data['gradient_temp'][1]);
                        $('#gradient_temp3').val(data['gradient_temp'][2]);
                        $('#gradient_temp4').val(data['gradient_temp'][3]);
                        $('#gradient_temp5').val(data['gradient_temp'][4]);
                        $('#gradient_temp6').val(data['gradient_temp'][5]);
                        $('#gradient_temp7').val(data['gradient_temp'][6]);
                        $('#gradient_temp8').val(data['gradient_temp'][7]);
                    },
                    error: function(){},
                });
            });

        });

    </script>
@endsection