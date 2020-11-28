<nav id="sidebar">
    <div class="sidebar-header" style="padding: 10px">
        <h3 class="text-center ">
            {{--<img src="{{url('/img/aims-logo.png')}}" class="img-fluid" width="70">
            --}}
            AIMS
            <br>

        </h3>
        <strong><small>AIMS</small></strong>
    </div>
    <div class="text-center p-2 border-bottom border-top">
        <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid rounded-circle" style="height: 65px;width: 65px;">
        <br>

        <p style="font-size: 12px;" class="col-12 p-0 m-0 text-white">{{auth()->user()->fname}} {{auth()->user()->lname}}</p>

    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="{{url('/')}}" class="py-1 my-0 {{(Request::url()==url(''))?"active":""}} sidebar-a">
                <i class="fa fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            @foreach($menus as $menu)
                @can($menu->slug)
                    <a href="{{url($menu->url)}}" class="py-1 my-0 {{(Request::url()==url(''.$menu->url))?"active":""}} sidebar-a">
                        <i class="{{$menu->icon}}"></i>
                        <span>{{$menu->name}}</span>
                    </a>
                @endcan
            @endforeach
                @can('settings-index')
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-fw fa-cog"></i>
                Settings
            </a>

            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="{{url('/taxes')}}">Manage Taxes</a>
                    <a href="{{url('/taxes')}}">Others</a>
                </li>
            </ul>
                @endcan
                <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

        </li>
    </ul>
</nav>

{{--
@can('settings-index')
    <li class="nav-item {{(Request::url()==url(''.'settings'))?"active":""}}">
        <a class="nav-link collapsed  p-1 p-md-2 text-sm-left" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <span class="text-xs border-md-bottom">
                <i class="fas fa-fw fa-cog d-inline text-xs"></i>

                Settings
                </span>

        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-primary text-white py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="{{url('/taxes')}}">Manage Taxes</a>
                <a class="collapse-item text-white" href="{{url('/taxes')}}">Others</a>
            </div>
        </div>
    </li>

@endcan
    --}}
