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
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-plus-circle"></i> Update Purchase Indent</h3>
        </div>
        <div class="col-12">
            <form class="form-horizontal" action="{{route('purchase.indent.update')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit->id}}" id="id" name="id"/>
                <div class="form-group row">
                    <label for="indent_type" class="col-sm-2 control-label">Indent Type</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="indent_type" name="indent_type">
                                <option selected disabled>Select Indent Type</option>
                                <option value="capital" {{$edit->indent_type=='capital'?'selected':''}}>Capital Purchase</option>
                                <option value="spot" {{$edit->indent_type=='spot'?'selected':''}}>Spot Purchase</option>
                                <option value="normal" {{$edit->indent_type=='normal'?'selected':''}}>Normal Purchase</option>
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
                    <label for="chargeable_to" class="col-sm-2 control-label">Chargeable To</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="chargeable_to" name="chargeable_to" placeholder="Chargeable To"
                               autocomplete="off" value="{{old('chargeable_to',$edit->chargeable_to)}}">
                        @if ($errors->has('chargeable_to'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('chargeable_to') }}</strong>
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
                                    <option value="{{$department->id}}" {{$edit->deliver_to==$department->id?'selected':''}}>{{$department->name}}</option>
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
                    <label for="department_id" class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="department_id" name="department_id">
                                <option selected disabled>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{$edit->department_id==$department->id?'selected':''}}>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('department_id'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('department_id') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location"
                               autocomplete="off" value="{{$edit->location}}">
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
                               autocomplete="off" value="{{old('required',$edit->required)}}">
                        @if ($errors->has('required'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('required') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="indenter" class="col-sm-2 control-label">Indenter</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="indenter" name="indenter">
                                <option selected disabled>Select Indenter</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{$user->id}}" {{$edit->indenter==$user->id?'selected':''}}>{{$user->fname}} {{$user->lname}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('indenter'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('indenter') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="text-right">
                    <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection

