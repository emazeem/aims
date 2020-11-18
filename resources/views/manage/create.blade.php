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
            <h2>Add Items for Job</h2>
            <form method="post" action="{{route('jobs.manage.store')}}">
                @csrf
                <input type="hidden" value="{{$id}}" id="quote_id" name="id">
                @foreach($items as $item)
                    @if(!in_array($item->id,$assigned_items))
                    <div class="form-check">
                        <input type="checkbox" name="items[]" value="{{$item->id}}" class="form-check-input" id="items">
                        <label class="form-check-label text-lg ml-2" for="items">{{$item->capabilities->name}}</label>
                    </div>
                        @else
                        <div class="form-check">
                            <input type="checkbox" name="items[]" value="{{$item->id}}" class="form-check-input" id="items" disabled checked>
                            <label class="form-check-label text-lg ml-2 text-muted" for="items">{{$item->capabilities->name}}</label>
                        </div>
                    @endif
                        @if ($errors->has('items'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('items') }}</strong>
                      </span>
                        @endif
                @endforeach
                <br>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
        <!--
        <div class="col-md-6 col-12">
            <table class="table table-striped bg-white table-sm table-bordered mt-2">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @foreach($items as $item)
                    @if(in_array($item->id,$assigned_items))
                        <tr>
                            <td>{{$item->capabilities->name}}</td>
                            <td>
                                <form method="post" action="{{route('jobs.manage.delete')}}">
                                    @csrf
                                    <input type="hidden" name="quote_id" value="{{$item->quote_id}}">
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
        -->
    </div>
@endsection






