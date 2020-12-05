@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <style>
        input[type='checkbox'] {
            height: 15px;
            width: 25px;
        }

        .custom-label {
            font-size: 30px;
        }

        .left-space {
            margin-left: 20px;
        }

        .left-space-2 {
            margin-left: 40px;
        }

    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h2 class="border-bottom text-dark">Manage & Sort Menus</h2>

        <span class="border p-2 m-2"><i class="fa fa-sort"></i> Range 0-{{count($mens)-1}}</span>
    </div>

    <div class="row pb-3">
        <div class="col-12">


            <form class="form-horizontal" action="{{route('menus.manage.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @php $i=1; @endphp
                <div class="row">
                @foreach($mens as $men)
                    <div class="form-group col-md-3 col-6 border border-dark p-2">
                        <label for="index{{$i}}" class="float-left">{{$men->name}}</label>
                        <br>
                        <input type="number" class="form-control float-right col-4" id="index{{$i}}" name="menu[]" placeholder="" value="{{$men->position}}" required>

                    </div>
                @php $i++; @endphp
                @endforeach
                @foreach($childs as $men)
                    <div class="form-group col-md-3 col-6 border border-dark p-2">
                        <label for="index{{$i}}" class="float-left">{{$men->name}}</label>
                        <br>
                        <input type="number" class="form-control float-right col-4" id="index{{$i}}" name="menu[]" placeholder="" value="{{$men->position}}" required>

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

