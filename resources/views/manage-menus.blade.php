@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">

            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-sort"></i> Manage & Sort Menus</h3>
            <div class="text-right">
                <span class="border "><i class="fa fa-sort"></i> Range 0-{{count($mens)-1}}</span>
            </div>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('menus.manage.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @php $i=1; @endphp
                <div class="row">
                    @foreach($mens as $men)
                        <div class="form-group col-md-3 col-6 border border-dark p-2">
                            <label for="index{{$i}}" class="float-left">{{$men->name}}</label>
                            <br>
                            <input type="number" class="form-control float-right col-4" id="index{{$i}}" name="menu[]"
                                   placeholder="" value="{{$men->position}}" required>

                        </div>
                        @php $i++; @endphp
                    @endforeach
                    @foreach($childs as $men)
                        <div class="form-group col-md-3 col-6 border border-dark p-2">
                            <label for="index{{$i}}" class="float-left">{{$men->name}}</label>
                            <br>
                            <input type="number" class="form-control float-right col-4" id="index{{$i}}" name="menu[]"
                                   placeholder="" value="{{$men->position}}" required>

                        </div>
                        @php $i++; @endphp
                    @endforeach
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

