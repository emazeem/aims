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
        <div class="col-12 d-sm-flex align-items-center justify-content-between">
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Receipt Voucher</h3>
        </div>

        <div class="col-12 mb-5">
            <form id="add_voucher_form" class="row">
                @csrf
                <div class="form-group col-6">
                    <label for="business_line" class="control-label">Select Business Line</label>
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
                <div class="form-group col-6">
                    <label for="v_date" class="control-label">Date of Voucher</label>
                    <input type="date" class="form-control" id="v_date" name="v_date" value="{{old('v_date',date('Y-m-d'))}}">
                    @if ($errors->has('v_date'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('v_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="attachments" class="control-label">Attachments</label>
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

                <div class="col-12 ">
                    <h5>Customer Receivable (Cr.)</h5>
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
                    <table class="table table-bordered inv-table">
                        <thead>
                        <tr>
                            <th>NARRATION</th>
                            <th>A/C</th>
                            <th>Dr.</th>
                            <th>Cr.</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
                </div>
                <div class="col-12 payment-type-accounts">
                    <h5>Bank / Cash (Dr.)</h5>
                    <div class="form-group row">
                        <label for="payment_type" class="col-2 control-label">Select Payment Type</label>
                        <div class="col-10">
                            <select class="form-control" id="payment_type" name="payment_type" >
                                <option value="" selected disabled>Select Payment Type</option>
                                <option value="cash">CASH</option>
                                <option value="bank">BANK</option>
                            </select>
                            @if ($errors->has('payment_type'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payment_type') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_acc" class="col-2 control-label">Select Payment Acc</label>
                        <div class="col-10">
                            <select class="form-control" id="payment_acc" name="payment_acc" >
                                <option value="" selected disabled>Select Payment Acc.</option>
                            </select>
                            @if ($errors->has('payment_acc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payment_acc') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_charges" class="col-2 control-label">Payment Charges</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="payment_charges" name="payment_charges" placeholder="Payment Charges" value="{{old('payment_charges')}}">
                            @if ($errors->has('payment_charges'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payment_charges') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_narration" class="col-2 control-label">Payment Narration</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="payment_narration" name="payment_narration" placeholder="Payment Narration" value="{{old('payment_narration')}}">
                            @if ($errors->has('payment_narration'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payment_narration') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 service-tax-accounts">
                <h5>Service Tax (Dr.)</h5>
                    <div class="form-group row">
                        <label for="service_tax_acc" class="col-2 control-label">Income Tax Acc</label>
                        <div class="col-10">
                            <select class="form-control" id="service_tax_acc" name="service_tax_acc" >
                                <option value="" selected disabled>Select Income Tax Acc</option>
                                @foreach($servicetaxes as $incometax)
                                    <option value="{{$incometax->acc_code}}" selected>{{$incometax->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('service_tax_acc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('service_tax_acc') }}</strong>
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
                </div>
                <div class="col-12 advance-income-tax-accounts">
                <h5>Advance - Income Tax (Dr.)</h5>
                    <div class="form-group row">
                        <label for="adv_income_tax_acc" class="col-2 control-label">Advance Income Tax Acc</label>
                        <div class="col-10">
                            <select class="form-control" id="adv_income_tax_acc" name="adv_income_tax_acc">
                                <option value="" selected disabled>Select Income Tax Acc</option>
                                @foreach($incometaxes as $incometax)
                                    <option value="{{$incometax->acc_code}}" selected>{{$incometax->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('adv_income_tax_acc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('adv_income_tax_acc') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adv_income_tax_charges" class="col-2 control-label">Income Tax Charges</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="adv_income_tax_charges" name="adv_income_tax_charges" placeholder="Income Tax Charges" value="{{old('adv_income_tax_charges')}}">
                            @if ($errors->has('adv_income_tax_charges'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('adv_income_tax_charges') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adv_income_tax_narration" class="col-2 control-label">Income Tax Narration</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="adv_income_tax_narration" name="adv_income_tax_narration" placeholder="Income Tax Narration" value="{{old('adv_income_tax_narration')}}">
                            @if ($errors->has('adv_income_tax_narration'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('adv_income_tax_narration') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 liability-income-tax-accounts">
                    <h5>Liability - Income Tax (Cr.)</h5>
                    <div class="form-group row">
                        <label for="payable_income_tax_acc" class="col-2 control-label">Income Tax Acc</label>
                        <div class="col-10">
                            <select class="form-control" id="payable_income_tax_acc" name="payable_income_tax_acc" >
                                <option value="" selected disabled>Select Income Tax Acc</option>
                                @foreach($liability_incometaxes as $incometax)
                                    <option value="{{$incometax->acc_code}}" selected>{{$incometax->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('payable_income_tax_acc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payable_income_tax_acc') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payable_income_tax_charges" class="col-2 control-label">Income Tax Charges</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="payable_income_tax_charges" name="payable_income_tax_charges" placeholder="Income Tax Charges" value="{{old('payable_income_tax_charges')}}">
                            @if ($errors->has('payable_income_tax_charges'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payable_income_tax_charges') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payable_income_tax_narration" class="col-2 control-label">Income Tax Narration</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="payable_income_tax_narration" name="payable_income_tax_narration" placeholder="Income Tax Narration" value="{{old('payable_income_tax_narration')}}">
                            @if ($errors->has('payable_income_tax_narration'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('payable_income_tax_narration') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>

                </div>
            </form>
        </div>
    </div>
    <div class="row bg-white p-3 mb-3">
        <div class="col-3">
            <h4 class="m-0">Example :</h4>
            <p class='m-0'>Service Charges: 100 PKR</p>
            <p class='m-0'>Service Tax (%): 16</p>
            <p class='m-0'>Total Receivable : 116</p>
            <p class='m-0'>Income Tax (%): 3%</p>
            <p class='m-0'>Income Tax (PKR): 3.48</p>
        </div>
        <div class="col-3">
            <p class="m-0 font-weight-bold">CASE:1 </p>
            <p class="m-0 font-weight-bold">Income Tax and Service Tax by AIMS</p>
            <p class="m-0">Bank / Cash A/C : 116 Dr.</p>
            <p class="m-0">Customer A/C : 116 Cr.</p>
            <p class="m-0">Advance IT 3% : 3.48 Dr.</p>
            <p class="m-0">Income Tax 3% By AIMS : 3.48 Cr.</p>
        </div>
        <div class="col-3">
            <p class="m-0 font-weight-bold">CASE:2 </p>
            <p class="m-0 font-weight-bold">Income Tax and Service Tax at Source</p>
            <p class="m-0">Bank / Cash A/C : 96.52 (116-16-3.48) Dr.</p>
            <p class="m-0">Customer A/C : 116 Cr.</p>
            <p class="m-0">Advance IT 3% : 3.48 Dr.</p>
            <p class="m-0">PRA 16% : 16 Dr.</p>
        </div>
        <div class="col-3">
            <p class="m-0 font-weight-bold">CASE:3 </p>
            <p class="m-0 font-weight-bold">Income Tax at SOURCE and Service Tax by AIMS</p>
            <p class="m-0">Bank / Cash A/C : 112.52 (116-3.48) Dr.</p>
            <p class="m-0">Customer A/C : 116 Cr.</p>
            <p class="m-0">Advance IT 3% : 3.48 Dr.</p>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.service-tax-accounts').hide();
            $('.advance-income-tax-accounts').hide();
            $('.liability-income-tax-accounts').hide();

            $('select[name="customer_acc"]').on('change', function() {
                var customer = $(this).val();
                if(customer) {
                    $.ajax({
                        url: '/receipt-voucher/get-inv/'+customer,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="customer_inv"]').empty();

                            $('select[name="customer_inv"]').append('<option disabled selected>Select Customer Invoices</option>');
                            $.each(data['invoices'], function(key, value) {
                                $('select[name="customer_inv"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                            });
                            var type = data['case'];
                            if (type=='1'){
                                $('.service-tax-accounts').hide();
                                $('.advance-income-tax-accounts').show();
                                $('.liability-income-tax-accounts').show();
                            }
                            if (type=='2'){
                                $('.service-tax-accounts').show();
                                $('.advance-income-tax-accounts').show();
                                $('.liability-income-tax-accounts').hide();
                            }
                            if (type=='3'){
                                $('.service-tax-accounts').hide();
                                $('.advance-income-tax-accounts').show();
                                $('.liability-income-tax-accounts').hide();
                            }
                        }
                    });
                }else{
                    $('select[name="customer_inv"]').empty();
                }
            });
            $('select[name="customer_inv"]').on('change', function() {
                var inv = $(this).val();
                if(inv) {
                    $.ajax({
                        url: '/receipt-voucher/get-inv-details/'+inv,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $.each(data,function(index,item){
                                $('.inv-table tbody').append(
                                    "<tr>" +
                                    "<td>" + item.narration + "</td>" +
                                    "<td>" + item.acc_code + "</td>"+
                                    "<td>" + item.dr + "</td>" +
                                    "<td>" + item.cr + "</td></tr>"
                                );
                            });
                        }
                    });
                }else{
                    $('.inv-table tbody').empty();
                }
            });
            $('select[name="payment_type"]').on('change', function() {
                var payment_type = $(this).val();
                if(payment_type) {
                    $.ajax({
                        url: '/receipt-voucher/get-payments-acc/'+payment_type,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="payment_acc"]').empty();

                            $('select[name="payment_acc"]').append('<option disabled selected>Select Payment Acc.</option>');
                            $.each(data, function(key, value) {
                                $('select[name="payment_acc"]').append('<option value="'+ value.acc_code +'">'+ value.title +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="payment_acc"]').empty();
                }
            });

            $("#add_voucher_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('sales.receipt.vouchers.store')}}",
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
        });
    </script>

@endsection
