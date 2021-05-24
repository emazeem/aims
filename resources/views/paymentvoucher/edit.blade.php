@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif

    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="border-bottom"><i class="fa fa-refresh"></i> Edit Payment Voucher</h3>
        </div>

        <div class="col-12">
            <form id="edit_voucher_form">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id" id="id">
                <div class="form-group row">
                    <label for="v_type" class="col-2 control-label">Select Voucher Type</label>
                    <div class="col-10">
                        <select class="form-control" id="v_type" name="v_type" required>
                            <option value="" selected disabled>Select Voucher Type</option>
                            <option value="journal" {{$edit->type=='journal voucher'?'selected':''}}>Journal Voucher</option>
                            <option value="sale" {{$edit->type=='sale voucher'?'selected':''}}>Sales Voucher</option>
                            <option value="purchase" {{$edit->type=='purchase voucher'?'selected':''}}>Purchase Voucher</option>
                            <option value="cash-payment" {{$edit->type=='cash-payment voucher'?'selected':''}}>Cash Payment Voucher</option>
                            <option value="cash-receipt" {{$edit->type=='cash-receipt voucher'?'selected':''}}>Cash Receipt Voucher</option>
                            <option value="bank-payment" {{$edit->type=='bank-payment voucher'?'selected':''}}>Bank Payment Voucher</option>
                            <option value="bank-receipt" {{$edit->type=='bank-receipt voucher'?'selected':''}}>Bank Receipt Voucher</option>
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
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Account</td>
                        <td>Narration</td>
                        <td>Dr.</td>
                        <td>Cr.</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($edit->details as $k=>$detail)
                        <input type="hidden" name="details_id[]"  class="form-control" id="details_id" value="{{$detail->id}}">
                        <tr>
                        <td>
                            <select name="account[]"  class="form-control" id="account" >
                                <option disabled value="">Select Account</option>
                                @foreach($accounts as $account)
                                    <option value="{{$account->acc_code}}" {{$detail->acc_code==$account->acc_code?'selected':''}}>{{$account->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('account'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('account') }}</strong>
                                </span>
                            @endif
                        </td>

                        <td>
                            <textarea name="narration[]" rows="1" placeholder="Narration" class="form-control" required>{{old('narration',$detail->narration)}}</textarea>
                            @if ($errors->has('narration'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('narration') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="dr[]"  class="form-control" placeholder="Dr" value="{{old('price',$detail->dr)}}"/>
                            @if ($errors->has('dr'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('dr') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="cr[]"  class="form-control" placeholder="Dr" value="{{old('price',$detail->cr)}}"/>
                            @if ($errors->has('cr'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('cr') }}</strong>
                                </span>
                            @endif
                        </td>


                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-refresh"></i> Update</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
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
                                location.reload();
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
        });
    </script>
@endsection

