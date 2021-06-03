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
            <h3 class="border-bottom pull-left">
                <i class="fa fa-tasks"></i>
                Review Items
            </h3>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Checks</th>
                    <th>Reason</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                @foreach($quote->items as $item)
                    @if($item->status==1)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>RFQ/{{$item->quote_id}}</td>
                            <td>{{$item->quotes->customers->reg_name}}</td>
                            <td>{{$item->not_available}}</td>
                            <td>
                                @if($item->rf_checks==null)
                                    <i class="badge">No action applied</i>
                                    @else
                                    @php $checks = explode(',',$item->rf_checks); @endphp
                                    Reference Std {!! ($checks[0]==1)?'✓':'✗' !!}<br>
                                    Cal Procedure {!! ($checks[1]==1)?'✓':'✗' !!}<br>
                                    Cal Schedule {!! ($checks[2]==1)?'✓':'✗' !!}<br>
                                    Sub Contractor {!! ($checks[3]==1)?'✓':'✗' !!}
                                @endif

                            </td>
                            <td>{{$item->rf_reason}}</td>
                            <td>{{date('d-M Y',strtotime($item->created_at))}}</td>
                            <td>

                                <?php
                                $token=csrf_token();
                                $option=null;
                                $option .= "<a title='Add Checks for Review Form' class='btn btn-sm btn-success checks'  href='#' data-id=".$item->id."><span class='badge'> <i class='fa fa-plus-circle'></i> Checks</span></a>";
                                if ($item->rf_checks=='1,1,1'){
                                    $option .= "<a title='Add' class='btn btn-sm btn-primary' href='" . url('pendings/create/' . $item->id) . "'><i class='fa fa-plus'></i></a>";
                                }
                                elseif($item->rf_checks!=null){
                                    $option.="<a class='btn btn-danger btn-sm nofacility' href='#' data-id='$item->id' title='No facility'><i class='fa fa-ban'></i></a>
                                <form id=\"form$item->id\" method='post' role='form'>
                                    <input name=\"_token\" type=\"hidden\" value=\"$token\">
                                    <input name=\"id\" type=\"hidden\" value=\"$item->id\">
                                    <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                                </form>";
                                }
                                elseif($item->rf_checks==null){

                                }
                                else{

                                }

                                ?>
                                {!! $option !!}
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Customer</th>
                    <th>Not Available</th>
                    <th>Checks</th>
                    <th>Reason</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.nofacility', function(e)
            {
                swal({
                    title: "Are you sure that you have no facility of this quote?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var id = $(this).attr('data-id');
                            var token= '{{csrf_token()}}';
                            e.preventDefault();
                            var request_method = $("#form"+id).attr("method");
                            var form_data = $("#form"+id).serialize();

                            $.ajax({
                                url: "{{url('items/nofacility')}}/"+id,
                                type: request_method,
                                dataType: "JSON",
                                data: form_data,
                                statusCode: {
                                    403: function() {
                                        swal("Failed", "Permission denied." , "error");
                                        return false;
                                    }
                                },
                                success: function(data)
                                {
                                    swal('success',data.success,'success').then((value) => {
                                        location.reload();
                                    });
                                },
                                error: function(){
                                    swal("Failed", "Try again later." , "error");
                                },
                            });

                        }
                    });

            });
            $(document).on('click', '.checks', function() {
                var id = $(this).attr('data-id');
                $('#id').val(id);
                $('#add_checks').modal('toggle');
            });
            $("#add_checks_form").on('submit',(function(e) {
                e.preventDefault();
                var self=$(this), button=self.find('input[type="submit"],button');
                var previous=$(button).html();
                button.attr('disabled','disabled').html('Loading <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $.ajax({
                    url: "{{route('pendings.checks')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    statusCode: {
                        403: function() {
                            $(".loading").fadeOut();
                            swal("Failed", "Access Denied" , "error");
                            return false;
                        }
                    },
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        $('#add_checks').modal('hide');
                        swal('success',data.success,'success').then((value) => {
                            location.reload();
                        });

                    },
                    error: function(xhr)
                    {
                        button.attr('disabled',null).html(previous);
                        var error='';
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            error+=item;
                        });
                        swal("Failed", error, "error");
                    }
                });
            }));
        });
    </script>
    <div class="modal fade" id="add_checks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Checks of items for Review Form</h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_checks_form">
                        @csrf
                        <input type="hidden" value="" name="id" id="id">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="ref_std" name="ref_std">
                                    <label class="form-check-label" for="ref_std">Reference Std</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cal_procedure" name="cal_procedure">
                                    <label class="form-check-label" for="cal_procedure">Cal Procedure</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cal_schedule" name="cal_schedule">
                                    <label class="form-check-label" for="cal_schedule">Cal Schedule</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sub_contractor" name="sub_contractor">
                                    <label class="form-check-label" for="sub_contractor">Sub Contractor</label>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="rf_reason" class="control-label"></label>
                                <textarea type="text" class="form-control" rows="2" id="rf_reason" name="rf_reason"
                                          placeholder="Reason" autocomplete="off">{{old('rf_reason')}}</textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

