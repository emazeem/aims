@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row">

        <div class="col-12">
                <h3 class="border-bottom text-dark pull-left"><i class="fa fa-dollar"></i> Invoicing Ledger</h3>
                <span>
                <a href="{{url('invoicing-ledger/create/1')}}" class="btn btn-success btn-sm float-right mt-2"><i class="fa fa-check-circle"></i></a>
                <a href="{{route('pra')}}" class="btn btn-outline-secondary btn-sm float-right mt-2"><small><i class="fa fa-print"></i> PRA</small></a>
            </span>
        </div>
        <div class="col-12">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger font-weight-bold">{{$error}}</div>
                @endforeach
            @endif
            <div class="card shadow mb-4">

                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0"> Advance Filter <i class="fa fa-search"></i></h6>
                </a>
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body">
                        <div class="col-12 text-right">
                            <form action="{{route('clear.filter')}}" method="post">
                                @csrf
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Clear Filter</button>
                            </form>
                        </div>
                        <form method="post" action="{{route('search')}}" role="form">
                            @csrf
                            <div class="form-group row">
                                <div class="form-check ml-md-5">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="show" value="customer_radio">Customer
                                    </label>
                                    <label class="form-check-label ml-md-5">
                                        <input type="radio" class="form-check-input" name="show" value="tax_radio">Tax
                                    </label>
                                    <label class="form-check-label ml-md-5">
                                        <input type="radio" class="form-check-input" name="show" value="none_radio">None
                                    </label>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="daterange" class="col-sm-2 control-label">Select date range</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="daterange" id="daterange" value="{{$oldest}} - {{$latest}}" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="customer_div" style="display: none">
                                <label for="customer" class="col-sm-2 control-label">Customer</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="customer" name="customer">
                                        <option selected disabled>Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->reg_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="taxtype_div" style="display: none">
                                <div class="form-group row">
                                    <label for="taxtype" class="col-sm-2 control-label">Tax Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="taxtype" name="taxtype">
                                            <option selected disabled>Select Text Type</option>
                                            <option value="service">Service Tax</option>
                                            <option value="income">Income Tax</option>
                                        </select>
                                        @if ($errors->has('taxtype'))
                                            <span class="text-danger">
                                        <strong>{{ $errors->first('taxtype') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <label for="taxby" class="col-sm-2 control-label">Tax payed/deducted</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="taxby" name="taxby">
                                            <option selected disabled>Tax payed/deducted</option>
                                            <option value="AIMS">By AIMS</option>
                                            <option value="Source">At Source</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div id="service_div" style="display: none">
                                <div class="form-group row">
                                    <label for="region" class="col-sm-2 control-label">Select region</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline" style="width: 100%">
                                            <select class="form-control" id="region" name="region">
                                                <option selected disabled>Select region</option>
                                                <option value="PRA">PRA</option>
                                                <option value="SRB">SRB</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Job<br>#</th>
                    <th>Services<br> Charges</th>
                    <th>Services<br> Tax Type</th>
                    <th>Services<br> Tax Amount</th>
                    <th>Income Tax<br> Amount</th>
                    <th>Service Tax <br>Payed</th>
                    <th>Income Tax <br>Payed</th>
                    <th>Net <br>Receivable</th>
                    <th>Invoice <br>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Job<br>#</th>
                    <th>Services<br> Charges</th>
                    <th>Services<br> Tax Type</th>
                    <th>Services<br> Tax Amount</th>
                    <th>Income Tax<br> Amount</th>
                    <th>Service Tax <br>Payed</th>
                    <th>Income Tax <br>Payed</th>
                    <th>Net <br>Receivable</th>
                    <th>Invoice <br>Date</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>

        function InitTable() {
            $(".loading").fadeIn();

            $('#example').DataTable({

                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'desc']],
                "lengthMenu": [[-1], ["All"]],
                "ajax":{
                    "url": "{{ route('invoicing_ledger.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "customer" },
                    { "data": "job_id" },
                    { "data": "service_charges" },
                    { "data": "services_tax_type" },
                    { "data": "services_tax_amount" },
                    { "data": "income_tax_amount" },
                    { "data": "service_tax_deducted" },
                    { "data": "income_tax_deducted" },
                    { "data": "net_receivable" },
                    { "data": "invoice" },
                    { "data": "options" ,"orderable":false},
                ]
            });
        }
        $(document).ready(function() {
            InitTable();

            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            $("input[name$='show']").click(function(){
                if ($(this).val()=='customer_radio'){
                    $('#customer_div').show();
                    $('#taxtype_div').hide();
                    $('#service_div').hide();
                }
                if ($(this).val()=='tax_radio'){
                    $('#customer_div').hide();
                    $('#taxtype_div').show();
                }
                if ($(this).val()=='none_radio'){
                    $('#customer_div').hide();
                    $('#taxtype_div').hide();
                }
            });
            $('#taxtype').on('change', function() {
                if (this.value=='service'){
                    $('#service_div').show();
                }
                if (this.value=='income'){
                    $('#service_div').hide();
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection