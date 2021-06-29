@extends('layouts.master')
@section('content')
    <script src="{{url('assets/js/1.10.1/jquery.min.js')}}"></script>

    <style>
        .causer-profile{
            object-fit: cover;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Activity Feed</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="feed-blog pl-0">


                    </ul>
                    <div class="col-12 text-center">
                        <div class="mx-auto">
                            <img src="{{url('assets/images/lazy-loader.gif')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>


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
                url: "{{route('activitylog.fetch')}}",
                data: {'page': 1, _token: '{{csrf_token()}}'},
                dataType: "json",
                type: "POST",
                beforeSend:function (data) {

                },
                success:function (data) {

                    $.each(data, function(key, value) {
                        var new_values='';
                        $.each(value['new'],function (i,v) {
                            new_values=new_values+'<p class="text-muted m-b-0"><small>'+i+'<i class="feather icon-chevron-right text-danger"></i> '+v+'</small></p>';
                        });
                        var old_values='';
                        $.each(value['old'],function (i,v) {
                            old_values=old_values+'<p class="text-muted m-b-0"><small>'+i+' <i class="feather icon-chevron-right text-danger"></i> '+v+'</small></p>';
                        });

                        $('.feed-blog').append(

                            '<li class="active-feed">'+
                            '<div class="feed-user-img">'+
                            '<img src="'+value.profile_path+'" class="img-radius causer-profile" alt="User-Profile-Image">'+
                            '</div>'+
                            '<h6><span class="badge badge-danger">'+value.description+'</span> '+value.subject_type+'( '+value.subject_id+' ) <small class="text-muted">'+value.created+'</small></h6>'+
                            '<p class="m-t-15">'+
                            '<b>By '+value.causer_id+'</b><br>'+
                            '</p>'+
                            '<div class="row">'+
                            '<div class="col-auto">'+
                            '<h6 class="m-t-15 m-b-0">Old Data</h6>'+old_values+
                            '</div>'+
                            '<div class="col-auto">'+
                            '<h6 class="m-t-15 m-b-0">New Data</h6>'+new_values+
                            '</div>'+
                            '</div>'+
                            '</li>'
                        );
                    });
                }
            });

        }
    </script>
@endsection