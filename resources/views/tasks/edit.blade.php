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
        <div class="col-12">
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <th>Session</th>
                    <td>{{$job->jobs->quotes->name}}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{$job->jobs->quotes->customers->reg_name}}</td>
                </tr>
                <tr>
                    <th>Item Description</th>
                    <td>{{\App\Models\Capabilities::find($job->item->capability)->name}}</td>
                </tr>
                <tr>
                    <th>Parameter</th>
                    <td>{{\App\Models\Parameter::find($job->item->parameter)->name}}</td>
                </tr>
                <tr>
                    <th>Equipment ID</th>
                    <td>{{$job->eq_id}}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{$job->model}}</td>
                </tr>
                <tr>
                    <th>Visual Inspection</th>
                    <td>{{$job->visual_inspection}}</td>
                </tr>
            </table>
        </div>
    </div>



            <div class="col-12 border p-2">
                <div class=" d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="border-bottom"><i class="fa fa-tasks"></i> Assign Task</h3>
                </div>

                <form class="form-horizontal" action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$job->id}}" name="id">
                    @php $today=date('Y-m-d',time()); @endphp
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="start"
                                       min="{{$today}}" value="{{old('start',$job->start    )}}" class="form-control">
                            </div>
                            @if ($errors->has('start'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" name="end"
                                       min="{{$today}}" value="{{old('end',$job->end)}}" class="form-control">
                            </div>
                            @if ($errors->has('end'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user" class="col-sm-2 control-label">Select User</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" id="user" name="user">
                                    <option selected disabled>Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{($job->assign_user==$user->id)?"selected":""}}>{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('user'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assets" class="col-sm-2 control-label">Select Assets</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline" style="width: 100%">
                                <select class="form-control" multiple id="assets" name="assets[]">
                                    <option disabled>Select Assets</option>
                                    @foreach($assets as $asset)
                                        <option value="{{$asset->id}}" {{(in_array($asset->id,$job->assign_assets)?"selected":"")}}>{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('assets'))
                                <span class="text-danger">
                                        <strong>{{ $errors->first('assets') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>



    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script>
        $('#assets').select2({
            placeholder: 'Select an option'
        });


    </script>
@endsection

