@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Activity Log <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
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
                                    <small >{{$activity['created_at']->diffForHumans()}} by{{\App\Models\User::find($activity->causer_id)->fname.' '.\App\Models\User::find($activity->causer_id)->lname}}</small>
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
            </div>
        </div>
    </div>
@endsection