@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
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
    <div class="row">
        <div class="col-12">
            <h3 class="border-bottom pull-left"><i class="fa fa-list"></i> Level Two</h3>
            <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code2</th>
                    <th>Code1</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Code2</th>
                    <th>Code1</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <script>

        function InitTable() {
            $(".loading").fadeIn();

            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{route('acc_level_two.fetch')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "code2"},
                    {"data": "code1"},
                    {"data": "title"},
                    {"data": "options", "orderable": false},
                ]
            });
        }

        $(document).ready(function () {
            InitTable();
        });
    </script>
    <div class="row mt-4">
        <div class="col-12">

            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#approval_card" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Add Level 2</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="approval_card">
                    <div class="card-body">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('acc_level_two.store')}}" method="post">
                                @csrf

                                <div class="form-group mt-md-4 row">

                                    <label for="level1" class="col-sm-2 control-label">level1</label>
                                    <div class="col-sm-10">
                                        <select class="form-control text-xs" id="level1" name="level1">
                                            <option value="" selected disabled>Select Level 1</option>
                                            @foreach($ones as $one)
                                                <option value="{{$one->id}}">{{$one->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('level1'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('level1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Title" autocomplete="off" value="{{old('title')}}">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <div class="py-2">
                                            <span id="previous"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection