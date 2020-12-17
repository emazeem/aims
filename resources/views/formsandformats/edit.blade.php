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
        <h3 class="border-bottom text-dark"><i class="fa fa-plus-circle"></i> Edit Form and Format</h3>
        <form action="{{route('forms.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input class="form-control" value="{{$edit->id}}" id="detail_id" name="detail_id" type="hidden">
            <div class="row pb-2">
                <label for="doc" class="col-sm-2 control-label">Doc #</label>
                <div class="col-sm-10">
                    <input class="form-control" id="doc" name="doc" placeholder="Doc #" value="{{$edit->doc_no}}">
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
                            <option value="01" {{($edit->issue_no='01')?'selected':''}}>01</option>
                            <option value="02" {{($edit->issue_no='02')?'selected':''}}>02</option>
                            <option value="03" {{($edit->issue_no='03')?'selected':''}}>03</option>
                            <option value="04" {{($edit->issue_no='04')?'selected':''}}>04</option>
                            <option value="05" {{($edit->issue_no='05')?'selected':''}}>05</option>
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
                            <option value="01" {{($edit->rev_no='01')?'selected':''}}>01</option>
                            <option value="02" {{($edit->rev_no='02')?'selected':''}}>02</option>
                            <option value="03" {{($edit->rev_no='03')?'selected':''}}>03</option>
                            <option value="04" {{($edit->rev_no='04')?'selected':''}}>04</option>
                            <option value="05" {{($edit->rev_no='05')?'selected':''}}>05</option>
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
                <label for="sops" class="col-sm-2 control-label">Upload Form</label>
                <div class="col-sm-10 ">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Upload File</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-sm pull-right" type="submit">Update</button>
        </form>

    </div>
    <script>
        $('#sops').select2({
            placeholder: 'Select / Search SOP\'s'
        });
    </script>
@endsection


