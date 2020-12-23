@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="border-bottom"><i class="fa fa-pencil"></i> Edit Error & Uncertainty</h3>
        </div>
        <div class="col-12">

            <form class="form-horizontal" action="{{route('manageref.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="parameter" class="col-2 control-label">Select Parameter</label>
                    <div class="col-10">
                        <select class="form-control" id="parameter" name="parameter" >
                            <option value="" selected disabled>Select Parameter</option>
                            @foreach($parameters as $parameter)
                                <option value="{{$parameter->id}}" {{($edit->parameter==$parameter->id)?'selected':""}}>{{$parameter->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('parameter'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('parameter') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="assets" class="col-2 control-label">Select Assets</label>
                    <div class="col-10">
                        <select class="form-control" id="assets" name="assets" >
                            <option value="{{$edit->asset}}" selected>{{\App\Models\Asset::find($edit->asset)->name}}</option>
                        </select>
                        @if ($errors->has('assets'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('assets') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="units" class="col-2 control-label">Select Units</label>
                    <div class="col-10">
                        <select class="form-control" id="units" name="units" >
                            <option value="{{$edit->unit}}" selected>{{\App\Models\Unit::find($edit->unit)->unit}}</option>
                        </select>
                        @if ($errors->has('units'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('units') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Unit Under Calibration</td>
                        <td>Reference Standard</td>
                        <td>Uncertainty</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($multiples as $key=>$multiple)
                        <tr>
                            <td>

                                <input type="text" name="uuc[]"  class="form-control" value="{{$multiple->uuc}}"/>

                            </td>
                            <td>
                                <input type="text" name="reference[]"  class="form-control" value="{{$multiple->ref}}"/>
                                @if ($errors->has('reference'))
                                    <span class="text-danger">
                                    <strong>{{ $errors->first('reference') }}</strong>
                                </span>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="uncertainty[]"  class="form-control " value="{{$multiple->uncertainty}}"/>
                                @if ($errors->has('uncertainty'))
                                    <span class="text-danger">
                                    <strong>{{ $errors->first('uncertainty') }}</strong>
                                </span>
                                @endif
                            </td>
                            <td >
                                <a class="deleteRow"></a>
                                @if($key==0)
                                    <a href="javascript:void(0)"  id="addrow" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                                @endif
                                <a href="javascript:void(0)" class="ibtnDel btn btn-danger btn-sm mt-2 text-lg "><i class="fa fa-times-circle"></i></a>
{{--                                <i  id="addrow" class="fa fa-plus-circle text-primary mt-2 text-lg"></i>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>@if ($errors->has('uuc'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('uuc') }}</strong>
                            </span>
                            @endif
                        </td>

                    </tr>
                    </tfoot>
                </table>

{{--
                <div class="form-group mt-md-4">
                    <label for="uuc" class="col-12 control-label">UUC / Asset Value</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="uuc" name="uuc" placeholder="uuc" autocomplete="off" value="{{old('uuc')}}">
                        @if ($errors->has('uuc'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('uuc') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4">
                    <label for="reference" class="col-12 control-label">Reference Value</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="reference" name="reference" placeholder="reference" autocomplete="off" value="{{old('reference')}}">
                        @if ($errors->has('reference'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('reference') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4">
                    <label for="uncertainty" class="col-12 control-label">Uncertainty</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="uncertainty" name="uncertainty" placeholder="uncertainty" autocomplete="off" value="{{old('uncertainty')}}">
                        @if ($errors->has('uncertainty'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('uncertainty') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
--}}

                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="parameter"]').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    "url": "{{url('/parameters/view_assets')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        //$(".loader").fadeIn();
                    },
                    statusCode: {
                        403: function() {

                        }
                    },
                    success: function(data)
                    {
                        $('select[name="assets"]').empty();
                        $('select[name="assets"]').append('<option disabled selected>Select Asset</option>');
                        $.each(data, function(key, value) {
                            $('select[name="assets"]').append('<option value="'+ value.id +'">'+ value.name +' - '+ value.code +'</option>');
                        });
                    },
                    error: function(){
                        $('select[name="assets"]').empty();
                    },
                });
            });
            $('select[name="assets"]').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    "url": "{{url('/parameters/view_units')}}",
                    type: "POST",
                    data: {'id': id,_token: '{{csrf_token()}}'},
                    dataType : "json",
                    beforeSend : function()
                    {
                        //$(".loader").fadeIn();
                    },
                    statusCode: {
                        403: function() {

                        }
                    },
                    success: function(data)
                    {
                        $('select[name="units"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="units"]').append('<option value="'+ value.id +'">'+ value.unit +'</option>');
                        });
                    },
                    error: function(){
                        $('select[name="units"]').empty();
                    },
                });
            });

        });










        $(document).ready(function () {
            var counter = 0;

            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";

                cols += '<td><input type="text" class="form-control" name="uuc[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="reference[]"/></td>';
                cols += '<td><input type="text" class="form-control" name="uncertainty[]"/></td>';

                cols += '<td><a href="javascript:void(0)" class="ibtnDel btn btn-danger btn-sm mt-2 text-lg "><i class="fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });



            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1
            });


        });



        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();

        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function () {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
        }
    </script>
@endsection

