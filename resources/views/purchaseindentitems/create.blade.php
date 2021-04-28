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
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Add Purchase Indent</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('purchase.indent.items.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id" value="{{$id}}">


                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                               autocomplete="off" value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                               autocomplete="off" value="{{old('description')}}">
                        @if ($errors->has('description'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="purpose" class="col-sm-2 control-label">Purpose</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose" autocomplete="off" value="{{old('purpose')}}">
                        @if ($errors->has('purpose'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('purpose') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="item_code" class="col-sm-2 control-label">Item Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Item Code"
                               autocomplete="off" value="{{old('item_code')}}">
                        @if ($errors->has('item_code'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('item_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ref_code" class="col-sm-2 control-label">Reference Doc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ref_code" name="ref_code" placeholder="Reference Code" autocomplete="off" value="{{old('ref_code')}}">
                        @if ($errors->has('ref_code'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('ref_code') }}</strong>
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
                                <option value="ea">EA</option>
                                <option value="box">Box</option>
                                <option value="dozen">Dozen</option>
                                <option value="bottle">Bottle</option>
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
                    <label for="consumption" class="col-sm-2 control-label">Last 6 months consumption</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="consumption" name="consumption" placeholder="Last 6 months consumption"
                               autocomplete="off" value="{{old('consumption')}}">
                        @if ($errors->has('consumption'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('consumption') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-sm-2 control-label">Current Stock</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="Current Stock" autocomplete="off" value="{{old('stock')}}">
                        @if ($errors->has('stock'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qty" class="col-sm-2 control-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" autocomplete="off" value="{{old('qty')}}">
                        @if ($errors->has('qty'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('qty') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

