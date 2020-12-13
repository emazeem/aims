@extends('layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">All Notifications</h2>
    </div>
    <div class="col-12">
        @foreach(Auth::user()->Notifications as $notification)
            <a class="dropdown-item d-flex align-items-center p-1 {{($notification->read_at==null)?"bg-custom-notification-unread":"bg-light"}}" href="{{$notification->data['data']['redirectURL']}}">
                <div class="row">
                    <div class="col-md-2 col-3 pt-md-4 pl-md-4">
                        @if(\App\Models\User::find($notification->data['data']['by'])->profile==null)
                            <img src="{{url('img/profile.png')}}" class="img-fluid rounded-circle bg-white" style="width: 50px;">
                        @else
                            <img src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" class="img-fluid rounded-circle" style="width: 50px;height: 50px;object-fit: cover">
                        @endif
                    </div>
                    <div class="col-9 d-md-none d-block">
                        <div class="small">{{$notification->data['data']['title']}}</div>
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
@endsection
