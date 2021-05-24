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
                    <th>Business Line</th>
                    <td>{{$show->businessLine->title}}</td>
                </tr>

                <tr>
                    <th>Voucher Type</th>
                    <td class="text-capitalize"> {{str_replace('-',' ',$show->type)}}</td>
                </tr>
                <tr>
                    <th>Voucher Date</th>
                    <td>{{$show->date->format('d-m-Y')}}</td>
                </tr>
                @if($po)
                <tr>
                    <th>PO</th>
                    <td>PO # 00{{$po->id}}</td>
                </tr>
                @endif
                <tr>
                    <th>Created By</th>
                    <td>{{$show->createdby->fname.' '.$show->createdby->lname}}</td>
                </tr>
                <tr>
                    <th>Attachments</th>
                    <td>
                        @foreach($show->attachments as $file)

                            <a href="{{asset('storage/vouchers/'.$show->id.'/'.$file->attachment)}}" download target="_blank"
                               class="btn btn-warning">
                                <i class="fa fa-cloud-download"></i>
                                {{number_format((Storage::disk('local')->size('public/vouchers/'.$show->id.'/'.$file->attachment)/1024),2)}} KBs
                            </a>
                        @endforeach
                    </td>
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
                    <th>Cost Center</th>
                </tr>
                @foreach($show->details as $detail)
                    <tr>
                        <td>{{$detail->acc_code}}</td>
                        <td>{{$detail->account->title}}</td>
                        <td>{{$detail->narration}}</td>
                        <td>{{$detail->dr}}</td>
                        <td>{{$detail->cr}}</td>
                        <td>{{$detail->cc->title}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
