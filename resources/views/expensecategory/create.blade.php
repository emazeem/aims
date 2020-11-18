@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $( document ).ready(function() {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Expense Category or Subcategory</h3>
        </div>
        <form class="form-horizontal" action="{{route('expenses_categories.store')}}" method="post">
            @csrf
            <div class="box-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="site" class="col-sm-3 control-label">Select Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="category_id" name="category_id" >
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category / Subcategory name" autocomplete="off" value="{{ old('pagename') }}" require >
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{!! url(''); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

@endsection