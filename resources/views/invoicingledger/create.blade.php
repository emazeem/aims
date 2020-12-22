@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            $(document).ready(function () {
                swal("Error!", '{{Session('error')}}', "error");
            });
        </script>
    @endif

    <div class="row pb-3">

        <div class="col-12">
            <h3 class="border-bottom text-primary"><i class="fa fa-plus-circle"></i> Add Invoice Ledger Details</h3>
        </div>
        {{--<div class="row">
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Job # <span class="font-weight-light text-dark">{{$id}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Charges : <span class="font-weight-light text-dark">{{$service_charges}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Customer : <span class="font-weight-light text-dark">{{$job->quotes->customers->reg_name}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax Type : <span class="font-weight-light text-dark">{{$job->quotes->customers->region}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax : <span class="font-weight-light text-dark">{{$tax}} %</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Income Tax Percent : <span class="font-weight-light text-dark">3 %</span></h5>
        </div>
        --}}
        <div class="col-12">
            <form class="form-horizontal" action="{{route('invoicing_ledger.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                {{--<input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="customer" value="{{$job->quotes->customer_id}}">
                <input type="hidden" name="service_charges" value="{{$service_charges}}">
                <input type="hidden" name="service_tax_type" value="{{$job->quotes->customers->region}}">
                <input type="hidden" name="service_tax_percent" value="{{$tax}}">
                <input type="hidden" name="income_tax_percent" value="3">
                --}}
                {{--New--}}

                <div class="form-group row">
                    <label for="customers" class="col-sm-3 control-label">Customers</label>
                    <select class="form-control col-md-9" id="tax_deducted_by" name="customers">
                        <option selected disabled>Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('customers'))
                        <span class="text-danger"><strong>{{ $errors->first('customers') }}</strong></span>
                    @endif
                </div>
                {{--New--}}
                <div class="form-group  row">
                    <label for="service_charges" class="col-sm-3 control-label">Service Charges</label>
                    <input type="text" class="form-control col-md-9" id="service_charges" name="service_charges"
                           placeholder="Service Charges" autocomplete="off" value="{{old('service_charges')}}">
                    @if ($errors->has('service_charges'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('service_charges') }}</strong>
                      </span>
                    @endif
                </div>
                {{--New--}}
                <div class="form-group row">
                    <label for="service_tax_type" class="col-sm-3 control-label">Service Tax Type</label>
                    <select class="form-control col-md-9" id="service_tax_type" name="service_tax_type">
                        <option selected disabled>Service Tax Type</option>
                        @foreach($service_taxes as $service_tax)
                            <option value="{{$service_tax->id}}">{{$service_tax->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('service_tax_type'))
                        <span class="text-danger"><strong>{{ $errors->first('service_tax_type') }}</strong></span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="tax_deducted_by" class="col-sm-3 control-label">Tax Deducted</label>
                    <select class="form-control col-md-9" id="tax_deducted_by" name="tax_deducted_by">
                        <option selected disabled>Deducted by</option>
                        <option value="0">Income Tax by AIMS + Service Tax by AIMS</option>
                        <option value="1">Income Tax at Source + Service Tax at Source</option>
                        <option value="2">Income Tax at Source + Service Tax by AIMS</option>
                    </select>
                    @if ($errors->has('tax_deducted_by'))
                        <span class="text-danger"><strong>{{ $errors->first('tax_deducted_by') }}</strong></span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="job" class="col-sm-3 control-label">Job #</label>

                    <input type="text" class="form-control col-md-9" id="job" name="job" autocomplete="off" value="{{old('job')}}" placeholder="Job #">
                    @if ($errors->has('job'))
                        <span class="text-danger"><strong>{{ $errors->first('job') }}</strong></span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="invoice_no" class="col-sm-3 control-label">Invoice No</label>

                    <input type="text" class="form-control col-md-9" id="invoice_no" name="invoice_no" autocomplete="off" value="{{old('invoice_no')}}" placeholder="Invoice No">
                    @if ($errors->has('invoice_no'))
                        <span class="text-danger"><strong>{{ $errors->first('invoice_no') }}</strong></span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="created_on" class="col-sm-3 control-label">Invoice Date</label>

                    <input type="date" class="form-control col-md-9" id="created_on" name="created_on" autocomplete="off" value="{{old('created_on')}}">
                    @if ($errors->has('created_on'))
                        <span class="text-danger"><strong>{{ $errors->first('created_on') }}</strong></span>
                    @endif
                </div>
                <div class="form-group  row">
                    <label for="confirmed_by_name" class="col-sm-3 control-label">Confirmed by : Name</label>
                    <input type="text" class="form-control col-md-9" id="confirmed_by_name" name="confirmed_by_name"
                           placeholder="Name" autocomplete="off" value="{{old('confirmed_by_name')}}">
                    @if ($errors->has('confirmed_by_name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_name') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="confirmed_by_phone" class="col-sm-3 control-label">Confirmed By : Phone</label>

                    <input type="text" class="form-control col-md-9" id="confirmed_by_phone" name="confirmed_by_phone"
                           placeholder="Phone" autocomplete="off" value="{{old('confirmed_by_phone')}}">
                    @if ($errors->has('confirmed_by_phone'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_phone') }}</strong>
                      </span>
                    @endif
                </div>

                {{--<div class="form-group  row">
                    <label for="confirmed_by_name" class="col-sm-3 control-label">Confirmed by : Name</label>
                    <input type="text" class="form-control col-md-9" id="confirmed_by_name" name="confirmed_by_name"
                           placeholder="Name" autocomplete="off" value="{{old('confirmed_by_name')}}">
                    @if ($errors->has('confirmed_by_name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_name') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="confirmed_by_phone" class="col-sm-3 control-label">Confirmed By : Phone</label>

                    <input type="text" class="form-control col-md-9" id="confirmed_by_phone" name="confirmed_by_phone"
                           placeholder="Phone" autocomplete="off" value="{{old('confirmed_by_phone')}}">
                    @if ($errors->has('confirmed_by_phone'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_phone') }}</strong>
                      </span>
                    @endif
                </div>
                --}}
                {{--<div class="form-group row">
                    <label for="acc_name" class="col-sm-3 control-label">Account Name</label>
                    <input type="text" class="form-control col-md-9" id="acc_name" name="acc_name" placeholder="Name"
                           autocomplete="off" value="{{old('acc_name',$customer->acc_name)}}">
                    @if ($errors->has('acc_name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('acc_name') }}</strong>
                      </span>
                    @endif
                </div>
                @php
                $phones=explode('-',$customer->acc_phone);

                @endphp
                <div class="form-group row">
                    <label for="acc_phone_1" class="col-sm-3 control-label">Account Phone 1</label>
                    <input type="text" class="form-control col-md-9" id="acc_phone_1" name="acc_phone_1" placeholder="Phone" autocomplete="off" value="{{old('acc_phone_1',$phones[0])}}">
                    @if ($errors->has('acc_phone_1'))
                        <span class="text-danger"><strong>{{ $errors->first('acc_phone_1') }}</strong></span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="acc_phone_2" class="col-sm-3 control-label">Account Phone 2 (opt.)</label>
                    <input type="text" class="form-control col-md-9" id="acc_phone_2" name="acc_phone_2" placeholder="Phone (opt.)" autocomplete="off" value="{{old('acc_phone_2',($customer->acc_phone)?$phones[0]:"")}}">
                    @if ($errors->has('acc_phone_2'))
                        <span class="text-danger"><strong>{{ $errors->first('acc_phone_2') }}</strong></span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="acc_email" class="col-sm-3 control-label">Account Email</label>
                    <input type="text" class="form-control col-md-9" id="acc_email" name="acc_email" placeholder="Email" autocomplete="off" value="{{old('acc_email',$customer->acc_email)}}">
                    @if ($errors->has('acc_email'))
                        <span class="text-danger"><strong>{{ $errors->first('acc_email') }}</strong></span>
                    @endif
                </div>--}}
                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </form>
        </div>

    </div>
@endsection

