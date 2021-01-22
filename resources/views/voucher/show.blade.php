@extends('layouts.master')
@section('content')

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Voucher # {{$show->id}}
            </h3>
            <span class="float-right">
            <a href="{{route('vouchers.print',[$show->id])}}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
            </span>
        </div>
        <div class="col-12">

            <table class="table table-hover table-sm font-13 table-bordered bg-white">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Customize ID</th>
                    <td>{{$show->customize_id}}</td>
                </tr>
                <tr>
                    <th>Voucher Type</th>
                    <td class="text-capitalize"> {{str_replace('-',' ',$show->v_type)}} Voucher</td>
                </tr>
                <tr>
                    <th>Voucher Date</th>
                    <td>{{$show->v_date->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{$show->createdby->fname.' '.$show->createdby->lname}}</td>
                </tr>
            </table>
        </div>
        <div class="col-12">
            <h4 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Voucher Details
            </h4>
            <table class="table table-hover table-sm font-13 table-bordered bg-white">
                <tr>
                    <th>Account Code</th>
                    <th>Account Title</th>
                    <th>Narration</th>
                    <th>Dr.</th>
                    <th>Cr.</th>
                </tr>
                @foreach($show->details as $detail)
                    <tr>
                        <td>{{$detail->account->acc_code}}</td>
                        <td>{{$detail->account->title}}</td>
                        <td>{{$detail->narration}}</td>
                        <td>{{$detail->dr}}</td>
                        <td>{{$detail->cr}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
