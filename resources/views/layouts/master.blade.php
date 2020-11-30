<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>AIMS</title>
    <link rel="icon" href="{{url('/img/aims-logo.png')}}">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{url('styling.css')}}" rel="stylesheet">
    <script src="{{url('js/sweetalert.min.js')}}"></script>

    <script src="{{url('vendor/jquery/jquery.js')}}"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>

</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
@include('layouts.partials.sidebar')

<!-- Page Content  -->
    <div id="content" style="max-width: 100%;overflow: hidden">
        @include('layouts.partials.navbar')
        <div class="container-fluid">
            @yield('content')

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
</body>
<link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
<!--   Datatables-->
<script type="text/javascript" src="{{url('js/datatables.min.js')}}"></script>
<!-- extension responsive -->
<script src="{{url('js/dataTables.responsive.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</html>