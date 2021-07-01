@extends('layouts.master')
@section('content')

    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                swal("Done!",'{{Session('success')}}', "success");
            });
        </script>
    @endif


    <div class="row pb-3">
        <div class="col-12">
            <h3 class="font-weight-light pb-1"><i class="feather icon-plus-circle"></i> Add Personnel</h3>
        </div>
        <div class="col-12">

            <form class="form-horizontal" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-md-4 row">

                    <label for="fname" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{old('fname')}}">
                        @if ($errors->has('fname'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('fname') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="lname" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off" value="{{old('lname')}}">
                        @if ($errors->has('lname'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('lname') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="fathername" class="col-sm-2 control-label">Father Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fathername" name="fathername" placeholder="Father Name" value="{{old('fathername')}}">
                        @if ($errors->has('fathername'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('fathername') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="new-password" value="{{old('email')}}">
                        @if ($errors->has('email'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete = "new-password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  name="cnic" value="{{old('cnic')}}">
                        @if ($errors->has('cnic'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('cnic') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="phone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off" value="{{old('phone')}}">
                        @if ($errors->has('phone'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" autocomplete="off" value="{{old('dob')}}">
                        @if ($errors->has('dob'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('dob') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <label for="joining" class="col-sm-2 control-label">Joining Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="joining" name="joining" placeholder="Joining Date" autocomplete="off" value="{{old('joining')}}">
                        @if ($errors->has('joining'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('joining') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="department" name="department">
                                <option selected disabled="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{ (collect(old('department'))->contains($department->id)) ? 'selected':'' }} >{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('department'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('department') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-sm-2 control-label">Designation</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="designation" name="designation">
                                <option selected disabled="">Select Designation</option>
                            </select>
                        </div>
                        @if ($errors->has('designation'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('designation') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline" style="width: 100%">
                            <select class="form-control" id="roles" name="roles">
                                <option selected disabled="">Select Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{ (collect(old('roles'))->contains($role->id)) ? 'selected':'' }}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('roles'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('roles') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" rows="5" id="address" name="address" placeholder="Address" autocomplete="off" >{{old('address')}}</textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cv" class="col-sm-2 control-label">Upload CV</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cv" id="cv">
                            <label class="custom-file-label" for="cv">Choose CV</label>
                        </div>
                        @if ($errors->has('cv'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('cv') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="signature" class="col-sm-2 control-label">Signature</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="signature" id="signature">
                            <label class="custom-file-label" for="cv">Choose Signature</label>
                        </div>
                        @if ($errors->has('signature'))
                            <span class="text-danger">
                          <strong>{{ $errors->first('signature') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

                <div class="input-group mb-3">

                </div>
                <!-- /.box-body -->
                <div class="box-footer mt-3">
                    <a href="{{ URL::previous() }}" class="btn bg-white border"><i class="feather icon-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary float-right"><i class="feather icon-save"> </i>Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script>
        $(":input").inputmask();

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();
                if(department) {
                    $.ajax({
                        url: '/users/fetch/designation/'+department,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="designation"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="designation"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="designation"]').empty();
                }
            });
        });
    </script>
@endsection

