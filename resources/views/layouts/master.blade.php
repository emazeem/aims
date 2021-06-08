<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rubik</title>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content=""/>
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes"/>
    <link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('style.css')}}">
    <script type="text/javascript" src="{{url('js/sweetalert.min.js')}}"></script>

    <link rel="stylesheet" href="{{url('assets/css/plugins/select2.min.css')}}">

</head>
@if(Route::currentRouteName()!='login')
    <body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('layouts.menu-list')
    @include('layouts.head')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            @yield('content')
        </div>
    </div>
    @else
        @yield('content')
    @endif
    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/pcoded.min.js')}}"></script>
    <script src="{{url('assets/js/menu-setting.min.js')}}"></script>

    @if(Route::currentRouteName()=='home' or Route::currentRouteName()=='customers' or Route::currentRouteName()=='departments'or Route::currentRouteName()=='designations'or Route::currentRouteName()=='users' or Route::currentRouteName()=='parameters'
    or Route::currentRouteName()=='assets' or Route::currentRouteName()=='procedures' or Route::currentRouteName()=='capabilities' or Route::currentRouteName()=='manageref'or Route::currentRouteName()=='units'or Route::currentRouteName()=='quotes.show' or Route::currentRouteName()=='generaterequests.show'
    or Route::currentRouteName()=='uncertainties'or Route::currentRouteName()=='columns'or Route::currentRouteName()=='assets.groups'or Route::currentRouteName()=='quotes'or Route::currentRouteName()=='purchase.indent.index'
    or Route::currentRouteName()=='pendings' or Route::currentRouteName()=='jobs.manage' or Route::currentRouteName()=='jobs'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='material.receiving.index'
    or Route::currentRouteName()=='invoicing_ledger' or Route::currentRouteName()=='expenses'or Route::currentRouteName()=='expenses_categories'or Route::currentRouteName()=='menus'or Route::currentRouteName()=='roles'
    or Route::currentRouteName()=='preferences.index' or Route::currentRouteName()=='mytasks' or Route::currentRouteName()=='certificates' or Route::currentRouteName()=='certificates'or Route::currentRouteName()=='sops'or Route::currentRouteName()=='forms.index'
    or Route::currentRouteName()=='activitylog.index' or Route::currentRouteName()=='nofacility.index' or Route::currentRouteName()=='capabilities.groups' or Route::currentRouteName()=='emp_contract.index' or Route::currentRouteName()=='requisition.index'
    or Route::currentRouteName()=='interview_appraisal.index' or Route::currentRouteName()=='emp_joining.index' or Route::currentRouteName()=='emp_orientation.index' or Route::currentRouteName()=='leave_application.index' or Route::currentRouteName()=='acc_level_one'
    or Route::currentRouteName()=='acc_level_two'or Route::currentRouteName()=='acc_level_three'or Route::currentRouteName()=='acc_level_four'or Route::currentRouteName()=='vouchers' or Route::currentRouteName()=='sales.invoice'or Route::currentRouteName()=='vendors' or Route::currentRouteName()=='po'  or Route::currentRouteName()=='sales.receipt.vouchers'or Route::currentRouteName()=='journal.index' or Route::currentRouteName()=='generaterequests'
    or Route::currentRouteName()=='inventory.category.index' or Route::currentRouteName()=='inventory.index' or Route::currentRouteName()=='business.line' or Route::currentRouteName()=='purchase.invoice'  or Route::currentRouteName()=='journal.vouchers' or Route::currentRouteName()=='sales.invoice.create' or Route::currentRouteName()=='purchase.invoice.create'
    or Route::currentRouteName()=='vouchers.all' or Route::currentRouteName()=='log_reviews')
        <link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
        <script type="text/javascript" src="{{url('js/datatables.min.js')}}"></script>
        <script src="{{url('js/dataTables.responsive.min.js')}}"></script>

    @endif
    @if(Route::currentRouteName()=='home')
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    @endif

    <!-- select2 Js -->
    <script src="{{url('assets/js/plugins/select2.full.min.js')}}"></script>
    <!-- form-select-custom Js -->
    <script src="{{url('assets/js/pages/form-select-custom.js')}}"></script>

    </body>
</html>
