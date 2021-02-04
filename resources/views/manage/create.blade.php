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
        <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Add Items for Job</h3>
        <div class="container">
            <form method="post" action="{{route('jobs.manage.store')}}">
                @csrf
                <input type="hidden" value="{{$id}}" id="quote_id" name="id">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Capability</th>
                        <th>Parameter</th>
                        <th>Qty</th>
                        <th>Range</th>
                        <th>Location</th>
                        <th>Accredited</th>
                    </tr>
                    </thead>
                    <tbody class="text-capitalize">
                    @foreach($items as $item)
                        @if($item->status!=3)
                            <tr>
                                <td>
                                    @if(!in_array($item->id,$assigned_items))
                                            <input type="checkbox" name="items[]" value="{{$item->id}}" id="{{$item->id}}" >
                                    @else
                                         <input type="checkbox" name="items[]" value="{{$item->id}}" id="{{$item->id}}" disabled checked>
                                    @endif
                                </td>
                                <td>
                                    @if(!in_array($item->id,$assigned_items))
                                        <label class="form-check-label" for="{{$item->id}}">{{$item->capabilities->name}}</label>
                                    @else
                                        <label class="form-check-label" for="{{$item->id}}">{{$item->capabilities->name}}</label>
                                    @endif
                                </td>
                                <td>{{$item->parameters->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->range}}</td>
                                <td>{{$item->location}}</td>

                                <td>{{$item->accredited}}</td>
                            </tr>

                        @endif
                    @endforeach

                    @if ($errors->has('items'))
                        <script>
                            $(document).ready(function () {
                                swal("Failed", "{{$errors->first('items') }}", "error");
                            });
                        </script>
                    @endif
                    </tbody>
                </table>
                <button class="btn btn-primary pull-right btn-sm" type="submit"> <i class="fa fa-save"></i> Create</button>
            </form>
        </div>
    </div>
@endsection






