
@extends('layouts.master')
@section('content')
    <!-- activity feed start -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="font-weight-light"><i class="feather icon-bell"></i> All Notifications</h3>
            </div>
            <div class="card-body">
                <ul class="feed-blog pl-0">
                    @foreach(Auth::user()->Notifications as $notification)
                        <li class="active-feed">
                            <div class="feed-user-img">
                                @if(\App\Models\User::find($notification->data['data']['by'])->profile!=null)
                                    <img style="object-fit: cover" src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" class="img-radius " alt="User-Profile-Image">
                                @else
                                    <img style="object-fit: cover" src="{{url('img/profile.png')}}" class="img-radius " alt="User-Profile-Image">
                                @endif
                            </div>
                            <a class="font-weight-bold" href="{{empty($notification->read_at)?'notification/markasread/'.$notification->id:$notification->data['data']['redirectURL']}}">
                                {{$notification->data['data']['title']}}
                                <span class="badge badge-danger">{{empty($notification->read_at)?'unread':''}}</span>
                                <small class="text-muted ml-md-4"> {{$notification['created_at']->diffForHumans()}}</small>
                            </a>
                            <p class="m-b-15 m-t-15">
                                {{$notification->data['data']['body']}}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

{{--
<a class="col-12 m-0" href="">
    <div class="row border hover-notification {{empty($notification->read_at)?"bg-custom-unread-notification ":''}}">
        <div class="col-md-1 col-3 pt-md-3 pl-md-3 p-md-2 p-0">
            @if(\App\Models\User::find($notification->data['data']['by'])->profile==null)
                <img src="{{url('img/profile.png')}}" class="img-fluid rounded-circle bg-white" style="width: 50px;object-fit: cover">
            @else
                <img src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" class="img-fluid rounded-circle" style="width: 50px;object-fit: cover">
            @endif
        </div>
        <div class="col-9 d-md-none d-block mt-4">
            <div>{{$notification->data['data']['title']}}</div>
        </div>
        <div class="col-md-9 col-12 p-3" style="word-break: break-all">
            <div class="small d-md-block d-none">{{$notification->data['data']['title']}}</div>
            <span class="{{($notification->read_at==null)?"font-weight-bold":""}}">{{$notification->data['data']['body']}}</span>
            <div class="small text-right"><i class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</div>
            <div class="small text-right"><i class="fa fa-usr"></i> {{\App\Models\User::find($notification->data['data']['by'])->fname}} {{\App\Models\User::find($notification->data['data']['by'])->lname}}</div>
        </div>
    </div>
</a>--}}
