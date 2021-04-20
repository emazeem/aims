@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
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
    <div class="row pb-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="border-bottom"><i class="fa fa-plus-circle"></i> Add Sales Voucher</h3>
        </div>
        <div class="col-12">
            <form id="add_voucher_form">
                @csrf
                <div class="form-group row">
                    <label for="business_line" class="col-2 control-label">Select Business Line</label>
                    <div class="col-10">
                        <select class="form-control" id="business_line" name="business_line" >
                            <option value="" selected disabled>Select Business Line</option>
                            @foreach($blines as $bline)
                                <option value="{{$bline->id}}" {{$bline->id==1?'selected':''}}>{{$bline->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('business_line'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('business_line') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_type" class="col-2 control-label">Select Voucher Type</label>
                    <div class="col-10">
                        <select class="form-control" id="v_type" name="v_type" >
                            <option value="" selected disabled>Select Voucher Type</option>
                            <option value="sales">Sales Voucher</option>
                        </select>
                        @if ($errors->has('v_type'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_date" class="col-2 control-label">Date of Voucher</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="v_date" name="v_date" value="{{old('v_date',date('Y-m-d'))}}">
                        @if ($errors->has('v_date'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('v_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="attachments" class="col-sm-8 control-label">Attachments</label>
                    <div class="col-sm-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="attachments[]" multiple id="attachments">
                            <label class="custom-file-label" for="attachments">Attachments (opt)</label>
                        </div>
                        @if ($errors->has('attachments'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('attachments') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <table id="myTable" class=" table order-list table-bordered bg-white table-hover">
                    <thead>
                    <tr>
                        <td style="width: 30%;">Account</td>
                        <td style="width: 15%;">Cost Center</td>
                        <td style="width: 20%;">Narration</td>
                        <td style="width: 10%;">Dr.</td>
                        <td style="width: 10%;">Cr.</td>
                        <td style="width: 5%;">
                            <a class="deleteRow"></a>
                            <a href="javascript:void(0)"  id="addrow" class="btn btn-primary btn-sm mt-2 text-lg"><i class="fa fa-plus-circle"></i></a>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                </table>

                <a href="{{ URL::previous() }}" class="btn btn-light border"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var count = 0;
            $("#addrow").on("click", function () {
                count++;
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><select name="account[]"  class="form-control item_category" id="account" data-sub_category_id="'+count+'"><option value="" selected>Select Account</option>@php foreach ($accounts as $account){ echo '<option value="'.$account->acc_code.'">'.$account->title.'</option>';}  @endphp</td>';
                cols += '<td><select name="costcenter[]"  class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="" selected>Select Cost Center</option></select></td>';
                cols += '<td><textarea rows="1"  class="form-control" name="narration[]" placeholder="Narration"/></td>';
                cols += '<td><input type="text"  name="dr[]"  class="form-control" id="dr" placeholder="Dr."></td>';
                cols += '<td><input type="text"  name="cr[]"  class="form-control" id="cr" placeholder="Cr."></td>';
                cols += '<td>' +
                    '<a href="javascript:void(0)" class="ibtnDel btn btn-danger btn-sm mt-2 text-lg "><i class="fa fa-times-circle"></i></a></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);

            });
            $("table.order-list").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                count -= 1
            });
            $("#add_voucher_form").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('vouchers.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        swal('success',data.success,'success');
                    },
                    error: function(xhr)
                    {
                        if (xhr.responseJSON.error){
                            swal("Failed", xhr.responseJSON.error, "error").then((value) => {

                            });
                        }else {
                            var error='';
                            $.each(xhr.responseJSON.errors, function (key, item) {
                                error+=item;
                            });
                            swal("Failed", error, "error");
                        }
                    }
                });
            }));

            $(document).on('change', '.item_category', function(){
                var category_id = $(this).val();
                var sub_category_id = $(this).data('sub_category_id');
                $.ajax({
                    url: '/acc_level_four/my-cc/'+category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        $('#item_sub_category'+sub_category_id).empty();
                        var html = '<option value="">Select Cost Center</option>';
                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.id+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#item_sub_category'+sub_category_id).append(html);
                    }
                });
            });
        });
    </script>

@endsection
{{--
@section('content')
    <html>
    <head>
        <title>Add Remove Dynamic Dependent Select Box using Ajax jQuery with PHP</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body>
    <br />
    <div class="container">
        <form method="post" id="insert_form">
            <div class="table-repsonsive">
                <span id="error"></span>
                <table class="table table-bordered" id="item_table">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th><button type="button" name="add" class="btn btn-success btn-xs add"><span class="glyphicon glyphicon-plus"></span></button></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div align="center">
                    <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>
    <script>
        $(document).ready(function(){

            var count = 0;
            $(document).on('click', '.add', function(){
                count++;
                var html = '';
                html += '<tr>';
                html += '<td><select name="item_category[]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option>@php foreach ($accounts as $account){ echo '<option value="'.$account->acc_code.'">'.$account->title.'</option>';}  @endphp</select></td>';
                html += '<td><select name="item_sub_category[]" class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="">Select Sub Category</option></select></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
                $('tbody').append(html);
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });

            $(document).on('change', '.item_category', function(){
                var category_id = $(this).val();
                var sub_category_id = $(this).data('sub_category_id');
                $.ajax({
                    url: '/acc_level_four/my-cc/'+category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {

                        $('#item_sub_category'+sub_category_id).empty();
                        var html = '<option value="">Select Sub Category</option>';

                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.id+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#item_sub_category'+sub_category_id).append(html);
                    }
                });
            });



        });
    </script>
@endsection--}}