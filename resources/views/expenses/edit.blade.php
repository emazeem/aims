@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Expenses</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="{{route('expenses.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id">
                <div class="form-group">
                    <label for="category" class="col-3 control-label">Select Category</label>
                    <div class="col-9">
                        <select class="form-control" id="category" name="category" >
                            <option value="" selected disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id==$edit->category)?"selected":""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="text-danger">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="subcategory" class="col-12 control-label">Select Subcategory</label>
                    <div class="col-9">
                        <select class="form-control" id="subcategory" name="subcategory" >
                            @foreach($subcategories as $subcategory)
                                @if($subcategory->id==$edit->subcategory)
                                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('subcategory') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4">
                    <label for="amount" class="col-12 control-label">Amount</label>
                    <div class="col-9">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount" autocomplete="off" value="{{old('amount',$edit->amount)}}">
                        @if ($errors->has('amount'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4">
                    <label for="description" class="col-12 control-label">Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="description" rows="4" name="description" placeholder="description" autocomplete="off">{{old('description',$edit->description)}}</textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="user" class="col-3 control-label">Handed Over to</label>
                    <div class="col-9">
                        <select class="form-control" id="user" name="user" >
                            <option value="" selected disabled>Select Receiver</option>
                            @foreach($users as $user)
                                <?php
                                $user_name=$user->fname." ".$user->lname;
                                ?>
                                <option value="{{$user_name}}" {{($user_name==$edit->user_name)?"selected":""}}>{{$user_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user'))
                            <span class="text-danger">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category"]').on('change', function() {
                var ID = $(this).val();
                if(ID) {
                    $.ajax({
                        url: '/expenses/get_subcategories/'+ID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="subcategory"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="states"]').empty();
                }
            });
        });
    </script>


@endsection

