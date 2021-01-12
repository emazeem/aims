@extends('layouts.master')
@section('content')

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    @if(session('failed'))
        <script>
            $(document).ready(function () {
                swal("Failed", "{{session('failed')}}", "error");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h5 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Employee Contract
            </h5>
        </div>
        <div class="col-12">

            <table class="table table-hover font-13 table-bordered">

                <tr>
                    <th>Appraisal ID</th>
                    <td>{{$show->appraisal_id}}</td>
                </tr>
                <tr>
                    <th>CNIC</th>
                    <td>{{$show->cnic}}</td>
                </tr>

                <tr>
                    <th>Termination Period</th>
                    <td class="text-capitalize">{{str_replace('-', ' ', $show->termination_period)}} </td>
                </tr>
                <tr>
                    <th>Probation Period</th>
                    <td class="text-capitalize">{{str_replace('-', ' ', $show->probation_period)}} </td>
                </tr>
                <tr>
                    <th>Designations</th>
                    <td class="text-capitalize">{{$show->designations}} </td>
                </tr>
                <tr>
                    <th>Place of Work</th>
                    <td class="text-capitalize">{{$show->place_of_work}} </td>
                </tr>
                <tr>
                    <th>Salary</th>
                    <td class="text-capitalize">{{$show->salary}} </td>
                </tr>
                <tr>
                    <th>Allowances</th>
                    <td class="text-capitalize">{{$show->allowances}} </td>
                </tr>
                <tr>
                    <th>Commencement Date</th>
                    <td class="text-capitalize">{{date('d-m-Y',strtotime($show->commencement))}} </td>
                </tr>








                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>Updated on</th>
                    <td>{{date('h:i A - d M,Y ',strtotime($show->updated_at))}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection