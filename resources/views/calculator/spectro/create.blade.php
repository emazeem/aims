@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    @if(Session::has('failed'))
        <script>
            $(document).ready(function () {
                swal("Sorry!", '{{Session('failed')}}', "error");
            });
        </script>
    @endif
    <div class="col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/mytasks')}}">My Tasks</a></li>
            <li class="breadcrumb-item"><a href="{{URL::previous()}}">Task Detail</a></li>
        </ol>
        <h4><i class="fa fa-calculator"></i> Spectro-photometer Calculator</h4>

    </div>
    <input type="hidden" value="{{$parent->asset_id}}" name="asset">
    <input type="hidden" value="{{$parent->unit}}" name="unit">

    <div class="col-12">
        <form class="form-horizontal" action="{{route('spectro.calculator.data.entry.store')}}" method="post">
            @csrf
            <input type="hidden" value="{{$parent->id}}" name="parent_id">
            <input type="hidden" value="0" id="mulitplying_factor" name="mulitplying_factor">
            <input type="hidden" value="0" id="adding_factor" name="adding_factor">
            <input type="hidden" value="0" id="ref_unit" name="ref_unit">
            <div class="form-group col-md-12">
                <label for="assets" class="control-label">Assets</label>
                <select class="form-control" id="assets" name="assets">
                    <option selected disabled>Assets</option>
                    @foreach($assets as $asset)
                        <option value="{{$asset->id}}" >{{$asset->name}} ({{$asset->code}}) ({{$asset->range}})</option>
                    @endforeach
                </select>
                @if ($errors->has('assets'))
                    <span class="text-danger"><strong>{{ $errors->first('assets') }}</strong></span>
                @endif
            </div>
            <div class="row cal-inputs">
                <table id="myTable" class=" table order-list">
                    <thead>
                    <tr>
                        <td>Unit</td>
                        <td>Filter</td>
                        <td>Wavelength UUC</td>
                        <td>X<sub>1</sub></td>
                        <td>X<sub>2</sub></td>
                        <td>X<sub>3</sub></td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>
                            <select class="form-control " id="units" name="units[]">
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('units'))
                                <span class="text-danger"><strong>{{ $errors->first('units') }}</strong></span>
                            @endif
                        </td>
                        <td>
                            <select class="form-control" id="filtertype" name="filtertype[]">
                                <option value="N2">N2</option>
                                <option value="N3">N3</option>
                                <option value="N4">N4</option>
                                <option value="H1">H1</option>
                            </select>
                            @if ($errors->has('filtertype'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('filtertype') }}</strong>
                                </span>
                            @endif

                        </td>

                        <td>
                            <select class="form-control" id="w_uuc" name="w_uuc[]">
                                <option value="440">440</option>
                                <option value="465">465</option>
                                <option value="546.1">546.1</option>
                                <option value="590">590</option>
                                <option value="635">635</option>
                            </select>
                            @if ($errors->has('w_uuc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('w_uuc') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x1[]" class="form-control"/>
                            @if ($errors->has('x1'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x1') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x2[]" class="form-control"/>
                            @if ($errors->has('x2'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x2') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" name="x3[]" class="form-control "/>
                            @if ($errors->has('x3'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('x3') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)"  id="addrow" class="btn btn-primary btn-sm text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                    </tr>
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
            </div>

            <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-light border"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
    <script>

        $(document).ready(function () {
            var counter = 0;
            $('#counter').val(counter);
            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td>                            <select class="form-control " id="units" name="units[]">\n' +
                    '                                @foreach($units as $unit)\n' +
                    '                                    <option value="{{$unit->id}}">{{$unit->unit}}</option>\n' +
                    '                                @endforeach\n' +
                    '                            </select>\n</td>';
                cols += '<td>                            <select class="form-control" id="filtertype" name="filtertype[]">\n' +
                    '                                <option value="N2">N2</option>\n' +
                    '                                <option value="N3">N3</option>\n' +
                    '                                <option value="N4">N4</option>\n' +
                    '                                <option value="H1">H1</option>\n' +
                    '                            </select></td>';
                cols += '<td>                            <select class="form-control" id="w_uuc" name="w_uuc[]">\n' +
                    '                                <option value="440">440</option>\n' +
                    '                                <option value="465">465</option>\n' +
                    '                                <option value="546.1">546.1</option>\n' +
                    '                                <option value="590">590</option>\n' +
                    '                                <option value="635">635</option>\n' +
                    '                            </select></td>';

                cols += '<td><input type="text" class="form-control" id="x1" name="x1[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x2" name="x2[]"/></td>';
                cols += '<td><input type="text" class="form-control" id="x3" name="x3[]"/></td>';
                cols += '<td><a href="javascript:void(0)" class="btn btn-danger btn-sm ibtnDel"><i class=" fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });


            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1;
            });

            $('.labs').on('click', function (e) {
                e.preventDefault();
                var lab = $(this).attr('data-id');
                $('#location').val(lab);
            });
        });

    </script>
@endsection