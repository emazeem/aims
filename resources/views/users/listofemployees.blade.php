<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master List of Equipments</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style> .font-custom{font-size: 12px;} </style>
</head>
<body>
<div class="container">
    <div class="col-12 font-style mt-2">
        <div class="row custom-border">
            <div class="col-2 text-center custom-border-right">
                <img src="{{url('/img/AIMS.png')}}" width="150" class="img-fluid p-1">

            </div>
            <div class="col-7  my-auto py-auto">
                <h6 class="text-center" style="margin-top: 10px">
                    LIST OF EMPLOYEES
                </h6>
            </div>
            <div class="col-3 row custom-border-left font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-BM-FRM-04,</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 06-10-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>
        </div>
        <div class="row">
            <table class="table table-stripped mt-4 table-sm table-bordered font-custom">
                <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Employee #</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>CNIC #</th>
                    <th>Joining Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $k=>$user)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$user->cid}}</td>
                        <td>{{$user->fname.' '.$user->lname}}</td>
                        <td>{{$user->designations->name}}</td>
                        <td>{{$user->cnic}}</td>
                        <td>{{$user->joining}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>