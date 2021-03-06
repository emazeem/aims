<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    body{
        font-family: "Times New Roman";
    }
</style>
<body>
<div class="container  my-5">
    <div class="row">
        <div class="col-12 text-center mt-2">
            <h2><span class="custom-border" style="padding-top: 12px;padding-bottom: 12px;padding-left: 2px;padding-right: 2px;"><span class="custom-border p-2">CALIBRATION CERTIFICATE</span></span></h2>
        </div>
        <div class="col-12 text-right">
            Date of Issue :
            <span class="custom-bottom-border">{{date('d-M-Y',strtotime($entries->created_at))}}</span>
        </div>
        <div class="col-12 text-right">
            Calibration Certificate #:
            <span class="custom-bottom-border font-weight-bold">AIMS/CC/20/01436</span>
        </div>
        <h5 class=" custom-bottom-border col-12 p-0 m-0 mb-3 font-weight-bold">CUSTOMER DETAILS:</h5>
        <div class="row col-12 p-0">
            <div class="col-2 font-weight-bold">Customer Name</div>
            <div class="col-10 font-weight-bold">{{$mainjob->quotes->customers->reg_name}}</div>
            <div class="col-2 font-weight-bold">Address :</div>
            <div class="col-10">{{$mainjob->quotes->customers->address}}</div>
            <div class="col-2 font-weight-bold">Request #:</div>
            <div class="col-10">{{$mainjob->quotes->details}}</div>
            <div class="col-2 font-weight-bold">Job #:</div>
            <div class="col-10">{{'JN/'.date('y',strtotime($mainjob->created_at)).'/'.$mainjob->id}}</div>
        </div>
        <h5 class="mt-3 custom-bottom-border col-12 p-0 m-0  mb-3 font-weight-bold">DETAILS OF UNIT UNDER CALIBRATION:</h5>
        <div class="row col-12 p-0">
            <div class="col-2 font-weight-bold">Calibration Date:</div>
            <div class="col-2 font-weight-bold">{{date('d-M-Y',strtotime($entries->created_at))}}</div>
            <div class="col-8 d-flex justify-content-between">
                <strong>Calibration Due (Proposed):
                </strong>
                <p>Three ( 3 ) months from the date of calibration, (Where Required)</p>
            </div>
            <div class="col-2 font-weight-bold" style="margin-top: -10px">Location:</div>
            <div class="col-10"  style="margin-top: -10px">{{$entries->location}}</div>
        </div>
        <table class="table table-bordered text-center mt-2">
            <tr>
                <th>UUC Description</th>
                <th>Make</th>
                <th>Model/Type</th>
                <th>Serial #</th>
                <th>Asset ID</th>
                <th>Accuracy</th>
            </tr>
            <tr>
                <td class="py-3">{{$job->item->capabilities->name}}</td>
                <td class="py-3">{{$job->make}}</td>
                <td class="py-3">{{$job->model}}</td>
                <td class="py-3">{{$job->serial}}</td>
                <td class="py-3">{{$job->eq_id}}</td>
                <td class="py-3">{{$job->accuracy}}</td>
            </tr>
        </table>
    </div>
    <div class=row>
        <div class="col-6 row">
            <div class="col-3 font-weight-bold">
                Condition:
            </div>
            <div class="col-9">
                <input type="checkbox"> Working Satisfactory upon receipt<br>
                <input type="checkbox"> Not Working Satisfactory upon receipt<br>
                <input type="checkbox"> Found to meet specification upon receipt

            </div>
        </div>
        <div class="col-6">
            <input type="checkbox"> Calibration done without relevant specification<br>
            <input type="checkbox"> Calibration done after adjustment / repair<br>

        </div>
    </div>
    <div class="row">
        <h5 class="mt-3 custom-bottom-border col-12 p-0 m-0  mb-3 font-weight-bold">ENVIRONMENTAL CONDITIONS DURING TEST:</h5>
    </div>

    <div class="row">
        <div class="row col-12">
            <div class="col-3 font-weight-bold">Temperature :</div>
            <div class="col-9"> {{($entries->start_temp+$entries->end_temp)/2}} °C  ±  {{abs($entries->start_temp-($entries->start_temp+$entries->end_temp)/2)}}°C </div>
            <div class="col-3 font-weight-bold">Relative Humidity :</div>
            <div class="col-9">{{($entries->start_humidity+$entries->end_humidity)/2}} °C  ±  {{abs($entries->start_humidity-($entries->start_humidity+$entries->end_humidity)/2)}}°C</div>
        </div>
    </div>
    <div class="row">
        <h5 class="mt-3 custom-bottom-border col-12 p-0 m-0  mb-3 font-weight-bold">CALIBRATION METHOD:</h5>

    </div>
    <div class="row">
        <div class="col-3">Calibration Procedure:</div>
        <div class="col-3">{{$job->item->capabilities->procedures->name}}</div>
        <div class="col-6">Calibration of Weighing Instruments</div>
    </div>
    <div class="row">
        <h5 class="mt-3 custom-bottom-border col-12 p-0 m-0  mb-3 font-weight-bold">TRACEABILITY:</h5>
    </div>
    <div class="row">
        <div class="col-2 font-weight-bold">Traceability:</div>
        <div class="col-10">The measurements made by Al Meezan Industrial Metrology Services, are traceable to physical units of  measurements (SI),
            through its state of the art calibration standards that are controlled and maintained by AIMS. Reference equipment used
            is/are traceable to National / International standards through other prestigious calibration laboratories, details given below:
        </div>

        <b>Reference Equipment</b>
        <table class="table table-bordered text-center">
            <tr>
                <th>Description</th>
                <th>Make</th>
                <th>Model/Type</th>
                <th>Asset ID</th>
                <th>Certificate #</th>
                <th>Traceability</th>
            </tr>

                @foreach($assets as $asset)
                <tr>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->name}}</td>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->make}}</td>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->model}}</td>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->code}}</td>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->certificate_no}}</td>
                        <td class="py-3">{{\App\Models\Asset::find($asset)->traceability}}</td>
                </tr>
                @endforeach
        </table>
    </div>
    <div class="row">
        <div class="text-center col-12">For calibration results see next page(s)
            <br>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <b>Approved Signatories</b>
                </div>
                <div class="col-10">
                    Shahzad Ahmed (GM)
                </div>

                <div class="col-2">
                    <input type="checkbox" checked>
                </div>
                <div class="col-10">
                    <i>Ghulam Server (QM)</i>
                </div>

                <div class="col-2">
                    <input type="checkbox">
                </div>
                <div class="col-10">
                    Riaz Ahmad (Lab Incharge)
                </div>
                <div class="col-2">
                    <input type="checkbox">
                </div>
            </div>
        </div>
        <div class="col-4 mt-auto">
            (Approved Signatory) :  _________________
        </div>
    </div>
    <div class="row">

        <h5 class=" custom-bottom-border col-12 p-0 m-0 mb-3 font-weight-bold">MEASUREMENT CONDITIONS: (Optional) :</h5>
        <h5 class=" custom-bottom-border col-12 p-0 m-0 mb-3 font-weight-bold">CALIBRATION RESULTS:</h5>
    </div>
    @foreach($p as $i)
    <div class="row">
        <h6 class=" custom-bottom-border col-12 p-0 m-0 mb-3 font-weight-bold">Measurement Data for {{\App\Models\Parameter::find($i)->name}}</h6>
            <div class="col-3 font-weight-bold">Calibrated Range :</div>
            <div class="col-9"> {{$job->range}}</div>
            <div class="col-3 font-weight-bold">Resolution : </div>
            <div class="col-9">{{$job->resolution}}</div>
        </div>

    <div class="row mt-2">
        <table class="table table-bordered text-center">
            <tr>
                <td width="25%">
                    Unit Under Calibration
                    <br>X
                    <br>( {{\App\Models\Unit::find($entries->unit)->unit}} )
                </td>
                <td width="25%">
                    Reference Standard Values
                    <br>A
                    <br>( {{\App\Models\Unit::find($entries->unit)->unit}} )
                </td>
                <td width="25%">
                    Deviation
                    <br>X - A
                    <br>(	{{\App\Models\Unit::find($entries->unit)->unit}}		)
                </td>
                <td width="25%">
                    Uncertainty
                    <br>
                    <i>U</i>
                    <br>±(	{{\App\Models\Unit::find($entries->unit)->unit}}	)
                </td>
            </tr>
            @foreach($allentries as $allentry)
                @if(\App\Models\Asset::find($allentry->parent->asset_id)->parameter==$i)
                <tr>
                    <?php
                        $n=0;
                        $x1=($allentry->x1)?$allentry->x1:null;
                        $x2=($allentry->x2)?$allentry->x2:null;
                        $x3=($allentry->x3)?$allentry->x3:null;
                        $x4=($allentry->x4)?$allentry->x4:null;
                        $x5=($allentry->x5)?$allentry->x5:null;
                        if (isset($x1)){$n++;}
                        if (isset($x2)){$n++;}
                        if (isset($x3)){$n++;}
                        if (isset($x4)){$n++;}
                        if (isset($x5)){$n++;}
                        $average_repeated_value=($x1+$x2+$x3+$x4+$x5)/$n;
                    ?>
                        <td>
                            @if($allentry->parent->fixed_type=="UUC")
                                {{$average_repeated_value}}
                            @else
                                {{$allentry->fixed_value}}
                            @endif
                        </td>
                        <td>
                            @if($allentry->parent->fixed_type=="UUC")
                                {{$allentry->fixed_value}}
                            @else
                                {{$average_repeated_value}}
                            @endif
                        </td>
                        <td>
                            {{$data[$allentry->fixed_value]['final-error']}}
                        </td>
                        <td>
                            {{$data[$allentry->fixed_value]['expanded-uncertainty']}}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    @endforeach

    <div class="row">
        <div class="col-12">
            The reported expanded uncertainty is based on combined standard uncertainty multiplied by a coverage factor k=2, providing a
            coverage probability of approximately 95%.
            <h6>Disclaimer / Remarks</h6>
            <input type="checkbox"> Values were rounded in computation.
            <br><input type="checkbox"> * Values not covered in accredited scope.
            <br><input type="checkbox"> Over load test was not performed.
            <br><input type="checkbox"> No Accessories were fitted during calibration.
            <br><input type="checkbox"> Others ___________________________________

        </div>
    </div>
    <div class="row">
        <div class="col-12 ">
            <b>Statement of Conformity:</b>
            <br>
            <div class="col-12 ml-2 font-italic"><input type="checkbox" class="mr-2"> Statement of Conformity not given in this certificate as process control limits were not conveyed by the customer.</div>
            <div class="col-12 ml-2 font-italic"><input type="checkbox" class="mr-2"> The equipment complies with the process control limits used as specifications given by customer at the measured
            point(s), with due allowance having been made for the uncertainty of the measurements. The decision rule deployed
            in issuing this statement of conformity is taking into account the measurement  uncertainty with zero guard band.
                <br>

            <span class="ml-4"><input type="checkbox" class="mr-2"> The measured values along with their respective uncertainty bands fall with in the process control limits and
                thus the unit under calibration conforms to the specifications (process control limits given by customer).</span>
                <br>
                <span class="ml-4"><input type="checkbox" class="mr-2"> The measured values along with their respective uncertainty bands do not fall with in the process control limits and
                    thus the unit under calibration does not conforms to the specifications (process control limits given by customer).</span>
            </div>

        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <b>Disclaimer / Remarks</b>
            <br>

            <span><input type="checkbox" class="mr-2">Values were rounded in computation.</span><br>
            <span><input type="checkbox" class="mr-2">* Values not covered in accredited scope.</span><br>
            <span><input type="checkbox" class="mr-2">Over load test was not performed.</span><br>
            <span><input type="checkbox" class="mr-2">No Accessories were fitted during calibration.</span><br>
            <span><input type="checkbox" class="mr-2">Others</span>

        </div>
    </div>
    <div class="col-10 text-right mt-4">
        Calibrated By: 			{{\App\Models\User::find($entries->calibrated_by)->fname .' '. \App\Models\User::find($entries->calibrated_by)->lname}}
    </div>
    <center><div class="col-4 custom-bottom-border mt-3"></div></center>
    <div class="col-12 custom-bottom-border text-center font-weight-bold">
        End of Calibration Certificate
    </div>
    <div class="col-12 custom-bottom-border pt-2">
        This certificate is issued in accordance with the requirements of ISO/IEC 17025:2005 Standard, General Requirements for the competence of Testing and Calibration Laboratories. All measurements recorded in this certificate are traceable to National / International standards. The reference listed above are subjected to regular periodic calibration. This certificate may not be reproduced other than in full, except with the prior written approval of issuing laboratory.
    </div>
</div>
</body>
</html>