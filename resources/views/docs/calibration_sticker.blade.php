<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calibration Sticker</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body class="main">
<div class="container">
    <div class="col-12 font-style mt-2">
        <div class="col-6" id="printarea">
            <table class="table table-bordered p-0 m-0">
                <tbody>
                <tr>
                    <th colspan="2"  class="text-center">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
                            </div>
                            <div class="col-6">
                                <br>Al-Meezan Industrial <br>Metrology Services
                                <br><small>Tel: +92-42-37497298, info@aimscal.com</small>
                            </div>
                            <div class="col-3 my-auto">
                                {{QrCode::size(75)->generate('Item # 01 , Job # 001 , Asset ID / Serial # 34728934')}}
                            </div>
                        </div>

                    </th>
                </tr>
                <tr>
                    <th>ID / Sr # :</th>
                </tr>
                <tr>
                    <th>Cal Date :</th>
                </tr>
                <tr>
                    <th>Next Due :</th>
                </tr>
                </tbody>
            </table>
            <p class="text-center"><small>Doc #: AIMS-TM-FRM-12, Issue Date: 15-02-2020, Issue # : 01, Rev#: 01</small></p>
        </div>
    </div>
</div>
</body>
</html>
