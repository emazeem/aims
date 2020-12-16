<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        {{--<div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><i class="fa fa-cog"></i> <span>AIMS</span></a>
        </div>--}}

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('public/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-circle profile_img">
                @else
                    <i class="fas fa-user-circle fa-3x"></i>
                @endif
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{auth()->user()->fname.' '.auth()->user()->lname}}</h2>

            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    @foreach($menus as $menu)
                        @if($menu->has_child==1)

                            @can($menu->slug)
                                <li><a><i class="{{$menu->icon}}"></i> {{$menu->name}} <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        $submenus=\App\Models\Menu::where('parent_id',$menu->id)->where('has_child',1)->orderBy('position','ASC')->get();
                                        $url=[];
                                        foreach ($submenus as $submenu){
                                            $url[]=\Illuminate\Support\Facades\URL::to('/').'/'.$submenu->url;
                                        }
                                        ?>

                                    @foreach($submenus as $submenu)
                                            @can($submenu->slug)
                                                <li class="sub_menu"><a href="{{url($submenu->url)}}">{{$submenu->name}}</a></li>

                                            @endcan
                                        @endforeach
                                    </ul>
                                </li>

                            @endcan

                        @else
                            @can($menu->slug)
                                {{--<a href="{{url($menu->url)}}" class="py-1 my-0 {{(Request::url()==url(''.$menu->url))?"active":""}} sidebar-a">
                                    <i class="{{$menu->icon}}"></i>
                                    <span>{{$menu->name}}</span>
                                </a>
--}}
                                <li>
                                    {{--{{(Request::url()==url(''.$menu->url))?"active":""}}--}}
                                    <a href="{{url($menu->url)}}"><i class="{{$menu->icon}}"></i> {{$menu->name}}
                                        <span class="label label-success pull-right"></span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                    @endforeach

                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
                {{--<a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>--}}
        </div>

        <!-- /menu footer buttons -->
    </div>
</div>
