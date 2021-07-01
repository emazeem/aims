@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light"><i class="feather icon-plus-circle"></i> Add Employee Leave Application</h3>
        </div>
        <div class="col-md-8 col-12">
            <form id="application-form" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="employee">Select Employee</label>
                        <input type="hidden" value="{{auth()->user()->id}}" name="employee" id="employee">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" >
                                <option selected disabled="disabled">--Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" disabled {{$employee->id==auth()->user()->id?'selected':''}}>{{$employee->fname}} {{$employee->lname}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('employee'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('employee') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="from">From</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <input type="date" class="form-control" id="from" placeholder="Enter From Date" name="from" value="{{old('from',date('Y-m-d'))}}">
                             @if ($errors->has('from'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('from') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="to">To</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <input type="date" class="form-control" id="to" placeholder="Enter To Date" name="to" value="{{old('to',date('Y-m-d'))}}">
                             @if ($errors->has('to'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('to') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="nature_of_leave">Select Nature of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="nature_of_leave" name="nature_of_leave">
                                <option selected disabled="">Select Nature of Leave</option>
                                @foreach($natures->child as $nature)
                                    <option value="{{$nature->slug}}">{{$nature->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('nature_of_leave'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('nature_of_leave') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="type_of_leave">Select Type of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="type_of_leave" name="type_of_leave">
                                <option selected disabled="">Select Type of Leave</option>
                                <option value="0">Full Day</option>
                                <option value="1">Half Day</option>
                            </select>
                            @if ($errors->has('type_of_leave'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('type_of_leave') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1 type_time">
                        <label for="type_time">Select Type Time</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="type_time" name="type_time">
                                <option selected disabled="">Select Type Time</option>
                                <option value="0">Morning</option>
                                <option value="1">Evening</option>
                            </select>
                            @if ($errors->has('type_time'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('type_time') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="reason">Reason of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <textarea type="text" class="form-control" id="reason" placeholder="Enter Reason of Leave" name="reason">{{old('reason')}}</textarea>
                             @if ($errors->has('reason'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('reason') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="address_contact">Address & Contact</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <textarea type="text" class="form-control" id="address_contact" placeholder="Enter Address & Contact" name="address_contact">{{old('address_contact',auth()->user()->phone.' - '.auth()->user()->address)}}</textarea>
                             @if ($errors->has('address_contact'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('address_contact') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="text-right my-3">
                    <button class="btn btn-primary save-application-btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.type_time').hide();
            $('#type_of_leave').on('change', function() {
                if (this.value==1){
                    $('.type_time').show();
                }else {
                    $('.type_time').hide();
                }
            });

            $("#application-form").on('submit',(function(e) {
                var button=$('.save-application-btn');
                var previous=$('.save-application-btn').html();
                button.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                e.preventDefault();
                $.ajax({
                    url: "{{route('leave_application.store')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled',null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            window.location.href="{{url('my-leave-applications/show')}}/"+data.id;
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
@endsection

