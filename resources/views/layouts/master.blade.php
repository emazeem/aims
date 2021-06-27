<!DOCTYPE html>
<html lang="en">

<head>
    @php $title=Route::currentRouteName(); @endphp
    <title>Rubic - {{ucwords(str_replace('.',' ',str_replace('_',' ',$title)))}}</title>
    <script src="{{url('assets/js/html5shiv.js')}}"></script>
    <script src="{{url('assets/js/respond.min.js')}}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content=""/>
    <meta name="description" content=""/>
    <meta name="keywords" content="">
    <meta name="author" content=""/>
    <link rel="icon" href="{{url('img/rubic-logo-favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('assets/css/styling.css')}}">
    <link rel="stylesheet" href="{{url('css/styling.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/select2.min.css')}}">
</head>
@if(Route::currentRouteName()!='login')
    <body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <style>
        #overlay{
            position:fixed;
            z-index:99999;
            top:0;
            left:0;
            bottom:0;
            right:0;
            background:rgba(0,0,0,0.9);
            transition: 1s 0.4s;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
            display: none;
        }
    </style>

    @include('layouts.menu-list')
    @include('layouts.head')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <img src="{{url('/assets/images/loading-anim.gif')}}" alt="" id="overlay" class="loader-gif">
            @yield('content')
        </div>
    </div>
    @else
        @yield('content')
    @endif
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/pcoded.min.js')}}"></script>
    <script src="{{url('assets/js/menu-setting.min.js')}}"></script>

    <script type="text/javascript" src="{{url('js/sweetalert.min.js')}}"></script>

    @if(Route::currentRouteName()=='home' or Route::currentRouteName()=='customers' or Route::currentRouteName()=='departments'or Route::currentRouteName()=='designations'or Route::currentRouteName()=='users' or Route::currentRouteName()=='parameters'
    or Route::currentRouteName()=='assets' or Route::currentRouteName()=='procedures' or Route::currentRouteName()=='capabilities' or Route::currentRouteName()=='manageref'or Route::currentRouteName()=='units'or Route::currentRouteName()=='quotes.show' or Route::currentRouteName()=='generaterequests.show'
    or Route::currentRouteName()=='uncertainties'or Route::currentRouteName()=='columns'or Route::currentRouteName()=='assets.groups'or Route::currentRouteName()=='quotes'or Route::currentRouteName()=='purchase.indent.index'
    or Route::currentRouteName()=='pendings' or Route::currentRouteName()=='jobs.manage' or Route::currentRouteName()=='jobs'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='scheduling'or Route::currentRouteName()=='material.receiving.index'
    or Route::currentRouteName()=='invoicing_ledger' or Route::currentRouteName()=='expenses'or Route::currentRouteName()=='expenses_categories'or Route::currentRouteName()=='menus'or Route::currentRouteName()=='roles'
    or Route::currentRouteName()=='preferences.index' or Route::currentRouteName()=='lab.task' or Route::currentRouteName()=='site.task' or Route::currentRouteName()=='site.receiving' or Route::currentRouteName()=='certificates' or Route::currentRouteName()=='certificates'or Route::currentRouteName()=='sops'or Route::currentRouteName()=='forms.index'
    or Route::currentRouteName()=='activitylog.index' or Route::currentRouteName()=='no.facility.index' or Route::currentRouteName()=='capabilities.groups' or Route::currentRouteName()=='emp_contract.index' or Route::currentRouteName()=='requisition.index'
    or Route::currentRouteName()=='interview_appraisal.index' or Route::currentRouteName()=='emp_joining.index' or Route::currentRouteName()=='emp_orientation.index' or Route::currentRouteName()=='leave_application.index' or Route::currentRouteName()=='acc_level_one'
    or Route::currentRouteName()=='acc_level_two'or Route::currentRouteName()=='acc_level_three'or Route::currentRouteName()=='acc_level_four'or Route::currentRouteName()=='vouchers' or Route::currentRouteName()=='sales.invoice'or Route::currentRouteName()=='vendors' or Route::currentRouteName()=='po'  or Route::currentRouteName()=='sales.receipt.vouchers'or Route::currentRouteName()=='journal.index' or Route::currentRouteName()=='generaterequests'
    or Route::currentRouteName()=='inventory.category.index' or Route::currentRouteName()=='inventory.index' or Route::currentRouteName()=='business.line' or Route::currentRouteName()=='purchase.invoice'  or Route::currentRouteName()=='journal.vouchers' or Route::currentRouteName()=='sales.invoice.create' or Route::currentRouteName()=='purchase.invoice.create'
    or Route::currentRouteName()=='vouchers.all' or Route::currentRouteName()=='log_reviews' or Route::currentRouteName()=='grouped.capabilities' or Route::currentRouteName()=='gp.index')
        <link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{url('css/responsive.dataTables.min.css')}}">
        <script type="text/javascript" src="{{url('js/datatables.min.js')}}"></script>
        <script src="{{url('js/dataTables.responsive.min.js')}}"></script>

    @endif
    @if(Route::currentRouteName()=='home')
        <link rel="stylesheet" href="{{url('css/fullcalendar.min.css')}}"/>
        <script src="{{url('js/moment.min.js')}}"></script>
        <script src="{{url('js/fullcalendar.min.js')}}"></script>
    @endif


    <script src="{{url('assets/js/plugins/select2.full.min.js')}}"></script>
    <script src="{{url('assets/js/pages/form-select-custom.js')}}"></script>

    </body>
</html>
