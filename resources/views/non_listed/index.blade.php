<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#add_na_form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('items.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#add_na').modal('hide');
                    swal('success', data.success, 'success').then((value) => {
                        location.reload();
                    });
                },
                error: function(xhr)
                {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");

                }
            });
        }));
        $("#edit_na_form").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('items.updateNA')}}",
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

                    if (!data.errors) {
                        swal('success', data.success, 'success').then((value) => {
                            location.reload();
                        });

                        InitTable();
                    }
                },
                error: function (xhr) {
                    var error='';
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        error+=item;
                    });
                    swal("Failed", error, "error");
                }
            });
        }));
        $(document).on('click', '.edit-na', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{url('/items/editNA')}}",
                type: "POST",
                data: {'id': id, _token: '{{csrf_token()}}'},
                dataType: "json",
                beforeSend: function () {
                    $(".loading").fadeIn();
                },
                statusCode: {
                    403: function () {
                        $(".loading").fadeOut();
                        swal("Failed", "Permission deneid for this action.", "error");
                        return false;
                    }
                },
                success: function (data) {
                    $('#edit_na').modal('toggle');
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.not_available);
                    $('#edit_quantity').val(data.quantity);
                    $('#edit_parameter').val(data.parameter);
                    //Populating Form Data to Edit Ends
                },
                error: function () {
                },
            });
        });

    })
</script>

<div class="modal fade" id="add_na" tabindex="-1" role="dialog" aria-labelledby="add_na" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_na"><i class="fa fa-plus-square"></i> Add Misc.</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_na_form">
                    @csrf
                    <input type="hidden" value="1" name="non_listed">
                    <input type="hidden" value="{{$show->id}}" name="quote_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control " id="parameter" name="parameter">
                                    <option selected disabled>--Select Parameter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <label for="name">Capability</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Put capability name (not listed)" autocomplete="off" value="{{old('name')}}">
                        </div>
                        <div class="col-sm-4">
                            <label for="quantity">Qty</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-0 p-2">
                <button class="btn btn-primary btn-sm " type="submit"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_na" tabindex="-1" role="dialog" aria-labelledby="edit_na" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_na"><i class="fa fa-edit"></i> Edit Misc.</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_na_form">
                    @csrf
                    <input type="hidden" value="" name="id" id="edit_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control " id="edit_parameter" name="parameter">
                                    <option selected disabled>--Select Parameter</option>
                                    @foreach($parameters as $parameter)
                                        <option value="{{$parameter->id}}">{{$parameter->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <label for="name">Capability</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                   placeholder="Put capability name (not listed)" autocomplete="off"
                                   value="{{old('name')}}">
                        </div>
                        <div class="col-sm-4">
                            <label for="quantity">Qty</label>
                            <input type="number" class="form-control" id="edit_quantity" name="quantity"
                                   placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer m-0 py-2">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-refresh"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
