@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <h3 class="float-left font-weight-light pb-1"><i class="feather icon-list"></i> Check In / Out</h3>
            <table id="example" class="table table-bordered bg-white table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{$show->cid}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$show->plan->jobs->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Job</th>
                    <td>{{$show->plan->jobs->cid}}</td>
                </tr>
                @if(count($show->plan->jobs->quotes->attachments)>0)
                    <tr>
                        <td>Quote Attachments</td>
                        <td>
                            @foreach($show->plan->jobs->quotes->attachments as $attachment)
                                <div class="row border-bottom">
                                    <div class="col-2"><a class="btn">{{$attachment->title}}</a></div>
                                    <div class="col">
                                        <a href="{{Storage::disk('local')->url('public/quote-attachments/'.$attachment->attachment)}}" target="_blank" class="btn">
                                            <i class="feather icon-file"></i>
                                            {{substr($attachment->attachment,10)}} ( {{number_format((Storage::disk('local')->size('public/quote-attachments/'.$attachment->attachment)/1024),2)}} KBs )
                                        </a>
                                        <style>.delete-attachment{cursor: pointer}</style>
                                        <i data-id="{{$attachment->id}}" class="delete-attachment feather icon-x text-danger"></i>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>Date Out</th>
                    <td>{{$show->out->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <th>Time Out</th>
                    <td>{{$show->out->format('h:i A')}}</td>
                </tr>
                <tr>
                    <th>Items Received By</th>
                    <td>{{$show->outreceivedby->fname.' '.$show->outreceivedby->lname}}</td>
                </tr>

            </table>
            <h4 class="float-left font-weight-light pb-1"><i class="feather icon-list"></i> Items</h4>

        </div>
        <div class="col-12 table-responsive">
            <table class="table table-bordered bg-white table-hover table-sm">
                <thead>
                <tr>
                    <th class="p-1">Asset</th>
                    <th class="p-1">Out</th>
                    <th class="p-1">In</th>
                    <th class="p-1">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($show->gpitems as $gpitem)
                    <tr>
                        <td class="p-1">{{$gpitem->items->name}}</td>
                        <td class="p-1">
                            @if($gpitem->out_fcb!=null)
                                <b>OUT Function Check Value : </b>{{$gpitem->out_fcv}}<br>
                                <b>OUT Status : </b>{{$gpitem->out_status}}<br>
                                <b>OUT Function Check By : </b>{{$gpitem->fcbout->fname.' '.$gpitem->fcbout->lname}}<br>
                            @endif

                        </td>
                        <td class="p-1">
                            @if($gpitem->in_fcb!=null)
                                <b>IN Function Check Value : </b>{{$gpitem->in_fcv}}<br>
                                <b>IN Out Status : </b>{{$gpitem->in_status}}<br>
                                <b>IN Function Check By : </b>{{$gpitem->fcbin->fname.' '.$gpitem->fcbin->lname}}<br>
                            @endif

                        </td>
                        <td class="p-1">
                            <button class="btn btn-sm btn-success checkout-item" data-asset="{{$gpitem->items->name}}" data-id="{{$gpitem->id}}"> Check-Out <i class="feather icon-chevron-up"></i></button>
                            <button class="btn btn-sm btn-danger checkin-item" data-asset="{{$gpitem->items->name}}" data-id="{{$gpitem->id}}"> Check-In <i class="feather icon-chevron-down"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('gp_items_in_out.create')
@endsection


