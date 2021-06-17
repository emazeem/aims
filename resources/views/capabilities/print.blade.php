<!doctype html>
<html lang="en">
<head>
    <link media="print" rel="Alternate" href="print.pdf">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master List of Capabilities</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body{
            font-family: Consolas;
        }
    </style>
    <script>
        function fix_table_header_position(){
            var width_list = [];
            $("th").each(function(){
                width_list.push($(this).width());
            });
            $("tr:first").css("position", "absolute");
            $("tr:first").css("z-index", "1000");
            $("th, td").each(function(index){
                $(this).width(width_list[index]);
            });

            $("tr:first").after("<tr height=" + $("tr:first").height() + "></tr>");}
            $(document).ready(function () {
                fix_table_header_position();
            });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row font-style">
        <div class="col-12">
            <a href="" onclick="window.print()" class="float-right mt-2">Print</a>
            <h4 class="text-center">MASTER LIST OF CAPABILITIES</h4>
        </div>
        <div class="col-12">
            <table class="table table-sm table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Parameter</th>
                    <th>Capability</th>
                    <th>Range</th>
                    <th>Acc. Range</th>
                    <th>Acc</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Procedure</th>
                    <th>Location</th>
                </tr>

                </thead>
                <tbody>
                @foreach($capabilities as $k=> $capability)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$capability->parameters->name}}</td>
                        <td>{{$capability->name}}</td>
                        <td>{{$capability->min_range.'~'.$capability->max_range}}</td>
                        <td>{{$capability->accredited_min_range.'~'.$capability->accredited_max_range}}</td>
                        <td>{{$capability->accredited}}</td>
                        <td class="text-right">{{number_format($capability->price)}}</td>
                        <td>{{$capability->units->unit}}</td>
                        <td>{{$capability->procedures->name}}</td>
                        <td class="text-capitalize">{{$capability->location}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
</body>
</html>