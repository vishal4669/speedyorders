<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="app-url" content="<?php echo e(asset('/')); ?>">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <!-- Page title -->
    <title>TECOMMERCE</title>

    <!-- Place favicon.ico and ap ple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

<?php /*
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.css') }}">

*/?>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/fontawesome/css/font-awesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/metisMenu/dist/metisMenu.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/animate.css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/bootstrap/dist/css/bootstrap.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/jquery-ui/themes/base/all.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/select2/dist/css/select2.min.css')); ?>" />


    <link rel="stylesheet" href="<?php echo e(asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('fonts/pe-icon-7-stroke/css/helper.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('styles/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles/custom.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/datatables/media/css/dataTables.bootstrap.css')); ?>">
    <style type="text/css">
    #productTable_previous {
        border: 1px solid gray;
        padding: 10px;
    } #productTable_next {
        border: 1px solid gray;
        padding: 10px;
    }
    a.paginate_button {
        border: 1px solid gray;
        padding: 10px;
    }
    a.paginate_button.current {
        background: #2588ca;
    }
</style>
    <?php echo $__env->yieldContent('ext_css'); ?>
</head>
<body class="fixed-navbar sidebar-scroll">

<?php echo $__env->make('commons.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('commons.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Wrapper -->
<div id="wrapper">
    <?php if( isset($breadcrumb) ): ?>
        <div class="normalheader" style="padding: 0px 24px 0 0px;">
            <div class="hpanel">
                <div class="panel-body" style="background: none;border: none;padding: 20px 20px 0px 0px;">

                    <div id="hbreadcrumb" class="pull-right">
                        <ol class="hbreadcrumb breadcrumb" style="background-color: #f1f3f6!important;">
                            <li class="text-bold"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <?php echo $breadcrumb ?? null; ?>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="content">
        <?php echo $__env->make('commons.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <br>
    
</div>

<?php /*
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin_assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin_assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin_assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin_assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin_assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin_assets/dist/js/pages/dashboard.js')}}"></script>

*/?>


<script src="<?php echo e(asset('vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-flot/jquery.flot.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-flot/jquery.flot.resize.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-flot/jquery.flot.pie.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/flot.curvedlines/curvedLines.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery.flot.spline/index.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/metisMenu/dist/metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/iCheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/peity/jquery.peity.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/sparkline/index.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>


<script src="<?php echo e(asset('scripts/homer.js')); ?>"></script>
<script src="<?php echo e(asset('scripts/newchart.js')); ?>"></script>
<script src="<?php echo e(asset('scripts/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('scripts/additional-methods.js')); ?>"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script>
     $(document).ready(function(){
        $(".js-dropdown-select2").select2({
            
        });
    });
</script>
<?php echo $__env->yieldContent('ext_js'); ?>
</body>
</html>
<?php /**PATH /home/speedyorders/public_html/modban.com/resources/views/layouts/main.blade.php ENDPATH**/ ?>