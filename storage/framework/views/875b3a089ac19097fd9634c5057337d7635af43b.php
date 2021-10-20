<?php $__env->startSection('content'); ?>

<section class="container side-menu-page-template">
    <div class="row">
        <div class="col-md-9 col-xl-8 mx-lg-auto pl-md-5 order-2">
            <h1 class="d-none d-md-block page-title"><?php echo $title; ?></h1>
            
            <?php echo $content; ?>


        </div>

       <?php echo $__env->make('includes.cms_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/resources/views/pages/index.blade.php ENDPATH**/ ?>