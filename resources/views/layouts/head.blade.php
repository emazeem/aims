<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-blue">
    <div class="m-header bg-c-blue">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{url('img/rubic-logo-text.png')}}" style="width: 110px" alt="" class="logo ml-md-5">
            <img src="{{url('assets/images/logo-icon.png')}}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i><span class="badge bg-danger"><span class="sr-only"></span></span></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0"> {{Auth::user()->UnreadNotifications->count()}} Notifications</h6>
                            <div class="float-right">
                                <a href="#!" class="m-r-10">mark as read</a>
                                <a href="#!">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">

                            <li class="n-title">
                                <p class="m-b-0">NEW</p>
                            </li>
                            @foreach(Auth::user()->Notifications as $notification)
                                <li class="notification">
                                    <div class="media">
                                        @if(\App\Models\User::find($notification->data['data']['by'])->profile == null)
                                            <img class="img-radius  hei-40" style="object-fit: cover" src="{{url('img/profile.png')}}" alt="user-profile">
                                        @else
                                            <img class="img-radius  hei-40" style="object-fit: cover"  src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" alt="user-profile">
                                        @endif
                                        <div class="media-body">
                                            <p>
                                                <strong>{{\App\Models\User::find($notification->data['data']['by'])->fname}} {{\App\Models\User::find($notification->data['data']['by'])->lname}}</strong>
                                                <span class="n-time text-muted">
                                                    <i class="icon feather icon-clock m-r-5"></i>{{$notification['created_at']->diffForHumans()}}
                                                </span>
                                                <span class="n-time text-danger  m-r-5">{{empty($notification->read_at)?'unread':''}}</span>

                                            </p>

                                            <a href="{{empty($notification->read_at)?'notification/markasread/'.$notification->id:$notification->data['data']['redirectURL']}}">{{$notification->data['data']['body']}}

                                            </a>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="noti-footer">
                            <a href="{{url('/notifications')}}">show all</a>
                        </div>
                    </div>
                </div>
            </li>
{{--            <li>
                <div class="dropdown">
                    <a href="#!" class="displayChatbox dropdown-toggle"><i class="icon feather icon-mail"></i><span class="badge bg-success"><span class="sr-only"></span></span></a>
                </div>
            </li>--}}

            <li>
                <div class="dropdown drp-user">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                        @if(auth()->user()->profile)
                            <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}"
                                 class="img-radius wid-40 hei-40" alt="User-Profile" style="object-fit: cover">
                        @else
                            <img src="{{url('img/profile.png')}}" class="img-radius wid-40  hei-40" style="object-fit: cover">
                        @endif


                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            @if(auth()->user()->profile)
                                <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}"
                                     class="img-radius wid-40 hei-40" style="object-fit: cover" alt="User-Profile">
                            @else
                                <img src="{{url('img/profile.png')}}" class="img-radius wid-40 hei-40" style="object-fit: cover">
                            @endif

                            <span>{{auth()->user()->fname.' '.auth()->user()->lname}}</span>
                            <a class="dud-logout" title="Logout"
                               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                               href="{{route('logout')}}">
                                <i class="feather icon-log-out"></i>
                            </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{url('/profile')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="{{url('/notifications')}}" class="dropdown-item"><i class="feather icon-bell"></i> Notifications</a></li>
                            <li><a href="{{url('/change_password')}}" class="dropdown-item"><i class="feather icon-lock"></i> Change Password</a></li>
                            <li>
                                <a class="dropdown-item" title="Logout"
                                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                   href="{{route('logout')}}">
                                    <i class="feather icon-log-out"></i>
                                    Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>