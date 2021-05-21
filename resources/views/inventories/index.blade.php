@extends('layouts.master')
@section('content')
    @if(session('success'))
        <script>
            $(document).ready(function () {
                swal("Success", "{{session('success')}}", "success");
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
    <!-- Table start -->
    <script>
        $(document).ready(function () {
            $('select[name="category"]').on('change', function () {
                var cat = $(this).val();
                if (cat) {
                    $.ajax({
                        url: '/inventories/get-sub-categories/' + cat,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subcategory"]').empty();
                            $('select[name="subcategory"]').append('<option disabled selected>Select Subcategory</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subcategory"]').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="subcategory"]').empty();
                }
            });
        });
    </script>
    <div class="col-12">
        <div class="col-12">
            <h3 class="pull-left pb-1"><i class="fa fa-list"></i> Inventories</h3>
            <button type="button" class="btn btn-sm btn-primary shadow-sm pull-right mt-2" data-toggle="modal"
                    data-target="#inventory_categories"><i class="fa fa-plus-circle"></i> Inventories
            </button>
        </div>
        <table id="example" class="table table-bordered table-hover display nowrap" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subcategory</th>
                <th>Category</th>
                <th>Model</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Subcategory</th>
                <th>Category</th>
                <th>Model</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <!-- Table end -->

    <!--Modal -->
    <div class="modal fade" id="inventory_categories" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus-circle"></i> Add Inventory
                    </h5>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('inventory.store')}}" class="form" id="add_form" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                   autocomplete="off" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select type="text" name="category" id="category" class="form-control" required="required">
                                <option disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_subcategory">Subcategory</label>
                            <select type="text" name="subcategory" id="edit_subcategory" class="form-control"
                                    required="required">
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Model"
                                   autocomplete="off" value="{{ old('model') }}">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity"
                                   autocomplete="off" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label>Annual Depreciation</label>
                            <input type="text" class="form-control" id="depreciation" name="depreciation"
                                   placeholder="Depreciation %" autocomplete="off" value="{{ old('depreciation') }}">
                        </div>
                        <div class="form-group">
                            <label for="depreciation_duration">Depreciation Duration</label>
                            <select type="text" name="depreciation_duration" id="depreciation_duration"
                                    class="form-control"
                                    required="required">
                                @for($i=1;$i<=10;$i++)
                                    <option value="{{$i}}">{{$i}} Year{{$i>1?'s':''}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price"
                                   autocomplete="off" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                      placeholder="Description" autocomplete="off"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="department">Departments</label>
                            <select type="text" name="department" id="department" class="form-control"
                                    required="required">
                                <option disabled selected>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select type="text" name="type" id="type" class="form-control" required="required">
                                <option value="fixed-asset">Fixed Assets</option>
                                <option value="consumable-inventory">Consumable Inventory</option>
                                <option value="trading-inventory">Trading Inventory</option>
                            </select>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function InitTable() {
            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,
                "order": [[0, 'asc']],
                "pageLength": 25,
                "ajax": {
                    "url": "{{ route('inventory.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "subcategory"},
                    {"data": "category"},
                    {"data": "model"},
                    {"data": "price"},
                    {"data": "options", "orderable": false},
                ]

            });
        }

        $(document).ready(function () {
            InitTable();
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{route('inventory.category.edit')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        $('#inventory_categories').modal('toggle');
                        $('#edit_id').val(data.id);
                        $('#edit_category_name').val(data.category_name);
                        $('#edit_status').val(data.status);

                    }
                });
            });
        });
    </script>
@endsection