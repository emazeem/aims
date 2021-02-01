@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <style>
        p {
            font-size: 15px;
        }
    </style>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");

            ev.target.appendChild(document.getElementById(data));
            console.log(ev.target.id);
            $.ajax({
                "url": '{{route('menus.store_position')}}',
                type: "POST",
                data: {'position': ev.target.id, 'id': data, _token: '{{csrf_token()}}'},
                dataType: "json",

            });
        }

        $(document).ready(function () {
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": "{{route('menus.remove_position')}}",
                    type: "POST",
                    data: {'id': id, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        location.reload();
                    },
                    error: function () {
                    },
                });
            });
        });
    </script>
    <div class="col-12 row">
        <h4 class="border-bottom"><i class="fa fa-sort"></i> Manage & Sort Menus</h4>
        {{--<div class="border p-2 m-2"><i class="fa fa-sort"></i> Range 0-{{count($mens)-1}}</div>
        --}}
    </div>
    <div class="col-12 text-dark">
        <div class="row">
            <div class="col-md-4 col-12 bg-warning">
                <div id="div" ondrop="drop(event)" ondragover="allowDrop(event)">
                    @foreach($mens as $men)
                        @if($men->position==0)
                            <p class="font-weight-bold" id="{{$men->id}}" draggable="true"
                               ondragstart="drag(event)">{{$men->name}}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 col-12 bg-white">
                @for($var=0;$var<=count($mens);$var++)
                    @php $find=\App\Models\Menu::where('position',$var)->where('parent_id',null)->first();
                    @endphp
                    @if($find)
                        @if($find->position!=0)
                            <div class="row">
                                <div class="col-2 border">{{$find->position}}</div>
                                <div class="col-10 border" id="{{$var}}">
                                    <p class="font-weight-bold" id="{{$find->id}}">{{$find->name}}<i
                                                class="delete fa fa-trash pull-right text-danger mt-2"
                                                data-id="{{$find->id}}"></i></p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <div class="col-2 border">{{$var}}</div>
                            <div class="col-10 border" id="{{$var}}" ondrop="drop(event)" ondragover="allowDrop(event)">
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
    <div class="col-12 text-dark mt-5">
        <div class="row">
            <div class="col-md-4 col-12 bg-warning">
                <div id="div" ondrop="drop(event)" ondragover="allowDrop(event)">
                    @foreach($mens as $men)
                        <p class="font-weight-bold text-danger" >{{$men->name}}</p>
                        @foreach($men->parent as $item)
                            @if($item->has_child==1)
                                <p class="font-weight-bold ml-5" id="{{$item->id}}" draggable="true" ondragstart="drag(event)">{{$item->position}} <small><i class="fa fa-arrow-right"></i></small> {{$item->name}}</p>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 col-12 bg-white">
                @for($var=0;$var<=count($mens);$var++)
                    <div class="row" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <div class="col-2 border">{{$var}}</div>
                        <div class="col-10 border" id="{{$var}}" ondrop="drop(event)" ondragover="allowDrop(event)">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

@endsection

