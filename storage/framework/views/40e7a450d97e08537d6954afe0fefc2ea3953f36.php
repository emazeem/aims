<nav id="sidebar" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <div class="sidebar-header">
        <h3 class="text-center py-2">
            
            AIMS
        </h3>
        <strong class="pt-1"><small>AIMS</small></strong>
    </div>
    <div class="text-center p-2 border-bottom border-top">
        <i class="fa fa-temperature-high fa-3x"></i>
        

    </div>
    <ul class="list-unstyled components">
        <li>

            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($menu->has_child==1): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($menu->slug)): ?>
                        <a href="#<?php echo e($menu->slug); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="<?php echo e($menu->icon); ?>"></i>
                            <?php echo e($menu->name); ?>

                        </a>
                        <?php
                        $submenus=\App\Models\Menu::where('parent_id',$menu->id)->where('has_child',1)->orderBy('position','ASC')->get();
                        $url=[];
                        foreach ($submenus as $submenu){
                            $url[]=\Illuminate\Support\Facades\URL::to('/').'/'.$submenu->url;
                        }
                        ?>
                        <ul class="collapse list-unstyled <?php echo e((in_array(Request::url(),$url))?'show':''); ?>" id="<?php echo e($menu->slug); ?>">

                            <li>
                                <?php $__currentLoopData = $submenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($submenu->slug)): ?>
                                            <a href="<?php echo e(url($submenu->url)); ?>" class="<?php echo e((Request::url()==url(''.$submenu->url))?"active":""); ?>"><?php echo e($submenu->name); ?>

                                            </a>
                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($menu->slug)): ?>
                    <a href="<?php echo e(url($menu->url)); ?>" class="py-1 my-0 <?php echo e((Request::url()==url(''.$menu->url))?"active":""); ?> sidebar-a">
                        <i class="<?php echo e($menu->icon); ?>"></i>
                        <span><?php echo e($menu->name); ?></span>
                    </a>
                <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('logout')); ?>"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>

        </li>
    </ul>
</nav>


<?php /**PATH C:\xampp\htdocs\aims\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>