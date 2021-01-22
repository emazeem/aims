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
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Add Voucher</h3>
        </div>

        <div class="col-12">
            <form class="form-horizontal" action="{{route('vouchers.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id" id="id">
                <div class="form-group row">
                    <label for="v_type" class="col-2 control-label">Select Voucher Type</label>
                    <div class="col-10">
                        <select class="form-control" id="v_type" name="v_type" required>
                            <option value="" selected disabled>Select Voucher Type</option>
                            <option value="journal" {{$edit->v_type=='journal'?'selected':''}}>Journal Voucher</option>
                            <option value="sale" {{$edit->v_type=='sale'?'selected':''}}>Sales Voucher</option>
                            <option value="purchase" {{$edit->v_type=='purchase'?'selected':''}}>Purchase Voucher</option>
                            <option value="cash-payment" {{$edit->v_type=='cash-payment'?'selected':''}}>Cash Payment Voucher</option>
                            <option value="cash-receipt" {{$edit->v_type=='cash-receipt'?'selected':''}}>Cash Receipt Voucher</option>
                            <option value="bank-payment" {{$edit->v_type=='bank-payment'?'selected':''}}>Bank Payment Voucher</option>
                            <option value="bank-receipt" {{$edit->v_type=='bank-receipt'?'selected':''}}>Bank Receipt Voucher</option>
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
                        <td>Type</td>
                        <td>Dr. / Cr.</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($edit->details as $k=>$detail)
                    <tr>
                        <td>
                            <select name="account[]"  class="form-control" id="account" required>
                                <option disabled selected>Select Account</option>
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
                            <select name="type[]"  class="form-control" id="type" required>
                                <option disabled selected>Select Type</option>
                                <option value="debit" {{$detail->dr?'selected':''}}>Debit</option>
                                <option value="credit" {{$detail->cr?'selected':''}}>Credit</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="price[]"  class="form-control" placeholder="Enter Dr. / Cr. Amount" value="{{old('price',$detail->cr?$detail->cr:$detail->dr)}}" required/>
                            @if ($errors->has('price'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td >
                            <a class="deleteRow"></a>
                            @if($k==0)
                                <a href="javascript:void(0)"  id="addrow" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                            @else
                                <a href="javascript:void(0)" class="ibtnDel btn btn-danger btn-sm mt-2 text-lg "><i class="fa fa-times-circle"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>@if ($errors->has('uuc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('uuc') }}</strong>
                            </span>
                            @endif
                        </td>

                    </tr>
                    </tfoot>
                </table>

                <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;

            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><select name="account[]" required class="form-control" id="account"><option disabled selected>Select Account</option>@php foreach ($accounts as $account){ echo '<option value="'.$account->acc_code.'">'.$account->title.'</option>';}  @endphp</td>';
                cols += '<td><textarea rows="1" required class="form-control" name="narration[]" placeholder="Narration"/></td>';
                cols += '<td><select name="type[]" required  class="form-control" id="type"><option disabled selected>Select Type</option><option value="debit">Debit</option><option value="credit">Credit</option></td>';
                cols += '<td><input type="text" required name="price[]"  class="form-control" id="price" placeholder="Enter Dr. / Cr. Amount"></td>';
                cols += '<td>' +
                    '<a href="javascript:void(0)" class="ibtnDel btn btn-danger btn-sm mt-2 text-lg "><i class="fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });

            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1
            });
        });
    </script>
@endsection

