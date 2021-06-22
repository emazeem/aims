@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <script>
        'use strict';
        $(document).ready(function () {

            $('.select-2-assets-site').select2();
            $('.select-2-users-site').select2();

            $(document).on('click', '.assign-site', function() {
                var id = $(this).attr('data-id');
                $('#assign_site_job').modal('toggle');
                $('#job_id').val(id);
            });

            $("#assign_site_job_form").on('submit',(function(e) {

                var button = $('.site-assign-btn');
                var previous = $('.site-assign-btn').html();
                button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing');

                e.preventDefault();
                $.ajax({
                    url: "{{route('tasks.siteassignjobs')}}",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        button.attr('disabled', null).html(previous);
                        swal('success',data.success,'success').then((value) => {
                            window.location.href='{{URL::previous()}}';
                        });

                    },
                    error: function(xhr, status, error)
                    {
                        button.attr('disabled', null).html(previous);
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

    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="row">
        <h3 class="float-left font-weight-light col-12"><i class="feather icon-eye"></i> Job Detail</h3>
        <div class="col-md-6 col-12 table-responsive">
            <table class="table bg-white table-bordered">
                <tr>
                    <th>Job #</th>
                    <th>Name</th>
                    <th>Parameter</th>
                    <th>Quantity</th>
                </tr>

                @foreach($items as $item)

                    <tr>
                        <td>{{\App\Models\Job::find($id)->cid}}</td>
                        <td>{{$item->capabilities->name}}</td>
                        <td>{{$item->parameters->name}}</td>
                        <td>{{$item->quantity}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div class="col-md-6 col-12">
            <form class="form-horizontal " id="assign_site_job_form" method="post">
                @csrf
                <input type="hidden" value="{{$id}}" name="id" id="job_id">
                @foreach($items as $item)
                    <input type="hidden" value="{{$item->id}}" name="items[]">
                @endforeach
                @php $today=date('Y-m-d',time()); @endphp
                <div class="form-group row">
                    <label for="start" class="col-sm-2 control-label">Start Date</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="date" name="start"
                                   min="{{$today}}" value="{{old('start')}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end" class="col-sm-2 control-label">End Date</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="date" name="end"
                                   min="{{$today}}" value="{{old('end')}}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user" class="col-sm-2 control-label">Select User</label>
                    <div class="col-10">
                        <select class="form-control select-2-users-site" id="user" name="user[]" multiple style="width: 100%">
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="assets" class="col-sm-2 control-label">Select Assets</label>
                    <div class="col-10">
                        <select class="form-control select-2-assets-site" multiple id="assets" name="assets[]" style="width: 100%;">
                            <option disabled>Select Assets</option>
                            @foreach(\App\Models\Asset::all() as $asset)
                                <option value="{{$asset->id}}">{{$asset->code}}-{{$asset->name}}-{{$asset->range}}-{{$asset->resolution}}-{{$asset->accuracy}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <button type="submit" class="btn btn-success site-assign-btn float-right"><i class="feather icon-save"></i> Save</button>
            </form>

        </div>
    </div>
@endsection