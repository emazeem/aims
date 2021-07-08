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
            <h5 class="mb-3 font-weight-light"><i class="feather icon-plus-circle"></i> Add Employee Leave Application</h5>
            <p class="text-danger ml-md-4"><b>Note :</b> Please apply separate for half leave</p>
        </div>
        <div class="col-12">
            <form id="application-form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-12 mb-1">
                        <label for="employee">Select Employee</label>
                        <input type="hidden" value="{{auth()->user()->id}}" name="employee" id="employee">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" >
                                <option selected disabled="disabled">--Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" disabled {{$employee->id==auth()->user()->id?'selected':''}}>{{$employee->fname}} {{$employee->lname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 mb-1">
                        <label for="from">From</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <input type="date" class="form-control" id="from" placeholder="Enter From Date" name="from" value="{{old('from',date('Y-m-d'))}}" min="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-1">
                        <label for="to">To</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <input type="date" class="form-control" id="to" placeholder="Enter To Date" name="to" value="{{old('to',date('Y-m-d'))}}" min="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-1">
                        <label for="nature_of_leave">Select Nature of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="nature_of_leave" name="nature_of_leave">
                                <option selected disabled="">Select Nature of Leave</option>
                                @foreach($natures->child as $nature)
                                    <option value="{{$nature->slug}}">{{$nature->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-1">
                        <label for="type_of_leave">Select Type of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="type_of_leave" name="type_of_leave">
                                <option selected disabled="">Select Type of Leave</option>
                                <option value="0">Full Day</option>
                                <option value="1">Half Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-1 type_time">
                        <label for="type_time">Select Type Time</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="type_time" name="type_time">
                                <option selected disabled="">Select Type Time</option>
                                <option value="0">Morning</option>
                                <option value="1">Evening</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-1">
                        <label for="reason">Reason of Leave</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <textarea type="text" class="form-control" id="reason" placeholder="Enter Reason of Leave" name="reason">{{old('reason')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-1">
                        <label for="address_contact">Address & Contact</label>
                        <div class="form-check form-check-inline" style="width: 100%">
                            <textarea type="text" class="form-control" id="address_contact" placeholder="Enter Address & Contact" name="address_contact">{{old('address_contact',auth()->user()->phone.' - '.auth()->user()->address)}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <h6 class="font-weight-light"><i class="feather icon-help-circle"></i> Approvals Sections</h6>
                    </div>
                    <div class="col-md-4 col-12 mb-1">
                        <label for="head_id">Department Head</label>
                        <input type="hidden" value="{{auth()->user()->departments->head}}" name="head_id" id="head_id">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" >
                                <option selected disabled="disabled">--Select Department Head</option>
                                <option value="{{auth()->user()->departments->head}}" selected>{{auth()->user()->departments->heads->fname.' '.auth()->user()->departments->heads->lname}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-1">
                        <label for="ceo_id">CEO {{auth()->user()->departments->heads->fname}}</label>
                        <input type="hidden" value="{{auth()->user()->id}}" name="ceo_id" id="ceo_id">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" >
                                <option selected disabled="disabled">--Select CEO</option>
                                <option value="1" selected>{{\App\Models\User::find(1)->fname.' '.\App\Models\User::find(1)->lname}}</option>
                            </select>
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
                            window.location.href="{{url('leave-applications/show')}}/"+data.id;
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

