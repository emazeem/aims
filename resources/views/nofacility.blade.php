@extends('layouts.master')
@section('content')
    <script src="{{url('/assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light"><i class="feather icon-alert-circle"></i> No Facility Items</h3>
            @can('no-facility-add')
                <button type="button" class="btn btn-sm btn-primary shadow-sm float-right mt-2" data-toggle="modal" data-target="#add_no_facility"><i class="feather icon-plus-circle"></i> Add No Facility</button>
            @endcan
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Parameter</th>
                    <th>Item (No facility)</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>Customer</th>
                    <th>Parameter</th>
                    <th>Item (No facility)</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>

        function InitTable() {

            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('no.facility.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "customer"},
                    {"data": "parameter"},
                    {"data": "item"},
                    {"data": "qty"},
                    {"data": "action"},
                ]
            });

        }

        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this no facility?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#form" + id).attr("method");
                        var form_data = $("#form" + id).serialize();

                        $.ajax({
                            url: "{{route('no.facility.destroy')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    $("#example").DataTable().ajax.reload(null, false);
                                });

                            },
                            error: function (xhr) {
                                var error='';
                                $.each(xhr.responseJSON.errors, function (key, item) {
                                    error+=item;
                                });
                                swal("Failed", error, "error");
                            },
                        });
                    }
                });
            });
            $("#add_no_facility_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$('.no-facility-save-btn');
                var previous=$('.no-facility-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                $.ajax({
                    url: "{{route('no.facility.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            $('#add_no_facility').modal('hide');
                            InitTable();
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
    <div class="modal fade" id="add_no_facility" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-light" id="exampleModalCenterTitle"><i class="feather icon-plus-circle"></i> Add No Facility Items</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_no_facility_form">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <label for="customer"></label>
                                    <select class="form-control" id="customer" name="customer">
                                        <option selected disabled>--Select Customers</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check form-check-inline" style="width: 100%">
                                    <label for="parameter"></label>
                                    <select class="form-control" id="parameter" name="parameter">
                                        <option selected disabled>--Select Parameter</option>
                                        @foreach($parameters as $parameter)
                                            <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12 mb-1">
                                <input type="text" class="form-control" id="capability" name="capability" placeholder="Type Capability" autocomplete="off" value="{{old('capability')}}">
                            </div>
                            <div class="form-group col-12">
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Quantity" autocomplete="off" value="{{old('qty')}}">
                            </div>

                        </div>

                </div>
                <div class="modal-footer bg-light py-2 my-0">
                    <button class="btn btn-primary btn-sm no-facility-save-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


