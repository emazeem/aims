<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow ">

    <!-- End of Topbar -->
    <button class="sidebar-collapse text-gray-700" id="sidebarCollapse">
        <i class="fas fa-bars"></i>
        <span></span>
    </button>

    <span class="mx-auto d-md-block d-none ">Al-Meezan Industrial Meterology Services</span>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @php $unread=auth()->user()->unreadNotifications()->count(); @endphp
                <span class="badge badge-danger badge-counter">@if($unread>0){{$unread}}@endif</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" >
                <h5 class="bg-primary text-white py-3 px-2 pl-md-4">
                    Notification
                    <i class="fas float-right fa-bell fa-fw">

                    </i>
                </h5>
                <div style="height: 300px;overflow-y: scroll">

                    @foreach(Auth::user()->Notifications as $notification)
                        <a class="dropdown-item {{($notification->read_at==null)?"bg-gradient-light":""}}" href="{{url('/notification/markasread/'.$notification->id)}}">
                            <div class="{{($notification->read_at==null)?"font-weight-bold":""}}">
                                {{$notification->data['data']['title']}}
                                <span class="small text-gray-500"><i class="fa fa-clock"></i> {{$notification['created_at']->diffForHumans()}}</span>
                            </div>
                            <p>{{$notification->data['data']['body']}}</p>
                        </a>
                    @endforeach



                </div>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark user-name font-weight-normal small ">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid rounded-circle" style="height: 35px;width: 35px;">
                @else
                    <i class="fas fa-user-circle fa-2x"></i>
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="text-center p-4">
                    @if(auth()->user()->profile)
                        <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid rounded-circle" style="height: 65px;width: 65px;">
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


                {{-- <a class="dropdown-item mt-3" href="{{url('/profile')}}">
                         <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     Profile
                 </a>
                 <a class="dropdown-item" href="{{url('/change_password')}}">
                     <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                     Change Password
                 </a>
                 <a class="dropdown-item" href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
                 <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                 </form>
 --}}            </div>
        </li>
    </ul>
</nav>