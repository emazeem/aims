@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
        @php Session::forget('success') @endphp
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="border-bottom text-dark">Add Clause</h2>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js" integrity="sha512-bInPHQYV0tIhTh8G1j1RrFU1616Hi7b/zG9WHXEzljqKkbKvRvuimXKtNxJ2KxB6CIlTzbM8DCdkXbXQBCYjXQ==" crossorigin="anonymous"></script>
    <div class="row pb-3">
        <div class="col-12">
            <form class="form-horizontal" action="{{route('clauses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$id}}">
                <div class="form-group mt-md-4 row">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of Clause" autocomplete="off" value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-md-4 row">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description" placeholder="Description of Clause" autocomplete="off">{{old('description')}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <span class="text-danger">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif
                </div>
                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script>
        CKEDITOR.replace('description');
    </script>

@endsection

