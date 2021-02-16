@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left"><i class="fa fa-money"></i> General Journal</h3>
            <span class="float-right mt-1">
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#general-ledger">General Ledger</button>
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#trial-balance">Trail Balance</button>
                <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#income-statement">Profit & Loss Statement</button>
                <a href="{{route('journal.ledger')}}" class="btn btn-sm btn-success">General Journal</a>
            </span>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customize ID</th>
                    <th>Account ID</th>
                    <th>Account Title</th>
                    <th>V Type</th>
                    <th>V Date</th>
                    <th>Dr</th>
                    <th>Cr</th>
                    <th>Created By</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Customize ID</th>
                    <th>Account ID</th>
                    <th>Account Title</th>
                    <th>V Type</th>
                    <th>V Date</th>
                    <th>Dr</th>
                    <th>Cr</th>
                    <th>Created By</th>
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

                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{route('journal.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "customize_id"},
                    {"data": "acc_id"},
                    {"data": "acc_title"},
                    {"data": "type"},
                    {"data": "date"},
                    {"data": "cr"},
                    {"data": "dr"},
                    {"data": "created_by"},

                ]
            });
        }

        $(document).ready(function () {
            InitTable();
        });
    </script>

    <div class="modal fade" id="general-ledger" tabindex="-1" role="dialog" aria-labelledby="general-ledger" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="add_session"><i class="fa fa-money"></i> General Ledger</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <small><i class="fa fa-times-circle"></i></small>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('journal.ledger')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="account" class="p-0 m-0"><small>Select Account</small></label>
                                <select class="form-control select_2" id="account" name="account" required  style="width: 100%">
                                    <option selected disabled>Select Account</option>
                                    @foreach($chartofaccounts as $chartofaccount)
                                        <option value="{{$chartofaccount->acc_code}}">{{$chartofaccount->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="daterange" class="p-0 m-0"><small>Select date range</small></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="daterange" id="daterange" value="" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-eye"></i> Show</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="trial-balance" tabindex="-1" role="dialog" aria-labelledby="trial-balance" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="fa fa-money"></i> Trial Balance</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <small><i class="fa fa-times-circle"></i></small>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('trail.balance')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="daterange" class="p-0 m-0"><small>Select Date Range</small></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="daterange" id="daterange" value="" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-eye"></i> Show</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="income-statement" tabindex="-1" role="dialog" aria-labelledby="income-statement" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="fa fa-money"></i> Profit & Loss / Income Statement</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <small><i class="fa fa-times-circle"></i></small>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('journal.income')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="daterange" class="p-0 m-0"><small>Select Date Range</small></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="daterange" id="daterange" value="" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer text-right bg-light">
                    <button class="btn btn-primary btn-sm btn-block" type="submit"><i class="fa fa-eye"></i> Show</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".select_2").select2({
            dropdownParent: $('#general-ledger .modal-dialog .modal-body')
        });
        $(document).ready(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            });
        });
    </script>
@endsection
