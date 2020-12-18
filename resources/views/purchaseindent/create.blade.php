@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Add Purchase Indent</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('purchase.indent.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="indent_type" class="col-sm-2 control-label">Indent Type</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="indent_type" name="indent_type">
                                <option selected disabled>Select Indent Type</option>
                                <option value="capital">Capital Purchase</option>
                                <option value="spot">Spot Purchase</option>
                                <option value="normal">Normal Purchase</option>
                            </select>
                        </div>
                        @if ($errors->has('indent_type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('indent_type') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-sm-2 control-label">Department / Chargeable to</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="department" name="department">
                                <option selected disabled>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('department'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('department') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deliver_to" class="col-sm-2 control-label">Deliver to</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="deliver_to" name="deliver_to">
                                <option selected disabled>Select Deliver to</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('deliver_to'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('deliver_to') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location"
                               autocomplete="off" value="AIMS Cal Lab Lahore">
                        @if ($errors->has('location'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="required" class="col-sm-2 control-label">Required Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="required" name="required"
                               autocomplete="off" value="{{old('required')}}">
                        @if ($errors->has('required'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('required') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
{{--                <div class="form-group row">
                    <label for="image" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="cv">Image (opt)</label>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('image') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>--}}

                <!-- /.box-body -->
                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

