<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-toggle-off"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:void(0);" class="user-profile dropdown-toggle" aria-haspopup="true"
                       id="navbarDropdown"
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
                                     class="img-fluid rounded-circle"
                                     style="height: 65px;width: 65px;object-fit: cover;">
                            @else
                                <img src="{{url('img/profile.png')}}" class="img-fluid img-fluid rounded-circle"
                                     style="height: 65px;width: 65px;object-fit: cover;">
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

                    <a href="javascript:void(0);" class="dropdown-togge" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">


                        <i class="fa fa-bell-o"></i>
                        @if(auth()->user()->unreadNotifications()->count()>0)
                            <b class="text-danger"
                                  style="font-size: 10px">
                            {{auth()->user()->unreadNotifications()->count()}}
                        </b>
                        @endif
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
                          <span class="time"><i
                                      class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</span>
                        </span><span class="message">
{{$notification->data['data']['body']}}
                        </span></span>
                                </a>
                            </li>
                        @endforeach
                        @if(auth()->user()->Notifications()->count()>0)
                                <li class="nav-item ">
                                <div class="text-center">
                                <span class="dropdown-item p-0 m-0">
                                    <a class="dropdown-item text-center" href="{{url('/notifications')}}">
                                        Show All Notifications <i class="fa fa-check-circle"></i>
                                    </a>
                                </span>
                                </div>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>