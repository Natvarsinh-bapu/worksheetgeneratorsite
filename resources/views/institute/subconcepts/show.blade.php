@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Sub Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="sub_concept">Sub Concept :</label>
                <label>{{ $sub_concept->sub_concept }}</label>
            </div>

            <div class="form-group">
                <label for="concept">Concept :</label>
                <label>{{ $sub_concept->concept->concept }}</label>
            </div>

            <div class="form-group text-right">
                <a href="{{ url('institute/sub-concepts') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection