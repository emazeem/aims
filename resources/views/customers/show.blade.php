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
                        "<tr><td>Registration Name</td><td>" + data.reg_name + "</td></tr>"+
                        "<tr><td>NTN/FTN</td><td>" + data.ntn + "</td></tr>"+
                        "<tr><td>Ship to Address</td><td>" + data.address + "</td></tr>"+
                        "<tr><td>Bill to Address</td><td>" + data.bill_to_address + "</td></tr>"+
                        "<tr><td>Region</td><td>" + data.region + "</td></tr>"+
                        "<tr><td>Tax Case</td><td>" + data.tax_case + "</td></tr>"+
                        "<tr><td>Principal Name</td><td>" + data.prin_name + "</td></tr>"+
                        "<tr><td>Principal Email</td><td>" + data.prin_email + "</td></tr>"+
                        "<tr><td>Principal Phone</td><td>" + data.prin_email + "</td></tr>"
                    );
                    if (data.pur_name){
                        $('.customer-show').append(
                            "<tr><td>Purchase Name</td><td>" + data.pur_name + "</td></tr>"
                        );
                    }
                    if (data.pur_email){
                        $('.customer-show').append(
                            "<tr><td>Purchase Email</td><td>" + data.pur_email + "</td></tr>"
                        );
                    }
                    if (data.pur_phone){
                        $('.customer-show').append(
                            "<tr><td>Purchase Phone</td><td>" + data.pur_phone + "</td></tr>"
                        );
                    }

                    if (data.acc_name){
                        $('.customer-show').append(
                            "<tr><td>Account Name</td><td>" + data.acc_name + "</td></tr>"

                        );
                    }

                    if (data.acc_email){
                        $('.customer-show').append(
                            "<tr><td>Account Email</td><td>" + data.acc_email + "</td></tr>"
                        );
                    }

                    if (data.acc_phone){
                        $('.customer-show').append(
                            "<tr><td>Account Phone</td><td>" + data.acc_phone + "</td></tr>");
                    }

                }
            });
        });
    });
</script>