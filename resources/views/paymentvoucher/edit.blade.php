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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3><i class="fa fa-edit"></i> Update Payment Voucher</h3>
        </div>
        <div class="col-12">
            <form id="edit_voucher_form">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id">
                <div class="form-group row">
                    <label for="business_line" class="col-2 control-label">Select Business Line</label>
                    <div class="col-10">
                        <select class="form-control" id="business_line" name="business_line" disabled>
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
                        <select class="form-control" id="v_type" name="v_type" disabled>
                            <option value="payment" selected>Payment Voucher</option>
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
                        <input type="date" class="form-control" id="v_date" name="v_date" value="{{old('v_date',$edit->date->format('Y-m-d'))}}" disabled>
                        @if ($errors->has('v_date'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="options" class="col-2 control-label">Select Options</label>
                    <div class="col-10">
                        <select class="form-control" id="options" >
                            <option value="" selected disabled>Select Options</option>
                            <option value="po">PO</option>
                            <option value="invoice">Purchase Invoice</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row po-div">
                    <label for="po" class="col-2 control-label">Select PO</label>
                    <div class="col-10">
                        <select class="form-control" id="po" name="po" >
                            <option value="" selected disabled>Select PO</option>
                            @foreach(\App\Models\Po::all() as $static)
                                <option value="{{$static->id}}">PO # 00{{$static->id}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('po'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('po') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row inv-div">
                    <label for="purchase_invoice" class="col-2 control-label">Select Purchase Invoice</label>
                    <div class="col-10">
                        <select class="form-control" id="purchase_invoice" name="purchase_invoice" >
                            <option value="" selected disabled>Select Purchase Invoice</option>
                            @foreach(\App\Models\GrnVoucher::all() as $static)
                                @if($static->invoice_id)
                                    <option value="{{$static->invoice_id}}">Purchase Inv # 00{{$static->invoice_id}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('purchase_invoice'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('purchase_invoice') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reference" class="col-2 control-label">Reference</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="reference" name="reference" value="{{old('reference',$edit->reference)}}" placeholder="Enter Reference">
                        @if ($errors->has('reference'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('reference') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <h5 class="po-div">PO Details</h5>
                <table class="table bg-white table-hover table-bordered po-table">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <h5 class="inv-div">Purchase Invoice</h5>

                <table class="table bg-white table-hover table-bordered inv-table">
                    <thead>
                    <tr>
                        <th>Narration</th>
                        <th>A/C</th>
                        <th>Dr.</th>
                        <th>Cr.</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

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
                <table id="myTable" class="table order-list table-bordered bg-white table-hover">
                    <thead>
                    <tr>
                        <td style="width: 20%;">Categories</td>
                        <td style="width: 20%;">Account</td>
                        <td style="width: 10%;">Cost Center</td>
                        <td style="width: 20%;">Narration</td>
                        <td style="width: 10%;">Dr.</td>
                        <td style="width: 10%;">Cr.</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($edit->details as $detail)

                        @php
                            $account=\App\Models\Chartofaccount::where('acc_code',$detail->acc_code)->first();
                        @endphp
                        <input type="hidden" value="{{$detail->id}}" name="detail_id[]">
                        <tr>
                            <td>
                                <select name="tlevel[]"  class="form-control " >
                                    <option selected>{{$account->codethree->title}}</option>
                                </select>
                            </td>
                            <td><select name="account[]"  class="form-control account" >
                                    <option value="{{$detail->acc_code}}" selected>{{$account->title}}</option>
                                </select>
                            </td>
                            <td>
                                @php
                                    if (isset($detail->cost_center)){
                                        $costcenter= \App\Models\CostCenter::find($detail->cost_center);
                                    }else{
                                        $costcenter=null;
                                    }
                                    $cc=\App\Models\CostCenter::all()->where('parent_id',$account->id);
                                @endphp
                                <select name="costcenter[]" class="form-control">
                                    <option value='' selected>Select Cost Center</option>
                                    @foreach($cc as $item)
                                        <option value="{{$item->id}}" {{$costcenter->id==$item->id?'selected':''}}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><textarea rows="1"  class="form-control" name="narration[]" placeholder="Narration">{{$detail->narration}}</textarea></td>
                            <td><input type="text"  name="dr[]"  class="form-control" id="dr" placeholder="Dr." value="{{$detail->dr}}"></td>
                            <td><input type="text"  name="cr[]"  class="form-control" id="cr" placeholder="Cr." value="{{$detail->cr}}"></td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                </table>



                <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.inv-div').hide();
            $('.inv-table').hide();
            $('.po-div').hide();
            $('.po-table').hide();
            $('select[id="options"]').on('change', function() {
                var value = $(this).val();
                if (value=='po'){
                    $('#purchase_invoice').val('');
                    $('.inv-div').hide();
                    $('.inv-table').hide();
                    $('.po-div').show();
                    $('.po-table').show();
                }
                if (value=='invoice'){
                    $('#po').val('');
                    $('.inv-div').show();
                    $('.inv-table').show();
                    $('.po-div').hide();
                    $('.po-table').hide();
                }

            });


            $("#edit_voucher_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('vouchers.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        swal('success',data.success,'success');
                    },
                    error: function(xhr)
                    {
                        if (xhr.responseJSON.error){
                            swal("Failed", xhr.responseJSON.error, "error").then((value) => {

                            });
                        }else {
                            var error='';
                            $.each(xhr.responseJSON.errors, function (key, item) {
                                error+=item;
                            });
                            swal("Failed", error, "error");
                        }
                    }
                });
            }));

            $(document).on('change', '.tlevel', function(){
                var tlevel = $(this).val();
                var step_id = $(this).data('tlevel');
                $.ajax({
                    url: '/chartofaccount/my-coa/'+tlevel,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        $('#account_id'+step_id).empty();
                        var html = '<option value="">Select Account</option>';
                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.acc_code+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#account_id'+step_id).append(html);
                    }
                });
            });
            $(document).on('change', '.account', function(){
                var account = $(this).val();
                var account_id = $(this).data('account_id');
                $.ajax({
                    url: '/chartofaccount/my-cc/'+account,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        $('#costcenter_id'+account_id).empty();
                        var html = '<option value="">Select Cost Center</option>';
                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.id+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#costcenter_id'+account_id).append(html);
                    }
                });
            });
            $('select[name="po"]').on('change', function() {
                var po = $(this).val();
                if(po) {
                    $.ajax({
                        url: '/vouchers/get-po-details/'+po,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('.po-table tbody').empty();
                            $.each(data,function(index,item){
                                $('.po-table').append(
                                    "<tr>" +
                                    "<td>" + item.title + "</td>" +
                                    "<td>" + item.description + "</td>" +
                                    "<td>" + item.qty + "</td>"+
                                    "<td>" + item.price + "</td>"+
                                    "<td>" + item.price*item.qty + "</td>"
                                );
                            });
                        }
                    });
                }else{
                    $('.po-table tbody').empty();
                }
            });
            $('select[name="purchase_invoice"]').on('change', function() {
                var inv = $(this).val();
                if(inv) {
                    $.ajax({
                        url: '/vouchers/get-inv-details/'+inv,
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
        });
    </script>
@endsection