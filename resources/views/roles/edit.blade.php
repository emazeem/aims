@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <style>
        input[type='checkbox']{
            height: 25px;
            width: 25px;
        }
        .custom-label{
            font-size: 30px;
        }
        .left-space{
            margin-left: 20px;
        }
        .left-space-2{
            margin-left: 40px;
        }

    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Roles</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">

            <form class="form-horizontal" action="{{route('roles.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id">
                <div class="form-group mt-md-4 row">
                    <label for="name" class="control-label col-12">Title
                        <input type="text" class="form-control col-12" id="name" name="name" placeholder="Title for Role"   value="{{$edit->name}}">
                    </label>
                    @if ($errors->has('name'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                </div>
{{--
                <div class="form-group col-sm-6">
                    <ul style="list-style:none">
                        @foreach($menulist as $menu)
                            @if(empty($menu->parent_id))
                                <div class="checkbox">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]" {{(in_array($menu->slug,$permissions))?"checked":""}}><i class="fa fa-bars text-info left-space"></i> {{$menu->name}}</label>
                                </div>
                            @else
                                <div class="checkbox left-space-2">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]" {{(in_array($menu->slug,$permissions))?"checked":""}}><i class="fa fa-lock text-danger left-space" ></i> {{$menu->name}}</label>
                                </div>

                            @endif
                        @endforeach

                    </ul>
                </div>--}}
                <div class="form-group col-sm-6">
                    <ul style="list-style:none">
                        @foreach($menuus as $menu)
                            @if($menu->parent_id==null)
                                <div class="checkbox">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]" {{(in_array($menu->slug,$permissions))?"checked":""}}><i class="fa fa-bars text-info left-space"></i> {{$menu->name}}</label>
                                </div>
                                @foreach($menu->parent as $item)
                                    <div class="checkbox left-space-2">
                                        <label class="custom-label"><input type="checkbox" value="{{$item->slug}}" name="menu_arr[]" {{(in_array($item->slug,$permissions))?"checked":""}}><i class="fa fa-lock text-danger left-space"></i> {{$item->name}}</label>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach

                    </ul>
                </div>




                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

