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
    <div class="row pb-3">
        <div class="col-12">
            <h4>{{$show->name}}</h4>
            <table class="table table-bordered table-responsive-sm table-sm bg-white table-hover font-13">
            <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{$show->description}}</td>
                </tr>
                <tr>
                    <th>Uncertainties</th>
                    <td>
                        @foreach(explode(',',$show->uncertainties) as $uncertainty)
                            <div class="badge badge-danger">
                                {{\App\Models\Uncertainty::where('slug',$uncertainty)->first()->name}}
                            </div>
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