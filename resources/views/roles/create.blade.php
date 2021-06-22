@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <style>
        input[type='checkbox']{
            height: 20px;
            width: 20px;
        }
        .custom-label{
            font-size: 20px;
        }

    </style>
    <div class="row pb-3">
        <h3 class="text-dark font-weight-light"> <i class="feather icon-plus-circle"></i> Add Roles</h3>
        <div class="col-12">

            <form class="form-horizontal" id="add_roles_form" method="post" >
                @csrf

                <div class="form-group mt-md-4 row">
                    <label for="name" class="control-label col-12">Title
                        <input type="text" class="form-control col-12" id="name" name="name" placeholder="Title for Role"   value="{{old('name')}}">
                    </label>
                        @if ($errors->has('name'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                        @endif
                </div>

                {{--<div class="form-group col-sm-6">
                    <ul style="list-style:none">
                        @foreach($menulist as $menu)
                            @if(empty($menu->parent_id))
                                <div class="checkbox">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]"><i class="fa fa-bars text-info left-space"></i> {{$menu->name}}</label>
                                </div>
                            @else
                                <div class="checkbox left-space-2">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]"><i class="fa fa-lock text-danger left-space"></i> {{$menu->name}}</label>
                                </div>/

                            @endif
                        @endforeach

                    </ul>
                </div>
                --}}
                <div class="form-group col-12">
                    <ul style="list-style:none">
                        @foreach($menuus as $menu)
                            @if($menu->parent_id==null)
                                <div class="">
                                    <label class="custom-label"><input type="checkbox" value="{{$menu->slug}}" name="menu_arr[]"><i class="fa fa-bars text-info ml-3"></i> {{$menu->name}}</label>
                                </div>
                                @foreach($menu->parent as $item)
                                    <div class="ml-md-5 ml-3">
                                    <label class="custom-label"><input type="checkbox" value="{{$item->slug}}" name="menu_arr[]">
                                        @if($item->has_child==0)
                                            <i class="fa fa-lock text-danger ml-3"></i>
                                        @else
                                            <i class="fa fa-bars text-info ml-3"></i>
                                        @endif {{$item->name}}</label>
                                </div>
                                @endforeach
                            @endif
                        @endforeach

                    </ul>
                </div>

                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn border btn-light btn-sm"> <i class="fa fa-times"> </i> Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"> </i> Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#add_roles_form").on('submit',(function(e) {
                e.preventDefault();
                var button=$(this).find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('roles.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                        });

                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
        });
    </script>
@endsection

