@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <h3 class="border-bottom"><i class="fa fa-refresh"> </i> Edit Capabilities Groups</h3>
    <form action="{{route('capabilities.groups.update')}}" method="post">
        @csrf
        <div class="row">
            <input type="hidden" value="{{$edit->id}}" name="id" id="id">
            <div class="form-group col-12 float-left">
                <label for="name" class="form-label-group">Name of Group</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name',$edit->name)}}">
                @if ($errors->has('name'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                @endif
            </div>
            <div class="form-group col-12">
                <label for="capabilities" class="form-label-group">Select Capabilities</label>
                <div class="form-check form-check-inline" style="width:100%;">
                    <select class="form-control" multiple id="capabilities" name="capabilities[]" style="width:100%;">
                        @foreach($capabilities as $capability)
                            <option value="{{$capability->id}}" {{in_array($capability->id,$edit->capabilities)?'selected':''}}>{{$capability->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('capabilities'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('capabilities') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Update</button>
            </div>
        </div>
    </form>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('#capabilities').select2({
            placeholder: 'Select Capabilities'
        });

    </script>
@endsection


