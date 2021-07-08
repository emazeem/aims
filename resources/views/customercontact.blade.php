<script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.add-contact-customer-select-2').select2();
        InitTable();
        $(document).on('click', '.delete-contact', function (e) {
            swal({
                title: "Are you sure to delete this customer's contact?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        e.preventDefault();
                        $.ajax({
                            url: "{{route('customers.contact.destroy')}}",
                            type: "DELETE",
                            dataType: "JSON",
                            data: {'id': id, _token: '{{csrf_token()}}'},
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    $('#'+id).remove();
                                });

                            },
                            error: function (xhr) {
                                var error = '';
                                $.each(xhr.responseJSON.errors, function (key, item) {
                                    error += item;
                                });
                                swal("Failed", error, "error");
                            },
                        });

                    }
                });

        });
        $("#add_contact_form").on('submit',(function(e) {
            e.preventDefault();
            var button=$('.add-contact-btn');
            var previous=$('.add-contact-btn').html();
            button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

            $.ajax({
                url: "{{route('customers.contact.store')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    button.attr('disabled',null).html(previous);
                    swal('success',data.success,'success').then((value) => {
                        $('#add_contact').modal('hide');
                        $("#example").DataTable().ajax.reload(null, false);
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
<div class="modal fade" id="add_contact" tabindex="-1" role="dialog" aria-labelledby="addContactCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-light" id="addContactModalCenterTitle"><i class="feather icon-plus-circle"></i> Add Customer Contact</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add_contact_form">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="add_contact_customer">Customer</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control add-contact-customer-select-2" style="width: 100%" id="add_contact_customer" name="add_contact_customer">
                                    <option selected disabled="disabled">--Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->reg_name}} - {{$customer->plant}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <label for="add_contact_type">Type</label>
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="add_contact_type" name="add_contact_type">
                                    <option selected disabled="disabled">--Select Type</option>
                                    <option value="principal">Principal</option>
                                    <option value="purchase">Purchase</option>
                                    <option value="account">Account</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="add_contact_name">Name</label>
                            <input type="text" class="form-control" id="add_contact_name" name="add_contact_name" placeholder="Name">
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="add_contact_email">Email</label>
                            <input type="email" class="form-control" id="add_contact_email" name="add_contact_email" placeholder="Email">
                        </div>
                        <div class="form-group col-12  float-left">
                            <label for="add_contact_phone">Phone</label>
                            <input type="text" class="form-control" id="add_contact_phone" name="add_contact_phone" placeholder="Phone">
                        </div>
                    </div>

            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-primary add-contact-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

