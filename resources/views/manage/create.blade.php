
    <div class="col-12">
        <div class="row">
            <h4 class="float-left font-weight-light"><i class="feather icon-plus-circle"></i> Select Items to Create Job</h4>

        </div>
        <form method="post" action="{{route('jobs.manage.store')}}">
            @csrf
            <input type="hidden" value="{{$id}}" id="quote_id" name="id">
            <table class="table table-hover bg-white table-bordered table-sm mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Capability</th>
                    <th>Parameter</th>
                    <th>Qty</th>
                    <th>Range</th>
                    <th>Location</th>
                    <th>Accredited</th>
                </tr>
                </thead>
                <tbody class="text-capitalize">
                @foreach($items as $item)
                    @if($item->status!=3)
                        <tr>
                            <td>

                                @if(!in_array($item->id,$assigned_items))
                                    <div class="form-group">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox" name="items[]" value="{{$item->id}}" id="{{$item->id}}">
                                            <label class="cr" for="{{$item->id}}"></label>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox"  name="items[]" value="{{$item->id}}" id="{{$item->id}}" disabled checked>
                                            <label class="cr" for="{{$item->id}}"></label>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if(!in_array($item->id,$assigned_items))
                                    <label class="form-check-label" for="{{$item->id}}">{{$item->capabilities->name}}</label>
                                @else
                                    <label class="form-check-label" for="{{$item->id}}">{{$item->capabilities->name}}</label>
                                @endif
                            </td>
                            <td>{{$item->parameters->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->range}}</td>
                            <td>{{$item->location}}</td>

                            <td>{{$item->accredited}}</td>
                        </tr>

                    @endif
                @endforeach

                @if ($errors->has('items'))
                    <script>
                        $(document).ready(function () {
                            swal("Failed", "{{$errors->first('items') }}", "error");
                        });
                    </script>
                @endif
                </tbody>
            </table>
            <button class="btn btn-primary pull-right btn-sm" type="submit"> <i class="fa fa-plus-square"></i> Add</button>
        </form>
    </div>





