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
            <div class="row pb-2 mt-3">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" id="name" name="name" placeholder="Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                             <strong>{{ $errors->first('name') }}</strong>
                         </span>
                    @endif
                </div>
            </div>
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


            <div class="row pb-2">
                <label for="sops" class="col-sm-2 control-label">SOP's</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="sops" name="sops[]" multiple>
                            @foreach($sops as $sop)
                                <option value="{{$sop->id}}">{{$sop->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('sops'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('sops') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row pb-2">
                <label for="sops" class="col-sm-2 control-label">Upload Form</label>
                <div class="col-sm-10 ">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Upload File</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary pull-right" type="submit">Save</button>
        </form>

    </div>
    <script>
        $('#sops').select2({
            placeholder: 'Select / Search SOP\'s'
        });
    </script>
@endsection


