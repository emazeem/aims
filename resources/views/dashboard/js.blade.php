<script>
    function getAttendance(date){
        $.ajax({
            url: "{{route('dashboard.get.attendance')}}",
            type: 'POST',
            dataType: "JSON",
            data: {date:date,_token: '{{csrf_token()}}'},
            beforeSend: function () {
                $('#data-attendance').prop('disabled',true);
                $('.attendance-table').empty();
                $('.lazy-loader').fadeIn();
            },
            success: function (data) {
                $('.lazy-loader').hide();
                $('#data-attendance').prop('disabled',false);
                $.each(data ,function (i,v) {
                    $('.attendance-table').append(
                        "<tr><td>" + v.user + "</td><td>" + v.check_in + "</td><td>" + v.check_out + "</td></tr>"
                    );
                });
            },
        });
    }
    $(document).ready(function () {
        getAttendance('{{date('Y-m-d')}}');
        $('#date-attendance').on('change', function() {
            var attendance = $(this).val();
            getAttendance(attendance);
        });
        $.ajax({
            url: "{{route('dashboard.get.location')}}",
            type: 'POST',
            dataType: "JSON",
            data: {_token: '{{csrf_token()}}'},
            beforeSend: function () {
                $(".loading-component").fadeIn();
            },
            success: function (data) {
                $(".loading-component").hide();
                $('.weather-description').html(data['weather-description']);
                $('.day').html(data['day']);
                $('.temp-in-centi').html(data['temp-in-centi']);
                $('.temp-icon').attr('src',data['icon']);
                $('.country-city').html('<i class="feather icon-map-pin"></i> '+data['city']+', '+data['country']);
                $('.temp-toggler').attr('checked','checked');
            },
        });
        $(document).on('click', '.checkin', function (e) {
            var button=$('.checkin');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

            swal({
                title: "Are you sure to check in?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#check_form").attr("method");
                        var form_data = $("#check_form").serialize();
                        //e.preventDefault();
                        $.ajax({
                            url: "{{route('attendance.checkin')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            statusCode: {
                                403: function () {
                                    button.attr('disabled',null).html(previous);
                                    swal("Failed", "Permission denied for this action.", "error");
                                    return false;
                                }
                            },
                            success: function (data) {
                                button.attr('disabled',null).html(previous);
                                swal("Success", data.success, "success").then(response=>{
                                    location.reload();
                                });
                            },
                            error: function () {
                                button.attr('disabled',null).html(previous);
                                swal("Failed", "Unable to check in.", "error");
                            },
                        });

                    }
                    else{
                        button.attr('disabled',null).html(previous);
                    }
                });

        });
        $(document).on('click', '.checkout', function (e) {
            var button=$('.checkout');
            var previous=$(button).html();
            button.attr('disabled','disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

            swal({
                title: "Are you sure to check out?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#check_form").attr("method");
                        var form_data = $("#check_form").serialize();


                        //e.preventDefault();
                        $.ajax({
                            url: "{{route('attendance.checkout')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            statusCode: {
                                403: function () {
                                    button.attr('disabled',null).html(previous);
                                    swal("Failed", "Permission denied for this action.", "error");
                                    return false;
                                }
                            },
                            success: function (data) {
                                button.attr('disabled',null).html(previous);
                                swal("Success", data.success, "success").then(response=>{
                                    location.reload();
                                });
                            },
                            error: function () {
                                button.attr('disabled',null).html(previous);
                                swal("Failed", "Unable to check out.", "error");
                            },
                        });

                    }
                    else{
                        button.attr('disabled',null).html(previous);
                    }
                });

        });
        setInterval(function () {
            $('#current_time').html(moment().format('MMM D YYYY, h:mm:ss A'));
            $('#current_time_gadget').html(moment().format('h:mm:ss A'));
        }, 1000);
        $(document).on('click','.temp-toggler',function () {
            var checked=$('.temp-toggler').is(":checked");
            if (checked==true){
                var centi=$('.temp-in-centi').html();
                $('.temp-in-centi').hide().html((centi-32)*5/9).fadeToggle(2000);
            }else {
                var faren=$('.temp-in-centi').html();
                $('.temp-in-centi').hide().html((faren*9/5)+32).fadeToggle(2000);
            }
        });
    });
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    window.onload = function () {

        CanvasJS.addColorSet("greenShades",
            [//colorSet Array

                "#ff5b51",
                "#9eccff",
                "#897399",
                "#88aa5c",
            ]);
        var chart1 = new CanvasJS.Chart("quoteContainer", {
            colorSet: "greenShades",
            animationEnabled: true,
            title:{
                text: "Quotes",
                fontFamily: "tahoma",
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: <strong>{y}</strong>",
                indexLabel: "{name} - {y}",
                dataPoints: [
                    { y: {{$pendings_q}}, name: "Pending" },
                    { y: {{$notsents_q}}, name: "To be Sent" },
                    { y: {{$waitings_q}}, name: "Waiting approval" },
                    { y: {{$approved_q}}, name: "Approved" },
                ]
            }]
        });
        var chart2 = new CanvasJS.Chart("jobContainer", {
            colorSet: "greenShades",
            animationEnabled: true,
            title:{
                text: "Jobs",
                fontFamily: "tahoma",
            },
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: <strong>{y}</strong>",
                indexLabel: "{name} - {y}",
                dataPoints: [
                    { y: {{$pending_j}}, name: "Pending" },
                    { y: {{$completed_j}}, name: "Completed & Waiting for Invoice" },
                    { y: {{$invoiced_j}}, name: "Invoiced" },
                ]
            }]
        });
        chart1.render();
        chart2.render();
    };

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();
    }








</script>

{{--data: [@php foreach ($gparameters as $gparameter){ echo count(\App\Models\Asset::where('parameter',$gparameter->id)->get()).',';} @endphp],--}}
