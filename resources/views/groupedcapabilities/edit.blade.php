@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="float-left font-weight-light"><i class="feather icon-edit"></i> Edit Grouped Capabilities</h3>
        </div>
        <div class="col-12">
            <form id="edit_capabilities_form" class="form-horizontal row">
                @csrf
                <input type="hidden" value="{{$edit->id}}" name="id">
                <div class="form-group col-6 p-1 m-0">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$edit->name}}">
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="category" class="control-label">Parameter</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control select-2-capability" style="width: 100%" id="parameter" name="parameter">
                            <option selected disabled>--Select Parameter</option>
                            <option value="{{\App\Models\Parameter::find(14)->id}}" {{$edit->parameter==14?'selected':''}}>{{\App\Models\Parameter::find(14)->name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="remarks" class=" control-label">Remarks</label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks',$edit->remarks)}}">
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="location" class=" control-label">Location</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="location" name="location">
                            <option selected disabled>Select Location</option>
                            <option value="site" {{$edit->location=="site"?'selected':''}}>site</option>
                            <option value="lab" {{$edit->location=="lab"?'selected':''}}>lab</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-12 p-1 m-0">
                    <label for="underlying" class=" control-label">Underlying Capabilities</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control js-example-basic-multiple" style="width: 100%" id="underlying" name="underlying[]" multiple>
                            @foreach(\App\Models\Capabilities::orderBy('name','ASC')->get() as $item)
                                <option value="{{$item->id}}" {{in_array($item->id,$underlying)?'selected':''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 text-right">
                    <button type="submit" class="btn cap-update-btn btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $("#edit_capabilities_form").on('submit',(function(e) {
                var button=$('.cap-update-btn');
                var previous=$('.cap-update-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                e.preventDefault();
                $.ajax({
                    url: "{{route('grouped.capabilities.update')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            window.location.href = '{{URL::previous()}}';
                        });

                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });

                        swal("Failed", error, "error");
                    }
                });
            }));
        });
    </script>
@endsection


