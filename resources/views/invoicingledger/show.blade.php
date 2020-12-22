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
            <div class="card shadow mb-4">
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus-square"></i> Add Receiving</h5>
                </a>
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body">
                        <div class="col-12 text-right">
                            <form action="{{route('receivable_ledger.store')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$show->id}}" name="id">
                                <input type="hidden" value="{{$show->net_receivable}}" name="net_receivable">
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 control-label">Payment Type</label>
                                    <select class="form-control col-md-9" id="type" name="type">
                                        <option selected disabled>Select Payment Type</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Online">Online</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="text-danger"><strong>{{ $errors->first('type') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 control-label">Bank / Payee's Name</label>
                                    <input type="text" class="form-control col-md-9" id="name" name="name" placeholder="Bank / Payee's Name" autocomplete="off" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="number" class="col-sm-3 control-label">Transaction No. / Phone No.</label>
                                    <input type="text" class="form-control col-md-9" id="number" name="number" placeholder="Transaction No. / Phone No." autocomplete="off" value="{{old('number')}}">
                                    @if ($errors->has('number'))
                                        <span class="text-danger"><strong>{{ $errors->first('number') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 control-label">Amount</label>
                                    <input type="text" class="form-control col-md-9" id="amount" name="amount" placeholder="Amount" autocomplete="off" value="{{old('amount')}}">
                                    @if ($errors->has('amount'))
                                        <span class="text-danger"><strong>{{ $errors->first('amount') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 control-label">Date</label>
                                    <input type="date" class="form-control col-md-9" id="date" name="date" value="{{date('Y-m-d')}}">
                                    @if ($errors->has('date'))
                                        <span class="text-danger"><strong>{{ $errors->first('date') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                                    <textarea type="date" class="form-control col-md-9" id="remarks" name="remarks" placeholder="Remarks" rows="5">{{old('remarks')}}</textarea>
                                    @if ($errors->has('remarks'))
                                        <span class="text-danger"><strong>{{ $errors->first('remarks') }}</strong></span>
                                    @endif
                                </div>

                                <button class="btn btn-danger" type="submit"><i class="fa fa-plus"></i> Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <div class="d-sm-flex mb-4">
                <h1 class="h3 mb-0 text-gray-800">Invoicing Ledger Details</h1>
            </div>
            <table class="table table-bordered table-striped table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$show->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Service Charges</th>
                    <td>{{$show->service_charges}}</td>
                </tr>
                <tr>
                    <th>Service Tax </th>
                    <th>
                        {{\App\Models\Preference::find($show->service_tax_type)->name}} ▶
                        {{$show->service_tax_percent}}% ▶
                        {{$show->service_tax_amount}}

                    </th>
                </tr>
                <tr>
                    <th>Service Tax </th>
                    <td>
                        {{$show->service_tax_deducted}}
                    </td>
                </tr>
                <tr>
                    <th>Income Tax</th>
                    <th>{{$show->income_tax_percent}}% ▶
                        {{$show->income_tax_amount}}</th>
                </tr>
                <tr>
                    <th>Income Tax </th>
                    <th>
                        {{$show->income_tax_deducted}}
                    </th>
                </tr>

                <tr>
                    <th>Invoice Date</th>
                    <td>{{date('d-M-Y',strtotime($show->invoice))}}</td>
                </tr>
                <tr>
                    <th>Net Receivable</th>
                    <td>{{$show->net_receivable}}</td>
                </tr>

                <tr>
                    <th>Confirmed By</th>
                    <td>{{$show->confirmed_by_name}} ▶ {{$show->confirmed_by_phone}}</td>
                </tr>

                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>

        </div>
    </div>

    <div class="row pb-3">
        <div class="d-sm-flex mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Receiving </h1>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Payment Way</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                @foreach($receivings as $receiving)
                    <tr>
                        <td>{{$receiving->payment_way}}</td>
                        <td>{{$receiving->name}}</td>
                        <td>{{$receiving->amount}}</td>
                        <td>{{$receiving->number}}</td>
                        <td>{{$receiving->date}}</td>
                        <td>{{$receiving->remarks}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection