{{--
<nav class="navbar navbar-expand navbar-light bg-gray-400 topbar mb-4 static-top shadow custom-navbar">

    <!-- End of Topbar -->
    <button class="sidebar-collapse text-white" id="sidebarCollapse">
        <i class="fas fa-bars"></i>
        <span></span>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto ">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-white"></i>
                <!-- Counter - Alerts -->
                @php $unread=auth()->user()->unreadNotifications()->count(); @endphp
                <span class="badge badge-danger badge-counter">@if($unread>0){{$unread}}@endif</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" >
                <h5 class="text-white py-2 px-3 aims-primary-bg">
                    Notification <small class="fas mt-1 float-right fa-bell"></small>
                </h5>
                <div style="height: 300px;overflow-y: scroll" class="notification-scroll">

                    @foreach(Auth::user()->Notifications as $notification)
                            <a class="dropdown-item d-flex align-items-center p-1 {{($notification->read_at==null)?"bg-custom-notification-unread":"bg-light"}}" href="{{$notification->data['data']['redirectURL']}}">
                                <div class="mr-2">
                                <div class="icon-circle">
                                    @if(\App\Models\User::find($notification->data['data']['by'])->profile==null)
                                        <img src="{{url('img/profile.png')}}" class="img-fluid rounded-circle bg-white" style="width: 30px;">
                                    @else
                                        <img src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}" class="img-fluid rounded-circle" style="width: 30px;height: 30px;object-fit: cover">
                                    @endif
                                </div>
                                </div>
                                <div>
                                    <div class="small">{{$notification->data['data']['title']}}</div>
                                    <span class="{{($notification->read_at==null)?"font-weight-bold":""}}">{{$notification->data['data']['body']}}</span>
                                    <div class="small text-right"><i class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</div>
                                </div>
                            </a>
                    @endforeach


                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{url('/notifications')}}">Show All Notifications</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline user-name font-weight-normal text-white ">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid rounded-circle" style="height: 35px;width: 35px;object-fit: cover;">
                @else
                    <i class="fas fa-user-circle fa-2x"></i>
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="text-center p-4">
                    @if(auth()->user()->profile)
                        <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid rounded-circle" style="height: 65px;width: 65px;object-fit: cover;">
                    @else
                        <i class="fas fa-user-circle fa-3x"></i>
                    @endif
                    <div class="col-12">

                        <span class="text-dark  font-weight-normal small ">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                        <div class="text-xs text-center  text-primary">
                            Member since {{date('Y',strtotime(auth()->user()->created_at))}}
                        </div>
                    </div>
                </div>


                <div class="dropdown-divider"></div>

                <div class="col-12 text-center">
                    <a class="btn btn-primary btn-sm" href="{{url('/profile')}}">
                        <i class="fas fa-user fa-sm fa-fw text-white"></i>
                    </a>
                    <a class="btn btn-success btn-sm" href="{{url('/change_password')}}">
                        <i class="fas fa-key fa-sm fa-fw text-white"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{route('logout')}}"   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw text-white"></i>
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </li>
    </ul>
</nav>--}}
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-toggle-off"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:0;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                       data-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->profile)
                            <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}"
                                 class="img-fluid rounded-circle" style="height: 35px;width: 35px;object-fit: cover;">
                        @else
                            <img src="{{url('img/profile.png')}}" class="img-fluid">
                        @endif
                        {{auth()->user()->fname}} {{auth()->user()->lname}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right mt-4" aria-labelledby="navbarDropdown">
                        <div class="text-center p-4">
                            @if(auth()->user()->profile)
                                <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}"
                                     class="img-fluid rounded-circle" style="height: 65px;width: 65px;object-fit: cover;">
                            @else
                                <img src="{{url('img/profile.png')}}" class="img-fluid img-fluid rounded-circle" style="height: 65px;width: 65px;object-fit: cover;">
                            @endif
                            <div class="col-12">
                                <span class="text-dark  font-weight-normal small ">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                                <div class="text-xs text-center  text-primary">
                                    Member since {{date('Y',strtotime(auth()->user()->created_at))}}
                                </div>
                            </div>
                        </div>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <div class="col-12 text-center">
                            <a class=" btn border btn-sm" href="{{url('/profile')}}"><i class="fa fa-user"></i></a>
                            <a class=" btn border btn-sm" href="{{url('/change_password')}}"><i
                                        class="fa fa-key fa-sm fa-fw"></i></a>
                            <a class="btn border btn-sm"
                               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                               href="{{route('logout')}}"><i class="fa fa-sign-out"></i></a>
                            <form id="frm-logout" action="http://aimslims.com/logout" method="POST"
                                  style="display: none;">
                                <input type="hidden" name="_token" value="I9OlVLPXSnIVDvx51zgd09gZtycqMOyuKYv46dX1">
                            </form>
                        </div>
                    </div>
                </li>
                <li role="presentation" class="nav-item dropdown open p-md-2 p-0 mt-2 mt-md-0">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list mt-4" role="menu" aria-labelledby="navbarDropdown1"
                        style="height: 300px;overflow-y: scroll">
                        @foreach(Auth::user()->Notifications as $notification)
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="image">
                                    @if(\App\Models\User::find($notification->data['data']['by'])->profile == null)
                                            <img src="{{url('img/profile.png')}}">
                                        @else
                                            <img src="{{Storage::disk('local')->url('public/profile/'.$notification->data['data']['by'].'/'.\App\Models\User::find($notification->data['data']['by'])->profile)}}">
                                        @endif
                                        <span>
                          <span>{{\App\Models\User::find($notification->data['data']['by'])->fname}} {{\App\Models\User::find($notification->data['data']['by'])->lname}}</span>
                          <span class="time"><i class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</span>
                        </span><span class="message">
{{$notification->data['data']['body']}}
                        </span></span>
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item ">
                            <div class="text-center">
                                <span class="dropdown-item p-0 m-0">
                                    <a class="dropdown-item text-center" href="{{url('/notifications')}}">
                                        Show All Notifications <i class="fa fa-check-circle"></i>
                                    </a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>