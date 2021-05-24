{{--
@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif

    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Add Sales Voucher</h3>
        </div>
        <div class="col-12">
            <form id="add_voucher_form">
                @csrf
                <div class="form-group row">
                    <label for="business_line" class="col-2 control-label">Select Business Line</label>
                    <div class="col-10">
                        <select class="form-control" id="business_line" name="business_line" >
                            <option value="" selected disabled>Select Business Line</option>
                            @foreach($blines as $bline)
                                <option value="{{$bline->id}}" {{$bline->id==1?'selected':''}}>{{$bline->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('business_line'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('business_line') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_type" class="col-2 control-label">Select Voucher Type</label>
                    <div class="col-10">
                        <select class="form-control" id="v_type" name="v_type" >
                            <option value="" selected disabled>Select Voucher Type</option>
                            <option value="sales">Sales Voucher</option>
                        </select>
                        @if ($errors->has('v_type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_date" class="col-2 control-label">Date of Voucher</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="v_date" name="v_date" value="{{old('v_date',date('Y-m-d'))}}">
                        @if ($errors->has('v_date'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tax_deducted_by" class="col-sm-2 control-label">Tax Deducted</label>
                    <div class="col-10">
                        <select class="form-control" id="tax_deducted_by" name="tax_deducted_by">
                            <option selected disabled>Deducted by</option>
                            <option value="0">Income Tax by AIMS + Service Tax by AIMS</option>
                            <option value="1">Income Tax at Source + Service Tax at Source</option>
                            <option value="2">Income Tax at Source + Service Tax by AIMS</option>
                        </select>
                        @if ($errors->has('tax_deducted_by'))
                            <span class="text-danger"><strong>{{ $errors->first('tax_deducted_by') }}</strong></span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="attachments" class="col-sm-8 control-label">Attachments</label>
                    <div class="col-sm-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="attachments[]" multiple id="attachments">
                            <label class="custom-file-label" for="attachments">Attachments (opt)</label>
                        </div>
                        @if ($errors->has('attachments'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('attachments') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <h5>Customer Receivable (Dr./Cr.)</h5>
                <div class="form-group row">
                    <label for="customer_acc" class="col-2 control-label">Customer Account</label>
                    <div class="col-10">
                        <select class="form-control" id="customer_acc" name="customer_acc" >
                            <option value="" selected disabled>Select Customer Acc</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->acc_code}}">{{$customer->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('customer_acc'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('customer_acc') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_inv" class="col-2 control-label">Customer Invoices</label>
                    <div class="col-10">
                        <select class="form-control" id="customer_inv" name="customer_inv" >
                            <option value="" selected disabled>Select Customer Invoices</option>
                        </select>
                        @if ($errors->has('customer_inv'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('customer_inv') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="customer_charge" class="col-2 control-label">Customer Charge</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="customer_charge" name="customer_charge" placeholder="Customer Charges" value="{{old('customer_charge')}}">
                        @if ($errors->has('customer_charge'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('customer_charge') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_narration" class="col-2 control-label">Customer Narration</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="customer_narration" name="customer_narration" placeholder="Customer Narration" value="{{old('customer_narration')}}">
                        @if ($errors->has('customer_narration'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('customer_narration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <h5>Services Tax Receivable (Dr./Cr.)</h5>
                <div class="form-group row">
                    <label for="services_tax" class="col-2 control-label">Services Tax</label>
                    <div class="col-10">
                        <select class="form-control" id="services_tax" name="services_tax" disabled>
                            <option value="" selected disabled>Select Services Tax</option>
                            @foreach($servicetaxes as $servicetax)
                                <option value="{{$servicetax->id}}">{{$servicetax->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('services_tax'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('services_tax') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="service_tax_charges" class="col-2 control-label">Service Tax Charges</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="service_tax_charges" name="service_tax_charges" placeholder="Service Tax Charges" value="{{old('service_tax_charges')}}">
                        @if ($errors->has('service_tax_charges'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('service_tax_charges') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_tax_narration" class="col-2 control-label">Service Tax Narration</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="service_tax_narration" name="service_tax_narration" placeholder="Service Tax Narration" value="{{old('service_tax_narration')}}">
                        @if ($errors->has('service_tax_narration'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('service_tax_narration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <h5>Income Tax (Dr./Cr.)</h5>
                <div class="form-group row">
                    <label for="income_tax_acc" class="col-2 control-label">Income Tax Acc</label>
                    <div class="col-10">
                        <select class="form-control" id="income_tax_acc" name="income_tax_acc" disabled>
                            <option value="" selected disabled>Select Income Tax Acc</option>
                            @foreach($incometaxes as $incometax)
                                <option value="{{$incometax->id}}" selected>{{$incometax->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('income_tax_acc'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('income_tax_acc') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="income_tax_charges" class="col-2 control-label">Income Tax Charges</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="income_tax_charges" name="income_tax_charges" placeholder="Income Tax Charges" value="{{old('income_tax_charges')}}">
                        @if ($errors->has('income_tax_charges'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('income_tax_charges') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="income_tax_narration" class="col-2 control-label">Income Tax Narration</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="income_tax_narration" name="income_tax_narration" placeholder="Income Tax Narration" value="{{old('income_tax_narration')}}">
                        @if ($errors->has('income_tax_narration'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('income_tax_narration') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="customer_acc"]').on('change', function() {
                var customer = $(this).val();
                if(customer) {
                    $.ajax({
                        url: '/sales-voucher/get-inv/'+customer,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="customer_inv"]').empty();

                            $('select[name="customer_inv"]').append('<option disabled selected>Select Customer Invoices</option>');
                            $.each(data, function(key, value) {
                                $('select[name="customer_inv"]').append('<option value="'+ value.id +'">INV # '+ value.id +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="customer_inv"]').empty();
                }
            });
        });
    </script>

@endsection
--}}
@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif

    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h3><i class="fa fa-dollar"></i> X Sales Invoice</h3>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Quote ID</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Quote ID</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Status</th>
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
                "order": [[0, 'desc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('sales.invoice.create.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "quote"},
                    {"data": "customer"},
                    {"data": "type"},
                    {"data": "status"},
                    {"data": "options", "orderable": false},
                ]
            });
        }
        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.invoice-store', function (e) {
                swal({
                    title: "Are you sure to generate its Invoice?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token = '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = 'POST';
                            var form_data = $("#form" + id).serialize();

                            $.ajax({
                                url: "{{route('sales.invoice.create.fetch')}}",
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
        });
    </script>
@endsection
