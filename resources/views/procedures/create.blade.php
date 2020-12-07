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
            <h2>Add Procedure</h2>
            <form id="add_procedure_form">
                @csrf

                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-2 control-label">
                        <h6 class="font-italic">Name of Procedure</h6>
                    </label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                               autocomplete="off" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="name" class="col-2 control-label">
                        <h6 class="font-italic">Short Description</h6>
                    </label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Short Description of Procedure"
                               autocomplete="off" value="{{old('description')}}">
                        @if ($errors->has('description'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <h5 class="font-italic">Select Uncertainties of Procedure</h5>
                <table class="table table-bordered table-sm table-striped">
                    @foreach($uncertainties as $uncertainty)
                        <tr>
                            <td class="text-center">
                                <div class="checkbox mt-2">
                                    <input type="checkbox" value="{{$uncertainty->slug}}" name="uncertainties[]">
                                </div>
                            </td>
                            <td>
                                <label class="custom-label">
                                    <span class="text-lg">{{$uncertainty->name}}</span>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if ($errors->has('uncertainties'))
                    <span class="text-danger">
                          <strong>{{ $errors->first('uncertainties') }}</strong>
                      </span>
                @endif
                <div class="col-12 mt-2 text-right">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#add_procedure_form").on('submit',(function(e) {

            e.preventDefault();
            $.ajax({
                url: "{{route('procedures.store')}}",
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
                    swal('success',data.success,'success').then((value) => {
                        location.reload();
                    });

                },
                error: function(xhr, status, error)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));

    </script>
@endsection






