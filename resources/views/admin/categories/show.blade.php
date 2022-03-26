@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Category</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="category">Category :</label>
                <label>{{ $category->category }}</label>
            </div>

            <div class="form-group text-right">
                <a href="{{ url('admin/categories') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection