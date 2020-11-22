<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark  accordion sidebar-toggled toggled custom-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        {{--<div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-flask" aria-hidden="true"></i>
        </div>--}}
        <img src="{{url('/img/aims-logo.png')}}" class="img-fluid" width="70">
        {{--<div class="sidebar-brand-text mx-3">AIMS</div>--}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{(Request::url()==url(''))?"active":""}}">
        <a class="nav-link p-1 p-md-2 text-sm-left" href="{{url('/')}}">

            <span class="text-xs border-md-bottom">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                Dashboard
            </span>
        </a>
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        ALL MENUS
    </div>

    @foreach($menus as $menu)
        @can($menu->slug)
        <li class="nav-item {{(Request::url()==url(''.$menu->url))?"active":""}}">
            <a class="nav-link p-1 p-md-2 text-sm-left" href="{{url($menu->url)}}">
                <span class="text-xs border-md-bottom">
                    <i class="{{$menu->icon}} d-inline text-xs"></i>
                    {{$menu->name}}
                </span>
            </a>
        </li>
        @endcan
    @endforeach
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
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
            <i class="fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
