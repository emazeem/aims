@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Item Entries</h2>
    </div>
    <form id="add_details_form">
        @csrf
        <div class="row">
            <input type="hidden" value="{{$show->id}}" id="add_id" name="id" >
            <div class="form-group col-md-8 col-12 float-left">
                <label for="eq_id">Equipment ID</label>
                <input type="text" class="form-control " id="eq_id" name="eq_id" placeholder="Equipment ID"
                       autocomplete="off" value="{{$show->eq_id}}">
            </div>
            <div class="form-group col-md-8 col-12  float-left">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model" autocomplete="off"
                       value="{{$show->model}}">
            </div>
            <div class="form-group col-md-8 col-12  float-left">
                <label for="accessories">Accessories</label>
                <input type="text" class="form-control" id="model" name="accessories" placeholder="Accessories"
                       autocomplete="off" value="{{$show->accessories}}">
            </div>
            <div class="form-group col-md-8 col-12  float-left">
                <label for="visualinspection">Visual Inspection</label>
                <input type="text" class="form-control" id="visualinspection" name="visualinspection"
                       placeholder="Visual Inspection" autocomplete="off" value="{{$show->visual_inspection}}">
            </div>
            <div class="col-md-8 col-12 text-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {

            $("#add_details_form").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('checkin.store')}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (!data.errors) {
                            swal('success',data.success,'success').then((value) => {
                                location.reload();
                            });
                        }
                    },
                    error: function (e) {
                        swal("Failed", "Fields Required. Try again.", "error");

                    }
                });
            }));
        });
    </script>
@endsection


