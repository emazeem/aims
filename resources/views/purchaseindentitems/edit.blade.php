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
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Update Purchase Indent</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('purchase.indent.items.update')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}">

                <div class="form-group row">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                @foreach(\App\Models\InventoryCategory::all()->where('parent_id','!=',null) as $item)
                                    <option value="{{$item->id}}"{{$edit->subcategory_id==$item->id?'selected':''}}>{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('category') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="item_type" class="col-sm-2 control-label">Item Type</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="item_type" name="item_type">
                                <option selected disabled>Select Item Type</option>
                                <option value="consumable" {{$edit->item_type=='consumable'?'selected':''}}>Consumable</option>
                                <option value="fixed-asset" {{$edit->item_type=='fixed-asset'?'selected':''}}>Fixed Asset</option>
                            </select>
                        </div>
                        @if ($errors->has('item_type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('item_type') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                               autocomplete="off" value="{{old('title',$edit->title)}}">
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
                               autocomplete="off" value="{{old('description',$edit->description)}}">
                        @if ($errors->has('description'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="item_code" class="col-sm-2 control-label">Item Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Item Code"
                               autocomplete="off" value="{{old('item_code',$edit->code)}}">
                        @if ($errors->has('item_code'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('item_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="model" class="col-sm-2 control-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                               autocomplete="off" value="{{old('model',$edit->model)}}">
                        @if ($errors->has('model'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('model') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="purpose" class="col-sm-2 control-label">Purpose</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose" autocomplete="off" value="{{old('purpose',$edit->purpose)}}">
                        @if ($errors->has('purpose'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('purpose') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="ref_doc" class="col-sm-2 control-label">Reference Doc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ref_doc" name="ref_doc" placeholder="Reference Doc" autocomplete="off" value="{{old('ref_doc',$edit->ref_doc)}}">
                        @if ($errors->has('ref_doc'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('ref_doc') }}</strong>
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
                                <option {{$edit->unit=='ea'?'selected':''}} value="ea">EA</option>
                                <option {{$edit->unit=='box'?'selected':''}} value="box">Box</option>
                                <option {{$edit->unit=='dozen'?'selected':''}} value="dozen">Dozen</option>
                                <option {{$edit->unit=='bottle'?'selected':''}} value="bottle">Bottle</option>
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
                    <label for="consumption" class="col-sm-2 control-label">Last 6 months consumption</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="consumption" name="consumption" placeholder="Last 6 months consumption"
                                  autocomplete="off">{{old('consumption',$edit->consumption_6months)}}</textarea>
                        @if ($errors->has('consumption'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('consumption') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

