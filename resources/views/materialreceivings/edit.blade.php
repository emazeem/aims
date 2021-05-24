@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Edit Material Receiving</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('material.receiving.update')}}" method="post">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id" placeholder="id" autocomplete="off" value="{{$edit->id}}">
                <div class="form-group row">
                    <label for="received_from" class="col-sm-2 control-label">Received From</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="received_from" name="received_from" placeholder="Received From" autocomplete="off" value="{{old('received_from',$edit->received_from)}}">
                        @if ($errors->has('received_from'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('received_from') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="unit" name="unit">
                                <option selected disabled>Select Unit</option>
                                <option value="ea" {{($edit->unit=='ea')?'selected':''}}>EA</option>
                                <option value="box" {{($edit->unit=='box')?'selected':''}}>Box</option>
                                <option value="dozen" {{($edit->unit=='dozen')?'selected':''}}>Dozen</option>
                                <option value="bottle" {{($edit->unit=='bottle')?'selected':''}}>Bottle</option>
                            </select>
                        </div>
                        @if ($errors->has('unit'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('unit') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="qty" class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" autocomplete="off" value="{{old('qty',$edit->qty)}}">
                        @if ($errors->has('qty'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('qty') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="physical_check" class="col-sm-2 control-label">Physical Check</label>
                    <div class="col-sm-10 row">
                        <div class="form-check col-1 m-2">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="physical_check" value="1" {{($edit->physical_check==1)?'checked':''}}> Yes
                            </label>
                        </div>
                        <div class="form-check col-2 m-2">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="physical_check" value="0" {{($edit->physical_check==0)?'checked':''}}> No
                            </label>
                        </div>
                        @if ($errors->has('physical_check'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('physical_check') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="meet_specifications" class="col-sm-2 control-label">Meet Specifications</label>
                    <div class="col-sm-10 row">
                        <div class="form-check col-1 m-2">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="meet_specifications" value="1" {{($edit->meet_specifications==1)?'checked':''}}> Yes
                            </label>
                        </div>
                        <div class="form-check col-2 m-2">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="meet_specifications" value="0" {{($edit->meet_specifications==0)?'checked':''}}> No
                            </label>
                        </div>
                        @if ($errors->has('meet_specifications'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('meet_specifications') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row" style="{{($edit->meet_specifications==1)?'display: block':'display: none'}}" id="meet_specifications_div">
                    <label for="specifications" class="col-sm-2 control-label">Meet Specifications</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="specifications" name="specifications" >
                                <option selected disabled>Select Meet Specifications</option>
                                <option value="0">As per indent</option>
                                <option value="1">As per specs sheet of OEM</option>
                                <option value="2">As per requirement of process</option>
                            </select>
                        </div>
                        @if ($errors->has('specifications'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('specifications') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("input[name$='meet_specifications']").click(function(){
                if ($(this).val()==1){
                    $('#meet_specifications_div').show();
                }
                if ($(this).val()==0){
                    $('#meet_specifications_div').hide();
                }

            });
        });
    </script>
@endsection

