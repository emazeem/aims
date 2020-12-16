@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
    <script>
        $(document).ready(function() {
            swal("Done!",'{{Session('success')}}', "success");
        });
    </script>
    @endif
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
<div class="row pb-3">
    <div class="col-12">
        <h3 class="pull-left border-bottom pb-1"><i class="fa fa-pencil"></i> Edit Customers</h3>
    </div>
    <div class="col-12">

      <form class="form-horizontal" action="{{url('customers/update/'.$edit->id)}}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group mt-md-4 row">

                  <label for="name" class="col-sm-2 control-label">Registered Name</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Registered Name" autocomplete="off" value="{{old('name',$edit->reg_name)}}">
                      @if ($errors->has('name'))
                          <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                      @endif
                  </div>


          </div>
          <div class="form-group row">

                  <label for="ntn" class="col-sm-2 control-label">NTN / FTN</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="ntn" name="ntn" placeholder="NTN / FTN" autocomplete="off" value="{{old('ntn',$edit->ntn)}}">
                      @if ($errors->has('ntn'))
                          <span class="text-danger">
                          <strong>{{ $errors->first('ntn') }}</strong>
                      </span>
                      @endif
                  </div>

          </div>
          <div class="form-group row">
                  <label for="address" class="col-sm-2 control-label">Physical Address</label>
                  <div class="col-sm-10">
                      <textarea type="text" class="form-control" rows="5" id="address" name="address" placeholder="Physical Address" autocomplete="off" >{{old('address',$edit->address)}}</textarea>
                      @if ($errors->has('address'))
                          <span class="text-danger">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                      @endif
                  </div>

          </div>
          <div class="form-group row">
              <label for="region" class="col-sm-2 control-label">Select Region</label>
              <div class="col-sm-10">
                  <div class="form-check form-check-inline" style="width: 100%">
                      <select class="form-control" id="region" name="region">
                          <option selected disabled="">Select Region</option>
                          <option value="PRA" {{($edit->region=="PRA")?"selected":""}} {{ (collect(old('region'))->contains('PRA')) ? 'selected':'' }} >Punjab-PRA</option>
                          <option value="SRB" {{($edit->region=="SRB")?"selected":""}} {{ (collect(old('region'))->contains('SRB')) ? 'selected':'' }} >Sindh-SRB</option>
                          <option value="KPRA" {{($edit->region=="KPRA")?"selected":""}} {{ (collect(old('region'))->contains('KPRA')) ? 'selected':'' }} >KPK-KPRA</option>
                          <option value="BRA" {{($edit->region=="BRA")?"selected":""}} {{ (collect(old('region'))->contains('BRA')) ? 'selected':'' }} >Balochistan-BRA</option>
                          <option value="IRD" {{($edit->region=="IRD")?"selected":""}} {{ (collect(old('region'))->contains('IRD')) ? 'selected':'' }} >AJK-IRD</option>
                      </select>
                  </div>
                  @if ($errors->has('pay_type'))
                      <span class="text-danger">
                          <strong>{{ $errors->first('pay_type') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group row">
                  <label for="pay_type" class="col-sm-2 control-label">Payment Type</label>
                  <div class="col-sm-10">
                      <div class="form-check form-check-inline" style="width: 100%">
                          <select class="form-control" id="pay_type" name="pay_type">
                              <option selected disabled="">Select Payment Type</option>
                              <option value="cash" {{($edit->customer_type=="cash")?"selected":""}}>Cash</option>
                              <option value="credit" {{($edit->customer_type=="credit")?"selected":""}}>Credit</option>
                          </select>
                      </div>
                      @if ($errors->has('pay_type'))
                          <span class="text-danger">
                          <strong>{{ $errors->first('pay_type') }}</strong>
                      </span>
                      @endif
                  </div>
          </div>
          <div class="form-group row">
                  <label for="pay_way" class="col-sm-2 control-label">Payment Way</label>
                  <div class="col-sm-10">
                      <div class="form-check form-check-inline" style="width: 100%">
                          <select class="form-control" id="pay_way" name="pay_way">
                              <option selected value="{{$edit->pay_terms}}">{{$edit->pay_terms}}</option>
                          </select>
                      </div>
                      @if ($errors->has('pay_way'))
                          <span class="text-danger">
                          <strong>{{ $errors->first('pay_way') }}</strong>
                      </span>
                      @endif
                  </div>

          </div>
          <div class="col-12">
              <div class="row">
                  <div class="col-md-4 col-12 bg-white border">
                      <label for="principal" class="col-form-label">Principal Contact</label>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_name_1" placeholder="Name" autocomplete="off" value="{{old('prin_name_1',$edit->prin_name_1)}}">
                          @if ($errors->has('prin_name_1'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_name_1') }}</strong>
                      </span>
                          @endif

                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_phone_1" placeholder="Phone" autocomplete="off" value="{{old('prin_phone_1',$edit->prin_phone_1)}}">
                          @if ($errors->has('prin_phone_1'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_phone_1') }}</strong>
                      </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_email_1" placeholder="Email" autocomplete="off" value="{{old('prin_email_1',$edit->prin_email_1)}}">
                          @if ($errors->has('prin_email_1'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_email_1') }}</strong>
                      </span>
                          @endif

                      </div>


                  </div>
                  <div class="col-md-4 col-12 bg-white border">
                      <label for="principal" class="col-form-label">Principal Contact</label>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_name_2" placeholder="Name" autocomplete="off" value="{{old('prin_name_2',$edit->prin_name_2)}}">
                          @if ($errors->has('prin_name_2'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_name_2') }}</strong>
                      </span>
                          @endif

                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_phone_2" placeholder="Phone" autocomplete="off" value="{{old('prin_phone_2',$edit->prin_phone_2)}}">
                          @if ($errors->has('prin_phone_2'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_phone_2') }}</strong>
                      </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_email_2" placeholder="Email" autocomplete="off" value="{{old('prin_email_2',$edit->prin_email_2)}}">
                          @if ($errors->has('prin_email_2'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_email_2') }}</strong>
                      </span>
                          @endif

                      </div>


                  </div>
                  <div class="col-md-4 col-12 bg-white border">
                      <label for="principal" class="col-form-label">Principal Contact</label>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_name_3" placeholder="Name" autocomplete="off" value="{{old('prin_name_3',$edit->prin_name_3)}}">
                          @if ($errors->has('prin_name_3'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_name_3') }}</strong>
                      </span>
                          @endif

                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_phone_3" placeholder="Phone" autocomplete="off" value="{{old('prin_phone_3',$edit->prin_phone_3)}}">
                          @if ($errors->has('prin_phone_3'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_phone_3') }}</strong>
                      </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="principal" name="prin_email_3" placeholder="Email" autocomplete="off" value="{{old('prin_email_3',$edit->prin_email_3)}}">
                          @if ($errors->has('prin_email_3'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('prin_email_3') }}</strong>
                      </span>
                          @endif

                      </div>


                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6 col-12 bg-white border ">
                      <label for="purchase" class="col-form-label">Purchase Contact</label>

                      <div class="form-group">
                          <input type="text" class="form-control" id="purchase" name="pur_name" placeholder="Name" autocomplete="off" value="{{old('pur_name',$edit->pur_name)}}">
                          @if ($errors->has('pur_name'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('pur_name') }}</strong>
                      </span>
                          @endif

                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" id="purchase" name="pur_phone_1" placeholder="Phone" autocomplete="off" value="{{old('pur_phone_1',$edit->pur_phone)}}">
                          @if ($errors->has('pur_phone_1'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('pur_phone_1') }}</strong>
                      </span>
                          @endif

                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="purchase" name="pur_phone_2" placeholder="Phone (opt)" autocomplete="off" value="{{old('pur_phone_2',$edit->pur_phone)}}">
                          @if ($errors->has('pur_phone_2'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('pur_phone_2') }}</strong>
                      </span>
                          @endif

                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" id="purchase" name="pur_email" placeholder="Email" autocomplete="off" value="{{old('pur_email',$edit->pur_email)}}">
                          @if ($errors->has('pur_email'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('pur_email') }}</strong>
                      </span>
                          @endif

                      </div>
                  </div>
                  <div class="col-md-6 col-12 bg-white border">
                      <label for="account" class="col-form-label">Accounts Payable</label>
                      <div class="form-group">
                          <input type="text" class="form-control" id="account" name="acc_name" placeholder="Name" autocomplete="off" value="{{old('acc_name',$edit->acc_name)}}">
                          @if ($errors->has('acc_name'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('acc_name') }}</strong>
                      </span>
                          @endif

                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" id="account" name="acc_phone_1" placeholder="Phone" autocomplete="off" value="{{old('acc_phone_1',$edit->acc_phone)}}">
                          @if ($errors->has('acc_phone_1'))
                              <span class="text-danger">
            <strong>{{ $errors->first('acc_phone_1') }}</strong>
        </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="account" name="acc_phone_2" placeholder="Phone (opt.)" autocomplete="off" value="{{old('acc_phone_2',$edit->acc_phone)}}">
                          @if ($errors->has('acc_phone_2'))
                              <span class="text-danger">
            <strong>{{ $errors->first('acc_phone_2') }}</strong>
        </span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="account" name="acc_email" placeholder="Email" autocomplete="off" value="{{old('acc_email',$edit->acc_email)}}">
                          @if ($errors->has('acc_email'))
                              <span class="text-danger">
                          <strong>{{ $errors->first('acc_email') }}</strong>
                      </span>
                          @endif

                      </div>


                  </div>

              </div>
          </div>


          <!-- /.box-body -->
          <div class="box-footer">
              <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Update Customer</button>
          </div>
          <!-- /.box-footer -->
      </form>
  </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="pay_type"]').on('change', function() {
                var type = $(this).val();
                if(type) {
                    $('select[name="pay_way"]').empty();
                    if (type=='cash'){
                        $('select[name="pay_way"]').append('<option value="advance">Advance</option>');
                        $('select[name="pay_way"]').append('<option value="against delivery">Against Delivery</option>');
                    }
                    if (type=='credit'){
                        $('select[name="pay_way"]').append('<option value="15 days" >15 days</option>');
                        $('select[name="pay_way"]').append('<option value="30 days">30 days</option>');
                        $('select[name="pay_way"]').append('<option value="60 days">60 days</option>');
                        $('select[name="pay_way"]').append('<option value="120 days">120 days</option>');
                    }
                    $.each(data, function(key, value) {

                    });
                }else{
                    $('select[name="pay_way"]').empty();
                }
            });
        });
    </script>
@endsection