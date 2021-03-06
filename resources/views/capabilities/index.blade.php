@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="float-left font-weight-light"><i class="feather icon-list"></i> Capabilities</h3>
            <span class="float-right ">

                @can('capabilities-create')
                    <a class="btn float-right add-capability-modal btn-sm btn-primary mt-2 shadow-sm" href><i class="fa fa-plus"></i> Capabilities</a>

                    <a class="btn float-right btn-sm mt-2 btn-success shadow-sm"
                       href="{{route('capabilities.print')}}"><i class="feather icon-printer"></i> Capabilities</a>

                @endcan

                @can('parameter-index')
                    <a href="{{route('parameters')}}" class="btn mt-2 float-right mx-1 btn-sm btn-success shadow-sm"><i
                                class="fa fa-eye"></i> Parameters</a>
                @endcan
                @can('add-grouped-capabilities')
                        <a class="btn float-left btn-sm btn-primary add-grouped-capability mt-2 shadow-sm"
                           style="display: none" href><i class="feather icon-plus-circle"></i> Grouped Capabilities</a>
                @endcan

            </span>
        </div>
    </div>
    <div class="col-12">
        <table id="example" class="table table-bordered table-hover table-sm display nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>@</th>
                <th>Parameter</th>
                <th>Suggestions</th>
                <th>Range</th>
                <th>Price</th>
                <th>Unit</th>
                <th>Location</th>
                <th>Accredited</th>
                <th>Procedure</th>
                <th>Calculator</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>

                <th>Name</th>
                <th>@</th>
                <th>Parameter</th>
                <th>Suggestions</th>
                <th>Range</th>
                <th>Price</th>
                <th>Unit</th>
                <th>Location</th>
                <th>Accredited</th>
                <th>Procedure</th>
                <th>Calculator</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <script>

        function InitTable() {
            $('#example').DataTable({
                responsive: true,
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
                "Paginate": true,

                "order": [[0, 'asc']],
                "pageLength": 100,
                "ajax": {
                    "url": "{{ route('capabilities.fetch') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "name"},
                    {"data": "@", orderable: false, searchable: false},
                    {"data": "parameter"},
                    {"data": "suggestions"},
                    {"data": "range"},
                    {"data": "price"},
                    {"data": "unit"},
                    {"data": "location"},
                    {"data": "accredited"},
                    {"data": "procedure"},
                    {"data": "calculator"},
                    {"data": "options", "orderable": false},
                ]

            });

        }
        $(document).ready(function () {
            $('.opt-assets-select-2').select2();

            $(".opt-assets-select-2").on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
            InitTable();
            $(document).on('click', '.delete', function (e) {
                swal({
                    title: "Are you sure to delete this capability?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('data-id');
                        var token = '{{csrf_token()}}';
                        e.preventDefault();
                        var request_method = $("#form" + id).attr("method");
                        var form_data = $("#form" + id).serialize();

                        $.ajax({
                            url: "{{route('capabilities.delete')}}",
                            type: request_method,
                            dataType: "JSON",
                            data: form_data,
                            statusCode: {
                                403: function () {
                                    swal("Failed", "Permission denied.", "error");
                                    return false;
                                }
                            },
                            success: function (data) {
                                swal('success', data.success, 'success').then((value) => {
                                    $("#example").DataTable().ajax.reload(null, false);
                                });

                            },
                            error: function (data) {
                                swal("Failed", data.error, "error");
                            },
                        });
                    }
                });
            });

            $(document).on('click', '.actions', function (e) {
                var val = [];
                $('.actions:checked').each(function (i) {
                    val[i] = $(this).attr('data-id');
                });
                console.log(val.length);
                if (val.length == 0) {
                    $('.add-grouped-capability').css('display', 'none');
                } else {
                    $('.add-grouped-capability').css('display', 'block');
                }
            });
            $(document).on('click', '.add-grouped-capability', function (e) {
                e.preventDefault();
                var val = [];
                $('.actions:checked').each(function (i) {
                    val[i] = $(this).attr('data-id');
                });
                window.location.href = '{{url('grouped-capabilities/create')}}/' + val;
            });
            $(document).on('click','.add_suggestion_btn',function () {
                //data-parameter
                var parameter = $(this).attr('data-parameter');

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-capability-name');
                $('#suggestion_capability').val(id);
                $('#suggestion_parameter').val(parameter);
                $('#suggestion_capability_value').val(name);

                if (parameter) {
                    $.ajax({
                        url: '{{url('capabilities/respective-assets')}}/' + parameter,
                        type: "GET",
                        dataType: "json",
                        beforeSend : function()
                        {
                            $(".loader-gif").fadeIn();
                        },
                        success: function (data) {
                            $(".loader-gif").fadeOut();
                            setTimeout(function() {
                                $('#add_suggestion').modal('show');
                            }, 1000);
                            $('#suggestion_assets').empty();
                            $.each(data, function (index, value) {
                                $('#suggestion_assets').append('<option value="' + value.id + '">' + value.code + '-' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $(".loader-gif").fadeOut();
                    $('#suggestion_assets').empty();
                }

            });
        });
    </script>
    @include('capabilities.create')
    @include('capabilities.edit')
    @include('suggestions.index')
@endsection


