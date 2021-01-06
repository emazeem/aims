@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('message')}}', "success");
            });
        </script>
    @endif
    <div class="card">
        <div class="card-body">
            <h3 class="border-bottom pull-left"><i class="fa fa-eye"></i> Manage Reference Errors & Uncertainty</h3>
            <table class="table table-bordered table-sm table-hover">
                <tr>
                    <th>Parameter</th>
                    <td>{{$show->parameters->name}}</td>
                </tr>
                <tr>
                    <th>Assets</th>
                    <td>{{$show->assets->name}}</td>
                </tr>
            </table>
            @foreach($units as $unit)
                <h5 class="float-left text-danger">{{\App\Models\Unit::find($unit)->unit}}</h5>
            <table class="table table-bordered table-hover table-sm">
                <tr class="bg-light">
                    <th>UUC</th>
                    <th>Ref</th>
                    <th>Error</th>
                    <th>Uncertainty</th>
                </tr>
                @foreach($multiples as $key=>$multiple)
                    @if($multiple->unit==$unit)
                    <tr>
                        <td>{{($multiple->channel)?$multiple->channel.' #  ':''}}  {{$multiple->uuc}} </td>
                        <td>{{$multiple->ref}}</td>
                        <td>{{$multiple->error}}</td>
                        <td>{{$multiple->uncertainty}}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
            @endforeach
        </div>
    </div>
@endsection