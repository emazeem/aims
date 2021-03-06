@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="col-12">
        <div class="row">
            <h3 class="box-title border-bottom"><i class="fa fa-refresh"></i> Edit Category</h3>
        </div>
        <form class="form-horizontal" action="{{route('preferences.store_category')}}" method="post">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="edit_category" class="col-sm-2 control-label">Select Category</label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="edit_category" name="edit_category">
                                    <option selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('edit_category'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('edit_category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Category Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="category" name="category"
                                       placeholder="Category Name" autocomplete="off" value="{{ old('category') }}">
                                @if ($errors->has('category'))
                                    <span class="text-danger">
                                     <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 text-right mt-2 mt-md-0">
                                {{--<a href="{!! url(''); !!}" class="btn btn-light border">Cancel</a>--}}
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <div class="row">
            <h3 class="box-title border-bottom"><i class="fa fa-refresh"></i> Edit Preference</h3>
        </div>
        <form class="form-horizontal" action="{{route('preferences.update')}}" method="post">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id" value="{{$edit->id}}">
            <div class="row">
                <div class="form-group col-12">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ old('name',$edit->name) }}">
                        @if ($errors->has('name'))
                            <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="value" class="col-sm-2 control-label">Value</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="value" placeholder="Value"
                               autocomplete="off" value="{{ old('value',$edit->value) }}">
                        @if ($errors->has('value'))
                            <span class="text-danger"><strong>{{ $errors->first('value') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="category" name="category">
                                <option selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{($edit->category==$category->id)?'selected':''}}>{{$category->category}}</option>
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

            </div>
            <div class="col-md-12 text-right">
                <a href="{!! url(''); !!}" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
@endsection