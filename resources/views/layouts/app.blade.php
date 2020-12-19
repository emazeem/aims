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
    <!-- Bootstrap -->
    <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">

</head>
<body class="nav-md" style="background-color: #f4f4f4">

<div class="container">
    @yield('content')
</div>
        <!-- /footer content -->
<link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
<!-- jQuery -->
<script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
