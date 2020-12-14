@extends('layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h2 class="border-bottom text-dark">Dashboard</h2>
</div>

<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a style="text-decoration:none" href="{{url('customers')}}">Customers</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a style="text-decoration:none" href="{{url('parameters')}}"><span class="text-success">Parameters</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$parameters}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a style="text-decoration:none" href="{{url('capabilities')}}"><span class="text-info">Capabilities</span></a></div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$capabilities}}</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-info"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a style="text-decoration:none" href="{{url('assets')}}"><span class="text-warning">Assets</span></a></div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$assets}}</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="{{url('quotes')}}"><span class="text-danger">Quotes</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$quotes}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a style="text-decoration:none" href="{{url('jobs')}}"><span class="text-primary">Jobs</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jobs}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-friends fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a style="text-decoration:none" href="{{url('users')}}"><span class="text-success">Staff</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$personnels}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="{{url('mytasks')}}"><span class="text-dark">My Tasks</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-dark"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1"><a style="text-decoration:none" href="{{url('departments')}}"><span class="text-primary">Department</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$departments}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a style="text-decoration:none" href="{{url('designations')}}"><span class="text-dark">Designation</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$designations}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-dark"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a style="text-decoration:none" href="{{url('expenses_categories')}}"><span class="text-danger">Expense Categories</span></a></div>
            <div class="h5 mb-0 font-weight-bold text-danger">{{$expense_categories}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a style="text-decoration:none" href="{{url('expenses')}}"><span class="text-success">Expenses </span></a></div>
            <div class="h5 mb-0 font-weight-bold text-success">{{$expenses}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-success"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  <div class="container">
    <div class="response alert alert-success mt-2" style="display: none;"></div>
    <div id='calendar'></div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#calendar').fullCalendar({
            editable: true,
            events: '{{route('calendar')}}',
            displayEventTime: true,
            //editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            }
        });
    });

        function displayMessage(message) {
        $(".response").css('display','block');
        $(".response").html(""+message+"");
        setInterval(function() { $(".response").fadeOut(); }, 4000);
    }
</script>--}}
@endsection
