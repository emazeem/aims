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
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light"><i class="feather icon-edit"></i> Edit Journal Voucher</h3>
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
                            <option value="journal" selected>Journal Voucher</option>
                        </select>
                        @if ($errors->has('v_type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="v_date" class="col-2 control-label" >Date of Voucher</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="v_date" disabled name="v_date" value="{{old('v_date',date('Y-m-d'))}}">
                        @if ($errors->has('v_date'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_date') }}</strong>
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
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Update</button>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#edit_voucher_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('journal.vouchers.update')}}",
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

        });
    </script>

@endsection