<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AIMS ERP</title>
    <script src="{{url('vendor/jquery/jquery.js')}}"></script>
    <link rel="icon" href="{{url('/img/aims-logo.png')}}">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{url('style.css')}}" rel="stylesheet">
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
</head>
{{--
<style>
    .loader{
        background: url('{{url('/img/pre-loader.gif')}}')
        50% 50% no-repeat rgba(255, 255, 255, 0.9);
    }

</style>

<div id="preloader" class="loader">

</div>
--}}

<body id="page-top">
<div id="wrapper">
@include('layouts.partials.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        @include('layouts.partials.navbar')
            <div class="container-fluid">
               @yield('content')
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>ERP &copy; 2020 AIMS CAL LAB </span>
                </div>
            </div>
        </footer>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    if ($(window).width() > 480){
        $(".sidebar").removeClass("toggled");
    }
    $(window).scroll(function() {
                $(".sidebar").removeClass("toggled");

    });
</script>




<!-- Bootstrap core JavaScript-->

<script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{url('js/sb-admin-2.min.js')}}"></script>
<script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('js/popper.min.js')}}" ></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>

<!--   Datatables-->
<script type="text/javascript" src="{{url('js/datatables.min.js')}}"></script>
<!-- extension responsive -->
<script src="{{url('js/dataTables.responsive.min.js')}}"></script>
</body>
</html>