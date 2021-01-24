@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif

    <div class="row">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-tasks"></i> Customer Details</h3>
            <div class="text-md-right">
                <a href="" class="btn btn-sm btn-success shadow-sm mt-1"><i class="fa fa-eye"></i> Customer Ledger</a>
                <a href="" class="btn btn-sm btn-success shadow-sm mt-1"><i class="fa fa-eye"></i> Receivable Aging Ledger</a>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm table-hover font-13">
                <tr>
                    <th>Registration Name</th>
                    <td>{{$show->reg_name}}</td>
                </tr>
                <tr>
                    <th>NTN/FTN</th>
                    <td>{{$show->ntn}}</td>
                </tr>
                <tr>
                    <th>Physical Address</th>
                    <td>{{$show->address}}</td>
                </tr>
                <tr>
                    <th>Customer Type</th>
                    <td class="text-capitalize">{{$show->customer_type}}</td>
                </tr>
                <tr>
                    <th>Payment Terms</th>
                    <td>{{$show->pay_terms}}</td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{\App\Models\Preference::find($show->region)->name}}</td>
                </tr>

                <tr>
                    <th>01-Principal Name</th>
                    <td>
                        @foreach(explode(',',$show->prin_name) as $item)
                            <span class="badge badge-success">{{$item}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>01-Principal Email</th>
                    <td>
                        @foreach(explode(',',$show->prin_email) as $item)
                            <span class="badge badge-success">{{$item}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>01-Principal Phone</th>
                    <td>
                        @foreach(explode(',',$show->prin_phone) as $item)
                            <span class="badge badge-success">{{$item}}</span>
                        @endforeach
                    </td>
                </tr>
                @if($show->prin_name_2)
                    <tr>
                        <th>02-Principal Name</th>
                        <td>{{$show->prin_name_2}}</td>
                    </tr>
                    <tr>
                        <th>02-Principal Email</th>
                        <td>{{$show->prin_email_2}}</td>
                    </tr>
                    <tr>
                        <th>02-Principal Phone</th>
                        <td>{{$show->prin_phone_2}}</td>
                    </tr>
                @endif
                @if($show->prin_name_3)
                    <tr>
                        <th>03-Principal Name</th>
                        <td>{{$show->prin_name_3}}</td>
                    </tr>
                    <tr>
                        <th>03-Principal Email</th>
                        <td>{{$show->prin_email_3}}</td>
                    </tr>
                    <tr>
                        <th>03-Principal Phone</th>
                        <td>{{$show->prin_phone_3}}</td>
                    </tr>
                @endif

                @if($show->pur_name)
                    <tr>
                        <th>Purchase Name</th>
                        <td>{{$show->pur_name}}</td>
                    </tr>
                    <tr>
                        <th>Purchase Email</th>
                        <td>{{$show->pur_email}}</td>
                    </tr>
                    <tr>
                        <th>Purchase Phone</th>
                        <td>{{$show->pur_phone}}</td>
                    </tr>
                @endif
                @if($show->acc_name)
                    <tr>
                        <th>Account Name</th>
                        <td>{{$show->acc_name}}</td>
                    </tr>
                    <tr>
                        <th>Account Email</th>
                        <td>{{$show->acc_email}}</td>
                    </tr>
                    <tr>
                        <th>Account Phone</th>
                        <td>{{$show->acc_phone}}
                        </td>
                    </tr>
                @endif
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


@endsection