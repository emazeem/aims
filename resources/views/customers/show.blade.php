<div class="modal fade" id="show-customer" tabindex="-1" role="dialog" aria-labelledby="show-customer" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="show-customer"> <i class="fa fa-eye"></i> Show Customer</h5>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table text-dark table-sm bg-white table-bordered table-responsive-sm table-hover font-13 customer-show">

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
                success: function(data)
                {
                    $('#show-customer').modal('toggle');
                    $('.customer-show').empty();
                    $('.customer-show').append(
                        "<tr><th>Registration Name</th><td>" + data.reg_name + "</td></tr>"+
                        "<tr><th>NTN/FTN</th><td>" + data.ntn + "</td></tr>"+
                        "<tr><th>Ship to Address</th><td>" + data.address + "</td></tr>"+
                        "<tr><th>Bill to Address</th><td>" + data.bill_to_address + "</td></tr>"+
                        "<tr><th>Payment Type</th><td class='text-capitalize'>" + data.customer_type + "</td></tr>"+
                        "<tr><th>Payment Terms</th><td class='text-capitalize'>" + data.pay_terms + "</td></tr>"+
                        "<tr><th>Credit Limit</th><td>" + data.credit_limit + "</td></tr>"+
                        "<tr><th>Industry</th><td>" + data.industry + "</td></tr>"+
                        "<tr><th>Plant</th><td>" + data.plant + "</td></tr>"+
                        "<tr><th>Region</th><td>" + data.region + "</td></tr>"+
                        "<tr><th>Tax Case</th><td>" + data.tax_case + "</td></tr>"+
                        "<tr><th>Principal Name</th><td>" + data.prin_name + "</td></tr>"+
                        "<tr><th>Principal Email</th><td>" + data.prin_email + "</td></tr>"+
                        "<tr><th>Principal Phone</th><td>" + data.prin_phone + "</td></tr>"
                    );
                    if (data.pur_name){
                        $('.customer-show').append(
                            "<tr><th>Purchase Name</th><td>" + data.pur_name + "</td></tr>"
                        );
                    }
                    if (data.pur_email){
                        $('.customer-show').append(
                            "<tr><th>Purchase Email</th><td>" + data.pur_email + "</td></tr>"
                        );
                    }
                    if (data.pur_phone){
                        $('.customer-show').append(
                            "<tr><th>Purchase Phone</th><td>" + data.pur_phone + "</td></tr>"
                        );
                    }

                    if (data.acc_name){
                        $('.customer-show').append(
                            "<tr><th>Account Name</th><td>" + data.acc_name + "</td></tr>"

                        );
                    }

                    if (data.acc_email){
                        $('.customer-show').append(
                            "<tr><th>Account Email</th><td>" + data.acc_email + "</td></tr>"
                        );
                    }

                    if (data.acc_phone){
                        $('.customer-show').append(
                            "<tr><th>Account Phone</th><td>" + data.acc_phone + "</td></tr>");
                    }

                }
            });
        });
    });
</script>