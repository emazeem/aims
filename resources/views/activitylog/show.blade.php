@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <style>
        .loader {
            border: 10px solid #d8f5f7; /* Light grey */
            border-top: 10px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 90px;
            height: 90px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <div class="row">
        <div class="col-12">
            <ul class="list-unstyled timeline">
                @foreach($activities as $activity)
                    <li>
                        <div class="block">
                            <div class="tags">
                                <a href="" class="tag">
                                    <span class="text-capitalize">{{$activity->description}}</span>
                                </a>
                            </div>
                            <div class="block_content">
                                <h2 class="title text-primary">
                                    <a class="h6">{{$activity->subject_type}}</a>
                                </h2>
                                <div class="byline text-danger">
                                    <small >{{$activity['created_at']->diffForHumans()}} by {{\App\Models\User::find($activity->causer_id)->fname.' '.\App\Models\User::find($activity->causer_id)->lname}}</small>
                                </div>
                                <div class="excerpt">

                                    <div class="col-12 p-0 text-info">Subject ⟹ {{$activity->subject_id}}</div>
                                    <div class="col-12 p-0 small">New Values</div>
                                    @php $properties=json_decode($activity->properties,true); @endphp
                                    @foreach($properties['attributes'] as $k=>$property)
                                        <div class="col-12 p-0 ml-4">
                                            ↳ <span class="bg-danger text-light px-2">{{$k}}</span> ⟹ <b class="text-danger">{{$property}}</b>
                                        </div>
                                    @endforeach
                                    @if(isset($properties['old']))
                                        <div class="col-12 p-0 small">Old Values</div>
                                        @foreach($properties['old'] as $k=>$property)
                                            <div class="col-12 p-0 ml-4">
                                                ↳ <span class="bg-danger text-light px-2">{{$k}}</span> ⟹ <span class="text-danger">{{$property}}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
            <div class="col-12 ">
                <div class="mx-auto loader"></div>
            </div>
        </div>
    </div>

    {{--<script>


        $(document).ready(function () {
            var page = 1;
            infinteLoadMore(page);
            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() > $(document).height() - 5) {
                    page++;
                    infinteLoadMore(page);
                }
            });
        });
        function infinteLoadMore(page) {

            $.ajax({
                url: "{{route('activitylog.show.fetch')}}",
                data: {'page': 1, _token: '{{csrf_token()}}'},
                dataType: "json",
                type: "POST",
                beforeSend:function (data) {

                },
                success:function (data) {

                    $.each(data, function(key, value) {
                        $('.list-unstyled').append(
                            "<li>" +
                            "<div class='block'> " +
                            "<div class='tags'> " +
                            "<a href class='tag'> " +
                            "<span class='text-capitalize'>"+value.description+" </span>" +
                            "</a> " +
                            "</div> " +
                            "<div class='block_content'> " +
                            "<h2 class='title text-primary'> " +
                            "<a class='h6'> </a> " +
                            "</h2> " +
                            "<div class='byline text-danger'> " +
                            "<small > "+value.created_at+" by "+value.causer_id+" </small>" +
                            "</div>" +
                            "<div class='excerpt'>" +
                            "<div class='col-12 p-0 text-info'>Subject ⟹ </div> " +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</li>"
                        );
                    });
                }
            });

        }
    </script>
    --}}
@endsection