<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
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
                    <th colspan="2"  class="text-center  py-3"> ITEM TAG</th>
                    <td rowspan="3" class="text-center p-0 m-0 py-3 ">
                        {{QrCode::size(75)->generate('Item # 01 , Job # 001 , Asset ID / Serial # 34728934')}}
                    </td>
                </tr>
                <tr>
                    <th>Job No :</th>
                </tr>
                <tr>
                    <th colspan="2">Item # : <span class="px-md-4"></span> of </th>
                </tr>
                </tbody>
            </table>
            <p class="text-center"><small>Doc # : AIMS-TM-FRM-12 , Rev#: 01</small></p>
        </div>
    </div>
</div>
</body>
</html>