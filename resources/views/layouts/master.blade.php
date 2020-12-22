<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIMS </title>
    <link rel="icon" href="{{url('/img/aims-logo.png')}}">
    <link rel="stylesheet" href="{{url('style.css')}}">
    <!-- Bootstrap -->
    <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/sweetalert.min.js')}}"></script>

    <!-- Custom Theme Style -->
    <link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.navbar')
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <footer>
            <div class="text-center">
                AIMS- Al Meezan Meterology Services <a href="https://colorlib.com">ERP@2020</a>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>
<script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
@if(Route::currentRouteName()=='customers' or Route::currentRouteName()=='departments'or Route::currentRouteName()=='designations'or Route::currentRouteName()=='users' or Route::currentRouteName()=='parameters'
or Route::currentRouteName()=='assets' or Route::currentRouteName()=='procedures' or Route::currentRouteName()=='capabilities' or Route::currentRouteName()=='manageref'or Route::currentRouteName()=='units'or Route::currentRouteName()=='quotes.show'
or Route::currentRouteName()=='uncertainties'or Route::currentRouteName()=='columns'or Route::currentRouteName()=='assets.groups'or Route::currentRouteName()=='quotes'or Route::currentRouteName()=='purchase.indent.index'
or Route::currentRouteName()=='pendings' or Route::currentRouteName()=='jobs.manage' or Route::currentRouteName()=='jobs'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='material.receiving.index'
or Route::currentRouteName()=='invoicing_ledger' or Route::currentRouteName()=='expenses'or Route::currentRouteName()=='expenses_categories'or Route::currentRouteName()=='menus'or Route::currentRouteName()=='roles'
or Route::currentRouteName()=='preferences.index' or Route::currentRouteName()=='mytasks' or Route::currentRouteName()=='certificates' or Route::currentRouteName()=='certificates'or Route::currentRouteName()=='sops'or Route::currentRouteName()=='forms.index')
    <link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
    <script src="{{url('build/js/custom.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/datatables.min.js')}}"></script>
    <script src="{{url('js/dataTables.responsive.min.js')}}"></script>
@endif
@if(Route::currentRouteName()=='home')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endif
</body>
</html>
{{--<!-- FastClick -->
<script src="{{url('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{url('vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{url('vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{url('vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{url('vendors/skycons/skycons.js')}}"></script>--}}
{{--<!-- Flot -->
<script src="{{url('vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{url('vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{url('vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{url('vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{url('vendors/Flot/jquery.flot.resize.js')}}"></script>

<!-- Flot plugins -->
<script src="{{url('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{url('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{url('vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{url('vendors/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{url('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('vendors/moment/min/moment.min.js')}}"></script>
<script src="{{url('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    --}}