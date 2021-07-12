<!-- Header -->
<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version" style="background-color: #231f20;padding: 0px 10px 18px 0px;">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
            <span title="eSewa Travels">
                <img src="<?php echo e(asset('images/.png')); ?>" class="m-b" alt="logo" style=" max-height: 52px;">
            </span>
        </a>
    </div>

    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo" style="    background-color: #354a5f;padding: 8px 11px 0px 11px;">
            <span class="text-primary">
                <img src="<?php echo e(asset('images/.png')); ?>" class="m-b" alt="logo" style=" max-height: 52px;">
                
            </span>
        </div>

        <div class="header-menu">
            <a href="<?php echo e(route('admin.settings')); ?>" class="<?php echo e((isset($menu) && $menu =='settings') ? 'active' :''); ?>"><i class="fa fa-cogs" aria-hidden="true"></i> SETTINGS</a>
            <a href="<?php echo e(route('users')); ?>" class="<?php echo e((isset($menu) && $menu =='users') ? 'active' :''); ?>"><i class="fa fa-user" aria-hidden="true"></i> USERS</a>
        </div>

        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="<?php echo e(route('users.profile')); ?>">Profile</a>
                    </li>
                    <li>
                        <a class="" href="<?php echo e(route('users.reset-password')); ?>">Reset Password</a>
                    </li>
                    <li>
                        <a class="" href="<?php echo e(route('admin.logout')); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="pe-7s-user"></i> <span style="margin-left: 5px;font-size: 14px;color: #354a5f;"><?php echo e(auth('admin')->user()->first_name  ?? null); ?></span>
                    </a>
                    <ul class="dropdown-menu hdropdown notification">
                        <li>
                            <a href="<?php echo e(route('users.profile')); ?>">
                                <i class="pe-7s-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('users.reset-password')); ?>">
                                <i class="pe-7s-star"></i> Reset Password
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin.logout')); ?>">
                                <i class="pe-7s-power"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH /var/www/html/speedyorder/resources/views/commons/header.blade.php ENDPATH**/ ?>