@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Details</h1>
    </div>

    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-bordered table-striped">
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
                    <th>Payment Type</th>
                    <td>{{$show->pay_type}}</td>
                </tr>
                <tr>
                    <th>Payment Way</th>
                    <td>{{$show->pay_way}}</td>
                </tr>
                <tr>
                    <th>Principal Name</th>
                    <td>{{$show->prin_name}}</td>
                </tr>
                <tr>
                    <th>Principal Email</th>
                    <td>{{$show->prin_email}}</td>
                </tr>
                <tr>
                    <th>Principal Phone</th>
                    <td>{{$show->prin_phone_1}}
                        {!!  ($show->prin_phone_2)?"<br>".$show->prin_phone_2:""!!}
                        {!!($show->prin_phone_3)?"<br>".$show->prin_phone_3:""!!}
                    </td>
                </tr>
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
                    <td>{{$show->pur_phone_1}}
                        {!!  ($show->pur_phone_2)?"<br>".$show->pur_phone_2:""!!}
                        {!!($show->pur_phone_3)?"<br>".$show->pur_phone_3:""!!}
                    </td>
                </tr>
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
                    <td>{{$show->acc_phone_1}}
                        {!!  ($show->acc_phone_2)?"<br>".$show->acc_phone_2:""!!}
                        {!!($show->acc_phone_3)?"<br>".$show->acc_phone_3:""!!}
                    </td>
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
@endsection