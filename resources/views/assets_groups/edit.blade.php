@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <h2 class="border-bottom text-dark">Edit Asset Groups</h2>
    <form action="{{route('assets.groups.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$assetGroup->id}}"/>
        <div class="row">
            <div class="col-12 mb-1">
                <div class="form-check form-check-inline" style="width: 100%">
                    <select class="form-control" id="parameter" name="parameter">
                        <option selected disabled="">Select Parameter</option>
                        @foreach($parameters as $parameter)
                            <option value="{{$parameter->id}}" {{($assetGroup->parameter==$parameter->id)?'selected':''}}>{{$parameter->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-12 float-left">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{old('name',$assetGroup->name)}}">
            </div>
            <div class="form-group col-12">
                <div class="form-check form-check-inline col-12" style="width:100%;">
                    <select class="form-control" multiple id="assets" name="assets[]" style="width:100%;">
                        @foreach($assets as $asset)
                            <option value="{{$asset->id}}" {{(in_array($asset->id,$assigned_assets)?'selected':'')}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}
                                -{{$asset->resolution}}-{{$asset->accuracy}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
    <script>
        $('#assets').select2({
            placeholder: 'Select/Search Assets'
        });

        $("#add_asset_group_form").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('assets.groups.store')}}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                statusCode: {
                    403: function () {
                        $(".loading").fadeOut();
                        swal("Failed", "Access Denied", "error");
                        return false;
                    }
                },
                success: function (data) {
                    swal('success', data.success, 'success').then((value) => {
                        location.reload();
                    });

                },
                error: function (xhr, status, error) {
                    var error = '';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error += item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
    </script>
@endsection


