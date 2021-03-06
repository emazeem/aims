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
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light mb-3"><i class="feather icon-plus-circle"></i> Add Journal Voucher</h3>
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
                            <option value="journal" selected>Journal Voucher</option>
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
                    <label for="reference" class="col-2 control-label">Reference</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="reference" name="reference" value="{{old('reference')}}" placeholder="Enter Reference">
                        @if ($errors->has('reference'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('reference') }}</strong>
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

                <table id="myTable" class="table order-list table-bordered bg-white table-hover">
                    <thead>
                    <tr>
                        <td style="width: 20%;">Categories</td>
                        <td style="width: 20%;">Account</td>
                        <td style="width: 10%;">Cost Center</td>
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
            $("#addrow").on("click", function (){
                count++;
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><select name="tlevel[]"  class="form-control tlevel" id="tlevel'+count+'" data-tlevel="'+count+'"><option value="" selected>Select Account</option>@php foreach ($accounts as $account){ echo '<option value="'.$account->id.'">'.$account->title.'</option>';}  @endphp</td>';
                cols += '<td><select name="account[]"  class="form-control account" id="account_id'+count+'" data-account_id="'+count+'"><option value="" selected>Select Account</option>';
                cols += '<td><select name="costcenter[]"  class="form-control costcenter_id" id="costcenter_id'+count+'"><option value="" selected>Select Cost Center</option></select></td>';
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
                    url: "{{route('journal.vouchers.store')}}",
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

            $(document).on('change', '.tlevel', function(){
                var tlevel = $(this).val();
                var step_id = $(this).data('tlevel');
                $.ajax({
                    url: '/chartofaccount/my-coa/'+tlevel,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        $('#account_id'+step_id).empty();
                        var html = '<option value="">Select Account</option>';
                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.acc_code+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#account_id'+step_id).append(html);
                    }
                });
            });
            $(document).on('change', '.account', function(){
                var account = $(this).val();
                var account_id = $(this).data('account_id');
                $.ajax({
                    url: '/chartofaccount/my-cc/'+account,
                    type: "GET",
                    dataType: "json",
                    success:function(data)
                    {
                        $('#costcenter_id'+account_id).empty();
                        var html = '<option value="">Select Cost Center</option>';
                        $.each(data, function(key, value) {
                            var dat="<option value='"+value.id+"'>"+ value.title +"</option>";
                            html=html+dat ;
                        });
                        console.log(html);
                        $('#costcenter_id'+account_id).append(html);
                    }
                });
            });

        });
    </script>

@endsection