<script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#add_na_form").on('submit',(function(e) {
            var button=$('.non-listed-add-btn');
            var previous=$('.non-listed-add-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');
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
                    button.attr('disabled',null).html(previous);
                    $('#add_na').modal('hide');
                    swal('success', data.success, 'success').then((value) => {
                        location.reload();
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
                <button class="btn btn-primary btn-sm non-listed-add-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
