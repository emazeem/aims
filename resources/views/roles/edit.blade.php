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

    </style>
    <div class="row pb-3">
        <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> Edit Roles</h3>
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
                <div class="form-group col-sm-6">
                    <ul style="list-style:none">
                        @foreach($menuus as $menu)
                            @if($menu->parent_id==null)
                                <div class="checkbox">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]" {{(in_array($menu->slug,$permissions))?"checked":""}}>
                                        <i class="fa fa-bars text-info ml-3"></i>
                                        {{$menu->name}}
                                    </label>
                                </div>
                                @foreach($menu->parent as $item)
                                    <div class="checkbox  ml-md-5 ml-3">
                                        <label class="custom-label"><input type="checkbox" value="{{$item->slug}}" name="menu_arr[]" {{(in_array($item->slug,$permissions))?"checked":""}}>
                                            @if($item->has_child==0)
                                                <i class="fa fa-lock text-danger ml-3"></i>
                                            @else
                                                <i class="fa fa-bars text-info ml-3"></i>
                                            @endif
                                            {{$item->name}}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                    <div class="text-right">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

