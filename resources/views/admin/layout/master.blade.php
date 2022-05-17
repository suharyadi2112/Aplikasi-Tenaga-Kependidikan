<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('admin/dist/img/logo2.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uvers</title>
    <!--script src="{{ asset('js/app.js') }}" defer></script-->
    <script>
        var laravel = @json(['baseURL' => url('/')])
    </script>
    <!-- Styles -->
    <!--link href="asset('admin/dist/css/nprogress.css') " rel="stylesheet" />
    <script src="asset('admin/dist/js/nprogress.js'"></script-->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/adminlte.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!--select2-->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!--checkbox-->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <script src="{{ URL::asset('admin/plugins/moment/moment.min.js')}}"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/summernote/summernote-bs4.css') }}">
    <!--link href="{{ asset('admin/dist/css/nprogress.css') }}" rel="stylesheet" /-->

    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/pace-progress/themes/blue/pace-theme-flash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-notifications.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ URL::asset('admin/dist/css/font_sans_pro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">


    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar/main.min.css') }}">
    <!--link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar-interaction/main.min.css') }}"-->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar-daygrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar-timegrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar-bootstrap/main.min.css') }}">


    <!-- Include SmartWizard CSS -->
    <link href="{{ URL::asset('admin/wizardform/dist/css/smart_wizard.css') }}" rel="stylesheet" type="text/css" />
    <!-- Optional SmartWizard theme -->
    <link href="{{ URL::asset('admin/wizardform/dist/css/smart_wizard_theme_arrows.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('admin/wizardform/dist/css/smart_wizard_theme_circles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('admin/wizardform/dist/css/smart_wizard_theme_dots.css') }}" rel="stylesheet" type="text/css" />


</head>

<!--layout-footer-fixed-->
<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed text-sm">

<div class="wrapper">

  <!-- Navbar -->
  @include('admin.include.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.include.sidebar')

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
   
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('admin/dist/js/adminlte.js') }}"></script>

<!--script src="{{ URL::asset('admin/dist/js/adminlte.min.js')}}"></script-->


<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ URL::asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ URL::asset('admin/dist/js/pages/dashboard2.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ URL::asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ URL::asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('admin/plugins/pace-progress/pace.js')}}"></script>
<!--script src="{{ asset('admin/dist/js/nprogress.js') }}"></script-->
<script src="{{ URL::asset('admin/dist/js/bootstrap3-typeahead.min.js')}}"></script>
<script src="{{ URL::asset('js/jquery.timepicker.min.js') }}"></script>

<!--rich text-->
<script src="{{ URL::asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script src="{{ URL::asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>


<!--Jquery block ui-->
<script src="{{ URL::asset('admin/dist/js/jquery.blockUI.js')}}"></script>


<!-- fullCalendar 2.2.5 -->
<script src="{{ URL::asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/fullcalendar-interaction/main.min.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>


<!-- wizardform -->
<script type="text/javascript" src="{{ URL::asset('admin/wizardform/dist/js/jquery.smartWizard.min.js') }}"></script>


<!-- inpus mask -->
<script src="{{ URL::asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>


@yield('script')



</body>
</html>
