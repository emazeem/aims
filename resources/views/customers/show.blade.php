<div class="modal fade" id="show-customer" tabindex="-1" role="dialog" aria-labelledby="show-customer" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-light" id="show-customer"> <i class="feather icon-plus-circle"></i> Show Customer</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <i class="feather icon-x-circle"></i>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table text-dark table-sm bg-white table-bordered table-hover font-13 customer-show">

                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.view-customer', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            $.ajax({
                "url": "{{route('customers.show')}}",
                type: "POST",
                data: {'id': id,_token: '{{csrf_token()}}'},
                dataType : "json",
                beforeSend : function()
                {
                    $(".loader-gif").fadeIn();
                },
                success: function(data)
                {
                    $(".loader-gif").hide();
                    $('#show-customer').modal('toggle');
                    $('.customer-show').empty();
                    $('.customer-show').append(
                        "<tr><th class='p-md-2 px-0'>Registration Name</th><td>" + data.reg_name + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>NTN/FTN</th><td>" + data.ntn + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Ship to Address</th><td>" + data.address + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Bill to Address</th><td>" + data.bill_to_address + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Payment Type</th><td class='text-capitalize'>" + data.customer_type + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Payment Terms</th><td class='text-capitalize'>" + data.pay_terms + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Credit Limit</th><td>" + data.credit_limit + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Industry</th><td>" + data.industry + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Plant</th><td>" + data.plant + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Region</th><td>" + data.region + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Tax Case</th><td>" + data.tax_case + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Account #</th><td>" + data.acc_code + "</td></tr>"+
                        "<tr><th class='p-md-2 px-0'>Allowance Applicable</th><td>" + data.allowance_applicable + "</td></tr>"
                    );
                    $.each(data['contacts'], function (index, contact) {
                        var phone = (contact.phone) ? " > "+contact.phone : "" ;
                        var email = (contact.email) ? " > "+contact.email : "" ;
                        $('.customer-show').append(
                            "<tr id='"+contact.id+"'><th class='text-capitalize p-md-2 px-0'>"+contact.type+" </th><td>" + contact.name  + phone + email + " <i data-id='"+contact.id+"' style='cursor: pointer' class='delete-contact feather icon-delete text-danger'></i></td></tr>"
                        );
                    })

                }
            });
        });
    });
</script>