<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JOB FORM</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">
    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/AIMS.png')}}" class="pl-2 pt-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 10px">
                    CALIBRATION DATA SHEET
                </p>
            </div>
            <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">Doc # AIMS-TM-FRM-09</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date: Oct 06, 2016</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 00
                </p>
            </div>
        </div>
        <table class="table table-bordered mt-3">
            <tr>
                <td class="h3" colspan="100%">
                    Uncertainty Evaluation for Temperature
                </td>
            </tr>
            <tr>
                <td>Standard Deviation</td>
                <td class="text-center"  colspan="100%">Uncertainty Budget</td>
            </tr>
            <tr>
                @foreach($uncertainties  as $uncertainty)
                        <?php
                        $u=\App\Models\Uncertainty::where('slug',$uncertainty)->first();
                        ?>
                        <td>{{$u->name}}</td>
                @endforeach
            </tr>


        </table>
    </div>
</div>
</body>
</html>