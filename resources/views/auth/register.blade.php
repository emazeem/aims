@if(Auth::user())
    {{ '' }}
@else
    <script>window.location = "/login";</script>
@endif