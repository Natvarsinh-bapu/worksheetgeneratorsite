@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Type</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="type">Type :</label>
                <label>{{ $type->type }}</label>
            </div>

            <div class="form-group text-right">
                <a href="{{ url('admin/types') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection