@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <h2 class="border-bottom text-dark">Asset Group Details</h2>

        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover">
                <tr>
                    <th>Name</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Assets</th>
                    <?php $assets=\App\Models\Asset::where('group_id',$show->id)->get(); ?>
                    <td>
                        @foreach($assets as $asset)
                            <span class="badge badge-dark">{{$asset->name}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection