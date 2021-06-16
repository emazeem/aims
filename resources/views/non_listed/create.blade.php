<script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#add_nofacility_items_form").on('submit',(function(e) {
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
    })
</script>
<div class="modal fade" id="add_nofacility_items" tabindex="-1" role="dialog" aria-labelledby="add_nofacility_items" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="add_nofacility_items"><i class="feather icon-plus-circle"></i> Add No Facility Items.</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_nofacility_items_form">
                    @csrf
                    <input type="hidden" value="3" name="non_listed">
                    <input type="hidden" value="{{$show->id}}" name="quote_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control " id="nocapability" name="nocapability">
                                    <option selected disabled>--Select No Capability</option>
                                    @foreach(\App\Models\Nofacility::all() as $nofacility)
                                        <option value="{{$nofacility->id}}">{{$nofacility->capability}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="quantity"></label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Qty" autocomplete="off" value="{{old('quantity')}}">
                        </div>
                        <div class="col-sm-8 text-right pt-4">
                            <button class="btn btn-primary btn-sm non-listed-add-btn" type="submit"><i class="fa fa-save"></i> Save</button>


                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
