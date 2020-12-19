@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12 ">
            <h3 class="border-bottom text-primary"><i class="fa fa-refresh"></i> Edit Invoice Ledger Details</h3>
        </div>

        <div class="row">
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">
                Job # <span class="font-weight-light text-dark">{{$id}}</span>
            </h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Charges : <span class="font-weight-light text-dark">{{$service_charges}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Customer : <span class="font-weight-light text-dark">{{$job->quotes->customers->reg_name}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax Type : <span class="font-weight-light text-dark">{{$job->quotes->customers->region}}</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Service Tax : <span class="font-weight-light text-dark">{{$tax}} %</span></h5>
            <h5 class="text-danger border col-md-5 text-center col-12 mx-md-4 bg-white b p-2">Income Tax Percent : <span class="font-weight-light text-dark">3 %</span></h5>
        </div>

        <div class="col-12">
            <?php
                $tax_deducted=0;
            if ($invoice_ledger->service_tax_deducted=="By AIMS" && $invoice_ledger->invoice_tax_deducted=="By AIMS"){
                $tax_deducted=0;
            }
            if ($invoice_ledger->service_tax_deducted=="At Source" && $invoice_ledger->invoice_tax_deducted=="At Source"){
                $tax_deducted=1;
            }
            if ($invoice_ledger->service_tax_deducted=="By AIMS" && $invoice_ledger->invoice_tax_deducted=="At Source"){
                $tax_deducted=2;
            }
            ?>
            <form class="form-horizontal" action="{{url('invoicing-ledger/update/'.$invoice_ledger->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="customer" value="{{$job->quotes->customer_id}}">
                <input type="hidden" name="service_charges" value="{{$service_charges}}">
                <input type="hidden" name="service_tax_type" value="{{$job->quotes->customers->region}}">
                <input type="hidden" name="service_tax_percent" value="{{$tax}}">
                <input type="hidden" name="income_tax_percent" value="3">
                <div class="form-group row">
                    <label for="tax_deducted_by" class="col-sm-3 control-label">Tax Deducted</label>
                    <select class="form-control col-md-9" id="tax_deducted_by" name="tax_deducted_by">
                        <option selected disabled>Deducted by</option>
                        <option value="0" {{($tax_deducted==0)?'selected':''}}>Income Tax by AIMS + Service Tax by AIMS</option>
                        <option value="1" {{($tax_deducted==1)?'selected':''}}>Income Tax at Source + Service Tax at Source</option>
                        <option value="2" {{($tax_deducted==2)?'selected':''}}>Income Tax at Source + Service Tax by AIMS</option>
                    </select>
                    @if ($errors->has('tax_deducted_by'))
                        <span class="text-danger"><strong>{{ $errors->first('tax_deducted_by') }}</strong></span>
                    @endif
                </div>

                <div class="form-group  row">
                    <label for="confirmed_by_name" class="col-sm-3 control-label">Confirmed by : Name</label>
                    <input type="text" class="form-control col-md-9" id="confirmed_by_name" name="confirmed_by_name"
                           placeholder="Name" autocomplete="off" value="{{old('confirmed_by_name',$invoice_ledger->confirmed_by_name)}}">
                    @if ($errors->has('confirmed_by_name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_name') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="confirmed_by_phone" class="col-sm-3 control-label">Confirmed By : Phone</label>

                    <input type="text" class="form-control col-md-9" id="confirmed_by_phone" name="confirmed_by_phone"
                           placeholder="Phone" autocomplete="off" value="{{old('confirmed_by_phone',$invoice_ledger->confirmed_by_phone)}}">
                    @if ($errors->has('confirmed_by_phone'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('confirmed_by_phone') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group row">
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
                    <input type="text" class="form-control col-md-9" id="acc_phone_2" name="acc_phone_2" placeholder="Phone (opt.)" autocomplete="off" value="{{old('acc_phone_2',$phones[1])}}">
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
                </div>
                <div class="col-12 text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-success float-right"><i class="fa fa-refresh"></i> Update</button>
                </div>
            </form>
        </div>

    </div>
@endsection

