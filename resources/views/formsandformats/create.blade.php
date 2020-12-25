@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <div class="col-12">
        <h3 class="border-bottom text-dark"><i class="fa fa-plus-circle"></i> Add Form and Format</h3>
        <form action="{{route('forms.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input class="form-control" value="{{$id}}" id="id" name="id" type="hidden">
            <div class="row pb-2">
                <label for="doc" class="col-sm-2 control-label">Doc #</label>
                <div class="col-sm-10">
                    <input class="form-control" id="doc" name="doc" placeholder="Doc #">
                    @if ($errors->has('doc'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('doc') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row pb-2">
                <label for="issue" class="col-sm-2 control-label">Issue #</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="issue" name="issue">
                            <option selected disabled="">Select Issue #</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                        </select>
                    </div>
                    @if ($errors->has('issue'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('issue') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row pb-2">
                <label for="revision" class="col-sm-2 control-label">Revision #</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="revision" name="revision">
                            <option selected disabled="">Select Revision #</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                        </select>
                    </div>
                    @if ($errors->has('revision'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('revision') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                    <input class="form-control" id="location" name="location" placeholder="Location">
                    @if ($errors->has('location'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="issue_date" class="col-sm-2 control-label">Issue Date</label>
                <div class="col-sm-10">
                    <input class="form-control" id="issue_date" name="issue_date" placeholder="Doc #" type="date">
                    @if ($errors->has('issue_date'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('issue_date') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="reviewed_on" class="col-sm-2 control-label">Reviewed on</label>
                <div class="col-sm-10">
                    <input class="form-control" id="reviewed_on" name="reviewed_on" placeholder="reviewed_on" type="date">
                    @if ($errors->has('reviewed_on'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('reviewed_on') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="reviewed_by" class="col-sm-2 control-label">Reviewed by</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="reviewed_by" name="reviewed_by">
                            <option selected disabled="">Reviewed by</option>
                            @foreach(\App\Models\User::all() as $item)
                                <option value="{{$item->id}}" {{($item->id==16)?'selected':''}}>{{$item->fname}} {{$item->lname}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('reviewed_by'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('reviewed_by') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="mode_of_storage" class="col-sm-2 control-label">Mode of Storage</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="mode_of_storage" name="mode_of_storage">
                            <option selected disabled="">Mode of Storage</option>
                            <option value="hard-copy" selected>Hard Copy</option>
                            <option value="soft-copy">Soft Copy</option>
                        </select>
                    </div>
                    @if ($errors->has('mode_of_storage'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('mode_of_storage') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="status" name="status">
                            <option selected disabled="">Select Status</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    @if ($errors->has('status'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row pb-2">
                <label for="file" class="col-sm-2 control-label">Upload Form</label>
                <div class="col-sm-10 ">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Upload File</label>
                    </div>
                    @if ($errors->has('file'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <button class="btn btn-primary pull-right btn-sm" type="submit">Save</button>
        </form>

    </div>
    <script>
        $('#sops').select2({
            placeholder: 'Select / Search SOP\'s'
        });
    </script>
@endsection


