@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif

    <div class="box box-info">
        <h2 class="border-bottom mb-5"><i class="fa fa-pencil"></i> Edit Preventive Maintenance Record</h2>
        <form class="form-horizontal" action="{{route('preventive.maintenance.update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$edit->id}}">
            <table class="table table-bordered table-sm table-striped col-sm-12">
                <?php $all=[];?>
            @foreach($checklists as $checklist)
                    <tr>
                        <td class="text-center">
                            <div class="checkbox mt-2">
                                <input type="checkbox" id="{{$checklist->id}}" value="{{$checklist->id}}" name="checklists[]" {{(in_array($checklist->id,explode(',',$edit->checked)))?'checked':''}}>
                            </div>
                        </td>
                        <td>
                            <label for="{{$checklist->id}}">
                                <span class="text-lg">{{$checklist->tasktodo}}</span>
                            </label>
                        </td>
                    </tr>
                    <?php $all[]=$checklist->id;?>
                @endforeach
            </table>
            @if ($errors->has('checklists'))
                <span class="text-danger">
                          <strong>{{ $errors->first('checklists') }}</strong>
                      </span>
            @endif
            <input type="hidden" name="all" value="{{implode(',',$all)}}">
            <div class="form-group row mt-5">
                <label for="breakdowndescription" class="col-sm-2 control-label">Breakdown Description</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" rows="3" id="" name="breakdowndescription" placeholder="Breakdown Description" autocomplete="off" >{{old('breakdowndescription',$edit->breakdown_description)}}</textarea>
                    @if ($errors->has('breakdowndescription'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('breakdowndescription') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="correctivemaintenance" class="col-sm-2 control-label">Corrective Maintenance</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" rows="3" id="" name="correctivemaintenance" placeholder="Corrective Maintenance" autocomplete="off" >{{old('correctivemaintenance',$edit->corrective_description)}}</textarea>
                    @if ($errors->has('correctivemaintenance'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('correctivemaintenance') }}</strong>
                      </span>
                    @endif
                </div>
            </div>


            <!-- /.box-body -->
            <div class="box-footer col-12 text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

@endsection