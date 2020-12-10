@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="box box-info">
        <h2 class="border-bottom text-dark mb-5">Add Preventive Maintenance Record</h2>
        <form class="form-horizontal" action="{{route('intermediate-checks.store')}}" method="post">
            @csrf
            <!-- /.box-body -->
            <div class="box-footer col-12 text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

@endsection