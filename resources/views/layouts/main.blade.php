<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="app-url" content="{{ asset('/') }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('frontend_assets/img/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('frontend_assets/img/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend_assets/img/favicon.ico') }}">

    <!-- Page title -->
    <title>Speedy Orders</title>

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
    @yield('ext_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

         <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('images/'.Option::get('site_logo'))}}" alt="Speedy Orders">
        </div>


        @include('commons.header')

        <!-- Main Wrapper -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                        @if( isset($breadcrumb) )
                            <ol class="breadcrumb float-sm-right" style="background-color: #f1f3f6!important;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    {!! $breadcrumb ?? null !!}
                            </ol>
                        @endif   
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
             
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    @include('commons.flash')
                    @yield('content')
                </div>
            </section>
            
        </div>
    </div>

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
    <!-- <script src="{{asset('admin_assets/plugins/sparklines/sparkline.js')}}"></script> -->
    <!-- JQVMap -->
    <!-- <script src="{{asset('admin_assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script> -->
    <!-- <script src="{{asset('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> -->
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
   <!--  <script src="{{asset('admin_assets/dist/js/demo.js')}}"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('admin_assets/dist/js/pages/dashboard.js?ver-4544554545')}}"></script>

    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>


    <script>
         $(document).ready(function(){
            $(".js-dropdown-select2").select2({
                
            });
        });
    </script>
    @yield('ext_js')
</body>
</html>
