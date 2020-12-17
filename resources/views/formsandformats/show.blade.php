@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
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
    <div class="d-sm-flex align-items-center justify-content-between mb-4 col-12">
        <h3 class="border-bottom text-dark"><i class="fa fa-tasks"></i> Forms & Formats</h3>

    </div>
    <div class="row pb-3">
        <div class="col-12">
            <table class="table table-hover font-13 table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{$show->id}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{$show->name}}</td>
                </tr>
                <tr>
                    <th>Revision #</th>
                    <td>{{$show->rev_no}}</td>
                </tr>
                <tr>
                    <th>Issue #</th>
                    <td>{{$show->issue_no}}</td>
                </tr>
                <tr>
                    <th>Doc #</th>
                    <td>{{$show->doc_no}}</td>
                </tr>
                <tr>
                    <th>Sop's</th>
                    <td>
                    @foreach(explode(',',$show->sops) as $sop)
                            <span class="badge badge-dark">
                                {{\App\Models\Sops::find($sop)->name}}
                            </span>
                    @endforeach
                    </td>
                </tr>

                <tr>
                    <th>Created on</th>
                    <td>{{date('h:i A  d-M-Y ',strtotime($show->created_at))}}</td>
                </tr>
                <tr>
                    <th>File</th>
                    <td >
                        <div class="col-md-4 col-12 border border-primary p-2">
                            <div class="col-12 p-0 m-0">
                                <b class="text-primary">{{$show->file}}</b>
                                <a href="{{Storage::disk('local')->url('Forms&Formats/'.$show->name.'/'.$show->file)}}" download class="btn border px-2 p-0 m-0 pull-right"><small><i class="fa fa-download"></i></small> </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection