@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $( document ).ready(function() {
                swal("Failed", "{{session('failed')}}", "error");
            });

        </script>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$show->name}}</h1>

    </div>

    <div class="row pb-3">
        <div class="col-12">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Assets</th>
                    <td>
                    @foreach($show->assets as $asset)
                            <b class="badge badge-primary">{{$asset->name.' ◇ '.$asset->code}}</b>
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Columns</th>
                    <td>
                        @foreach($show->columns as $column)
                            <a data-id="{{$column->id}}" class="edit text-xs mr-5"><i class="fa fa-sync"></i>
                            {{$column->column}}
                            </a>
                        @endforeach
                    </td>
                </tr>


            </table>
        </div>
    </div>
    <div class="modal fade" id="edit_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Column</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_columns_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="edit-id">
                        <div class="row">
                            <div class="form-group col-9">
                                <input type="text" class="form-control" id="edit-column" name="column" placeholder="Column" autocomplete="off" value="">
                            </div>
                            <div class="col-3 text-right">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection