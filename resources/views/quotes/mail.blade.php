@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row pb-3">
        <div class="col-12">
            <form class="form-horizontal" id="sendtocustomer" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-md-4 row">

                    @php
                    $to=null;
                        if($session->principal==$session->customers->prin_name_1)
                        $to=$session->customers->prin_email_1;
                    elseif($session->principal==$session->customers->prin_name_2)
                        $to=$session->customers->prin_email_2;
                    else
                        $to=$session->customers->prin_email_3;
                    @endphp
                    <label for="to" class="col-sm-2 control-label">To</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="to" name="to" placeholder="Send mail to" autocomplete="off" value="{{old('to',$to)}}" readonly>
                        @if ($errors->has('to'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('to') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="from" class="col-sm-2 control-label">From</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="from" name="from" placeholder="Send mail from" autocomplete="off" value="{{old('from','info@aimscal.com')}}" readonly>
                        @if ($errors->has('from'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('from') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-md-4 row">
                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" autocomplete="off" value="AIMSQ{{date('y').$session->id}} Quote for Calibration of Test and Measurement Equipment" readonly>
                        @if ($errors->has('subject'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('subject') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="message" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control message" rows="5" id="message" name="message" placeholder="Message" autocomplete="off" >{{old('message')}}
</textarea>
                        @if ($errors->has('message'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('message') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="attachment" class="col-sm-2 control-label">Attach file</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="attachment" id="attachment">
                            <label class="custom-file-label" for="files">Attach file</label>
                        </div>
                        @if ($errors->has('attachment'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('attachment') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Send</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $("#sendtocustomer").on('submit', (function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{route('quotes.sendtocustomer',[$session->id])}}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend : function()
                    {
                        $('#preloader').fadeIn();
                    },
                    success: function (data) {
                        $('#preloader').fadeOut();
                        if (!data.errors) {
                            swal("Success", "Quote sent successfully", "success");

                        }
                    },
                    error: function (data) {
                        swal("Failed",data.error , "error");
                        $('#preloader').fadeOut();

                    }
                });
            }));
        });
    </script>
    <script src="{{url('/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'message' );
        $('#message').val('<p>Dear Sir,</p>\n' +
            '\n' +
            '<p>Thanks for your value able RFQ and interest in our services. Find attached our competitive quotation for your necessary approval / Purchase Order Processing.</p>\n' +
            '\n' +
            '<p>We hope our offer will be in-line with your requirements, would you require further information/clarification, please write back to undersigned.</p>\n' +
            '\n' +
            '<p>Regards,</p>\n' +
            '\n' +
            '<p>&nbsp;</p>\n');
    </script>
@endsection



