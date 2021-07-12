<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        
        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(isset($menu) && $menu == 'dashboard' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'categories' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Categories
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'products' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Products
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'orders' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Orders
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.inventry.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'inventryList' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Inventry
                    </span>
                </a>
            </li>

            
            <li class="<?php echo e(isset($menu) && ( $menu == 'packagesList' || $menu == 'deliverytimesList' || $menu == 'zonepricesList') ? 'active' : ''); ?>">
                <a href="#" class="<?php echo e(isset($menu) && ( $menu == 'packagesList' || $menu == 'deliverytimesList' || $menu == 'zonepricesList') ? 'side-bar-active' : ''); ?>"><span class="nav-label"> <i class="fa fa-home" aria-hidden="true"></i> Shipping</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('admin.package.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'packagesList' ? 'side-bar-active' : ''); ?>">List Packages</a></li>
                    
                    <li><a href="<?php echo e(route('admin.deliverytime.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'deliverytimesList' ? 'side-bar-active' : ''); ?>">List Delivery Times</a></li>
                    
                   <li><a href="<?php echo e(route('admin.zoneprice.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'zonepricesList' ? 'side-bar-active' : ''); ?>">List Zone Prices</a></li>
                    
                    
                </ul>
            </li>
            

            <li class="<?php echo e(isset($menu) && ( $menu == 'couponsList' || $menu =='couponHistory') ? 'active' : ''); ?>">
                <a href="#"><span class="nav-label"> <i class="fa fa-home" aria-hidden="true"></i> Coupons</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('admin.coupons.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'couponsList' ? 'side-bar-active' : ''); ?>">List Coupons</a></li>
                    <li><a href="<?php echo e(route('admin.coupons.histories.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'couponHistory' ? 'side-bar-active' : ''); ?>">Coupon History</a></li>
                </ul>
            </li>

            <li class="<?php echo e(isset($menu) && ( $menu == 'pageComponents' || $menu =='pages' || $menu =='banners') ? 'active' : ''); ?>">
                <a href="#"><span class="nav-label"> <i class="fa fa-home" aria-hidden="true"></i> CMS</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(route('admin.pages.components.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'pageComponents' ? 'side-bar-active' : ''); ?>">Pages Components</a></li>
                    <li><a href="<?php echo e(route('admin.pages.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'pages' ? 'side-bar-active' : ''); ?>">Pages</a></li>
                    <li><a href="<?php echo e(route('admin.pages.banners.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'banners' ? 'side-bar-active' : ''); ?>">Banners</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'customers' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Customers
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.product.options.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'options' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i> Options
                    </span>
                </a>
            </li>

            <li class="<?php echo e(isset($menu) && ($menu == 'customerOrder' || $menu =='customerTransaction' || $menu  =='tax') ? 'active' : ''); ?>">
                <a href="#"><span class="nav-label"> <i class="fa fa-home" aria-hidden="true"></i> Reports</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a class="<?php echo e(isset($menu) && $menu == 'customerOrder' ? 'side-bar-active' : ''); ?>" href="<?php echo e(route('admin.reports.customerorder.index')); ?>">Customer Order</a></li>
                    <li><a class="<?php echo e(isset($menu) && $menu == 'customerTransaction' ? 'side-bar-active' : ''); ?>" href="<?php echo e(route('admin.reports.customertransaction.index')); ?>">Customer Transaction</a></li>
                    <li><a class="<?php echo e(isset($menu) && $menu == 'tax' ? 'side-bar-active' : ''); ?>" href="<?php echo e(route('admin.reports.tax.index')); ?>">Tax</a></li>
                </ul>
            </li>


            <li>
                <a href="<?php echo e(route('admin.product.questions.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'product-questions' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i>Questions
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.reviews.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'reviews' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i>Reviews
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.faq.categories.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'faq-categories' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i>Faq Categories
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.faqs.index')); ?>" class="<?php echo e(isset($menu) && $menu == 'faqs' ? 'side-bar-active' : ''); ?>">
                    <span class="nav-label">
                        <i class="fa fa-home" aria-hidden="true"></i>Faqs
                    </span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<?php /**PATH /var/www/html/speedyorder/resources/views/commons/sidebar.blade.php ENDPATH**/ ?>