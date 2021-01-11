
@extends('layouts.master')
@section('content')

    <style>
        .bg-custom-unread-notification{
            background: #ceceff;
            border: 1px solid #c4c4ff;
        }
        .hover-notification:hover{
            background-color: #C4C4FF;
        }
    </style>
    <div class="col-12 row">
        <div class="row">
            <h3 class="border-bottom text-dark"><i class="fa fa-bell-o"></i> All Notifications</h3>
        @foreach(Auth::user()->Notifications as $notification)
            <a class="col-12 hover-notification {{empty($notification->read_at)?"bg-custom-unread-notification ":''}}" href="{{empty($notification->read_at)?'notification/markasread/'.$notification->id:$notification->data['data']['redirectURL']}}">
                <div class="row">
                    <div class="col-md-1 col-3 pt-md-3 pl-md-3 p-2">
                        @if(\App\Models\User::find($notification->data['data']['by'])->profile==null)
                            <img src="{{url('img/profile.png')}}" class="img-fluid rounded-circle bg-white" style="width: 50px;">
                        @else
                            <img src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" class="img-fluid rounded-circle" style="width: 50px;height: 50px;object-fit: cover">
                        @endif
                    </div>
                    <div class="col-9 d-md-none d-block mt-4">
                        <div>{{$notification->data['data']['title']}}</div>
                    </div>
                    <div class="col-md-9 col-12 p-3" style="word-break: break-all">
                        <div class="small d-md-block d-none">{{$notification->data['data']['title']}}</div>
                        <span class="{{($notification->read_at==null)?"font-weight-bold":""}}">{{$notification->data['data']['body']}}</span>
                        <div class="small text-right"><i class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</div>
                    </div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
@endsection
