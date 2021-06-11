@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="float-left font-weight-light"><i class="feather icon-plus-circle"></i> Add Grouped Capabilities</h3>
        </div>
        <div class="col-12">
            <form id="add_capabilities_form" class="form-horizontal row">
                @csrf
                <div class="form-group col-6 p-1 m-0">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="category" class="control-label">Parameter</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control select-2-capability" style="width: 100%" id="parameter" name="parameter">
                            <option selected disabled>--Select Parameter</option>
                            <option value="{{\App\Models\Parameter::find(14)->id}}">{{\App\Models\Parameter::find(14)->name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="remarks" class=" control-label">Remarks</label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{old('remarks')}}">
                </div>
                <div class="form-group col-6 p-1 m-0">
                    <label for="location" class=" control-label">Location</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control" id="location" name="location">
                            <option selected disabled>Select Location</option>
                            <option value="site">site</option>
                            <option value="lab">lab</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-12 p-1 m-0">
                    <label for="underlying" class=" control-label">Underlying Capabilities</label>
                    <div class="form-check form-check-inline" style="width: 100%">
                        <select class="form-control js-example-basic-multiple" style="width: 100%" id="underlying" name="underlying[]" multiple>
                            @foreach(\App\Models\Capabilities::orderBy('name','ASC')->where('parameter',14)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 text-right">
                    <button type="submit" class="btn cap-save-btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $("#add_capabilities_form").on('submit',(function(e) {
                var button=$('.cap-save-btn');
                var previous=$('.cap-save-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                e.preventDefault();
                $.ajax({
                    url: "{{route('grouped.capabilities.store')}}",
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
                            $('#add_capabilities').modal('hide');
                            $("#example").DataTable().ajax.reload(null,false);
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


