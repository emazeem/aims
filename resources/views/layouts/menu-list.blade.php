<style>
    .pcoded-mtext,.pcoded-mtext-submenu{
        color: black;
    }
</style>
<nav class="pcoded-navbar menupos-fixed menu-light navbar-collapsed">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label class="text-capitalize">Navigation</label>
                </li>
                @foreach($menus as $menu)
                    @if($menu->has_child==1)
                        @can($menu->slug)
                            <li class="nav-item pcoded-hasmenu">
                                <a href="#" class="nav-link">
                                    <span class="pcoded-micon">
                                        <i class="{{$menu->icon}}"></i>
                                    </span>
                                    <span class="pcoded-mtext">
                                        {{$menu->name}}
                                    </span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <?php
                                    $submenus=\App\Models\Menu::where('parent_id',$menu->id)->where('has_child',1)->orderBy('position','ASC')->get();
                                    $url=[];
                                    foreach ($submenus as $submenu){
                                        $url[]=\Illuminate\Support\Facades\URL::to('/').'/'.$submenu->url;
                                    }
                                    ?>
                                    @foreach($submenus as $submenu)
                                        @can($submenu->slug)
                                            <li class=" pcoded-mtext-submenu"><a href="{{url($submenu->url)}}" class="">{{$submenu->name}}</a></li>
                                        @endcan
                                    @endforeach
                                </ul>
                            </li>
                        @endcan

                    @else
                        @can($menu->slug)
                            <li class="nav-item">
                                <a href="{{url($menu->url)}}" class="nav-link ">
                    <span class="pcoded-micon">
                        <i class="{{$menu->icon}}"></i></span>
                                    <span class="pcoded-mtext">{{$menu->name}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>



