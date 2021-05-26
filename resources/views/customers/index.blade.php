@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left pb-1"><i class="fa fa-users"></i> Customers</h3>
            <a href class="btn btn-sm add btn-primary shadow-sm pull-right mt-2"><i
                        class="fa fa-plus-circle"></i> Customer</a>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover display nowrap" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Registered Name</th>
                    <th>Principal Name</th>
                    <th>Principal Phone</th>
                    <th>Acc Code</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Registered Name</th>
                    <th>Principal Name</th>
                    <th>Principal Phone</th>
                    <th>Acc Code</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>




    <script>
        function InitTable() {
            $(".loading").fadeIn();
            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('customers.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "prin_name"},
                    {"data": "prin_phone"},
                    {"data": "acc_code"},
                    {"data": "options", "orderable": false},
                ]

            });
        }

        $(document).ready(function () {
            InitTable();
            $('select[name="pay_type"]').on('change', function () {
                var type = $(this).val();
                if (type) {
                    $('select[name="pay_way"]').empty();
                    if (type == 'cash') {
                        $('select[name="pay_way"]').append('<option value="advance">Advance</option>');
                        $('select[name="pay_way"]').append('<option value="against delivery">Against Delivery</option>');
                    }
                    if (type == 'credit') {
                        $('select[name="pay_way"]').append('<option value="15 days" >15 days</option>');
                        $('select[name="pay_way"]').append('<option value="30 days">30 days</option>');
                        $('select[name="pay_way"]').append('<option value="60 days">60 days</option>');
                        $('select[name="pay_way"]').append('<option value="120 days">120 days</option>');
                    }
                    $.each(data, function (key, value) {

                    });
                } else {
                    $('select[name="pay_way"]').empty();
                }
            });

            $(document).on('click', '.add', function(e) {
                e.preventDefault();
                $('#add-customer-form')[0].reset();
                $('#add-customer').modal('show');
            });
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#add-customer-form')[0].reset();
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{url('/customers/edit')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#add-customer').modal('toggle');
                        $('#edit-id').val(data.id);
                        $('#name').val(data.reg_name);
                        $('#ntn').val(data.ntn);
                        $('#address').val(data.address);
                        $('#bill_to_address').val(data.bill_to_address);
                        $('#region').val(data.region);
                        $('#pay_type').val(data.customer_type);
                        $('#pay_way').append('<option value'+data.pay_terms+' selected>'+data.pay_terms+'</option>');
                        $('#tax_case').val(data.tax_case);
                        $('#principal-name-1').val(data.prin_name_1);
                        $('#principal-phone-1').val(data.prin_phone_1);
                        $('#principal-email-1').val(data.prin_email_1);
                        $('#principal-name-2').val(data.prin_name_2);
                        $('#principal-phone-2').val(data.prin_phone_2);
                        $('#principal-email-2').val(data.prin_email_2);
                        $('#principal-name-3').val(data.prin_name_3);
                        $('#principal-phone-3').val(data.prin_phone_3);
                        $('#principal-email-3').val(data.prin_email_3);
                        $('#purchase-name').val(data.pur_name);
                        $('#purchase-email').val(data.pur_email);
                        $('#purchase-phone-1').val(data.pur_phone_1);
                        $('#purchase-phone-2').val(data.pur_phone_2);

                        $('#account-name').val(data.acc_name);
                        $('#account-email').val(data.acc_email);
                        $('#account-phone-1').val(data.acc_phone_1);
                        $('#account-phone-2').val(data.acc_phone_2);
                    }
                });
            });
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this customer?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#form" + id).attr("method");
                            var form_data = $("#form" + id).serialize();

                            $.ajax({
                                url: "{{route('customers.destroy')}}",
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function () {
                                        swal("Failed", "Permission denied.", "error");
                                        return false;
                                    }
                                },
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

            $("#add-customer-form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('customers.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        swal('success',data.success,'success').then((value) => {
                            $('#add-customer').modal('hide');
                            InitTable();
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

            $(document).on('click', '.view-customer', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    "url": "{{route('customers.show')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    success: function(data)
                    {
                        $('#show-customer').modal('toggle');
                        $('.customer-show').empty();
                        $('.customer-show').append(
                            "<tr><td>Registration Name</td><td>" + data.reg_name + "</td></tr>"+
                            "<tr><td>NTN/FTN</td><td>" + data.ntn + "</td></tr>"+
                            "<tr><td>Ship to Address</td><td>" + data.address + "</td></tr>"+
                            "<tr><td>Bill to Address</td><td>" + data.bill_to_address + "</td></tr>"+
                            "<tr><td>Region</td><td>" + data.region + "</td></tr>"+
                            "<tr><td>Tax Case</td><td>" + data.tax_case + "</td></tr>"+
                            "<tr><td>Principal Name</td><td>" + data.prin_name + "</td></tr>"+
                            "<tr><td>Principal Email</td><td>" + data.prin_email + "</td></tr>"+
                            "<tr><td>Principal Phone</td><td>" + data.prin_email + "</td></tr>"
                        );
                        if (data.pur_name){
                            $('.customer-show').append(
                                "<tr><td>Purchase Name</td><td>" + data.pur_name + "</td></tr>"
                            );
                        }
                        if (data.pur_email){
                            $('.customer-show').append(
                                "<tr><td>Purchase Email</td><td>" + data.pur_email + "</td></tr>"
                            );
                        }
                        if (data.pur_phone){
                            $('.customer-show').append(
                                "<tr><td>Purchase Phone</td><td>" + data.pur_phone + "</td></tr>"
                            );
                        }

                        if (data.acc_name){
                            $('.customer-show').append(
                                "<tr><td>Account Name</td><td>" + data.acc_name + "</td></tr>"

                            );
                        }

                        if (data.acc_email){
                            $('.customer-show').append(
                                "<tr><td>Account Email</td><td>" + data.acc_email + "</td></tr>"
                            );
                        }

                        if (data.acc_phone){
                            $('.customer-show').append(
                                "<tr><td>Account Phone</td><td>" + data.acc_phone + "</td></tr>");
                        }

                    }
                });
            });
        });
    </script>
    <div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="add-customer" aria-hidden="true">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="add-customer"> <i class="fa fa-plus-circle"></i> Add Customer</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-customer-form" class="row">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="form-group m-0 col-4">
                            <label for="name" class="control-label">Registered Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Registered Name"
                                   autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="form-group m-0 col-4">
                            <label for="ntn" class="control-label">NTN / FTN</label>
                            <input type="text" class="form-control" id="ntn" name="ntn" placeholder="NTN / FTN"
                                   autocomplete="off" value="{{old('ntn')}}">
                        </div>
                        <div class="form-group m-0 col-4">
                            <label for="region" class="control-label">Select Region</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="region" name="region">
                                    <option selected disabled="">Select Region</option>
                                    @foreach($saletaxes as $saletax)
                                        <option value="{{$saletax->id}}">{{$saletax->name}}
                                            -{{$saletax->value}} %
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0 col-6">
                            <label for="address" class="control-label">Physical Address</label>
                            <textarea type="text" class="form-control" rows="2" id="address" name="address"
                                      placeholder="Physical Address" autocomplete="off">{{old('address')}}</textarea>
                        </div>
                        <div class="form-group m-0 col-6">
                            <label for="bill_to_address" class="control-label">Bill to Address</label>
                            <textarea type="text" class="form-control" rows="2" id="bill_to_address" name="bill_to_address"
                                      placeholder="Bill To Address" autocomplete="off">{{old('bill_to_address')}}</textarea>
                        </div>


                        <div class="form-group m-0 col-4">
                            <label for="pay_type" class="control-label">Payment Type</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="pay_type" name="pay_type">
                                    <option selected disabled="">Select Payment Type</option>
                                    <option value="cash" {{ (collect(old('pay_type'))->contains('cash')) ? 'selected':'' }} >
                                        Cash
                                    </option>
                                    <option value="credit" {{ (collect(old('pay_type'))->contains('credit')) ? 'selected':'' }}>
                                        Credit
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0 col-4">
                            <label for="pay_way" class="control-label">Payment Way</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="pay_way" name="pay_way">
                                    <option selected disabled="">Select Payment Way</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0 col-4">
                            <label for="tax_case" class="control-label">Tax Case</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="tax_case" name="tax_case">
                                    <option selected disabled="">Select Tax Case</option>
                                    <option value="1">Case-1 : Income Tax By AIMS + Service Tax By AIMS</option>
                                    <option value="2">Case-2 : Income Tax At SOURCE + Service Tax By SOURCE</option>
                                    <option value="3">Case-3 : Income Tax At SOURCE + Service Tax By AIMS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-name-1" name="prin_name[]"
                                       placeholder="Name" autocomplete="off" value="{{old('prin_name.0')}}">


                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-phone-1" name="prin_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('prin_phone.0')}}">

                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-email-1" name="prin_email[]"
                                       placeholder="Email" autocomplete="off" value="{{old('prin_email.0')}}">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-name-2" name="prin_name[]"
                                       placeholder="Name" autocomplete="off" value="{{old('prin_name.1')}}">
                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-phone-2" name="prin_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('prin_phone.1')}}">
                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-email-2" name="prin_email[]"
                                       placeholder="Email" autocomplete="off" value="{{old('prin_email.1')}}">
                            </div>


                        </div>
                        <div class="col-md-4 col-12">
                            <label for="principal" class="col-form-label">Principal Contact</label>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-name-3" name="prin_name[]"
                                       placeholder="Name" autocomplete="off" value="{{old('prin_name.2')}}">

                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-phone-3" name="prin_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('prin_phone.2')}}">
                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="principal-email-3" name="prin_email[]"
                                       placeholder="Email" autocomplete="off" value="{{old('prin_email.2')}}">

                            </div>
                        </div>
                        <div class="col-md-6 col-12 bg-white border ">
                            <label for="purchase" class="col-form-label">Purchase Contact</label>

                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="purchase-name" name="pur_name" placeholder="Name"
                                       autocomplete="off" value="{{old('pur_name')}}">

                            </div>

                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="purchase-phone-1" name="pur_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('pur_phone.0')}}">
                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="purchase-phone-2" name="pur_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('pur_phone.1')}}">
                            </div>


                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="purchase-email" name="pur_email"
                                       placeholder="Email" autocomplete="off" value="{{old('pur_email')}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12 bg-white border">
                            <label for="account" class="col-form-label">Accounts Payable</label>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="account-name" name="acc_name" placeholder="Name"
                                       autocomplete="off" value="{{old('acc_name')}}">
                            </div>

                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="account-phone-1" name="acc_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('acc_phone.0')}}">
                            </div>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="account-phone-2" name="acc_phone[]"
                                       placeholder="Phone" autocomplete="off" value="{{old('acc_phone.1')}}">
                            </div>

                            <div class="form-group m-0">
                                <input type="text" class="form-control" id="account-email" name="acc_email"
                                       placeholder="Email" autocomplete="off" value="{{old('acc_email')}}">
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-save"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-customer" tabindex="-1" role="dialog" aria-labelledby="show-customer" aria-hidden="true">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="show-customer"> <i class="fa fa-eye"></i> Show Customer</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table text-dark table-sm bg-white table-bordered table-responsive-sm table-hover font-13 customer-show">

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection