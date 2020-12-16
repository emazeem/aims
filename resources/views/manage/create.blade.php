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
                @foreach($items as $item)
                    @if(!in_array($item->id,$assigned_items))
                    <div class="form-check h5">
                        <input type="checkbox" name="items[]" value="{{$item->id}}" class="form-check-input" id="{{$item->id}}">
                        <label class="form-check-label text-lg ml-2 border-bottom" for="{{$item->id}}">{{$item->capabilities->name .' -'.$item->quantity }}</label>
                    </div>
                        @else
                        <div class="form-check h5">
                            <input type="checkbox" name="items[]" value="{{$item->id}}" class="form-check-input" id="{{$item->id}}" disabled checked>
                            <label class="form-check-label text-lg ml-2 border-bottom" for="{{$item->id}}">{{$item->capabilities->name.' -'.$item->quantity }}</label>
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
    </div>
@endsection






