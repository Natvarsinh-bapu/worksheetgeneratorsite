@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Sub Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="p-5">
                <h4><b>Sub Concept:</b></h4>
            </div>
            <div class="p-5">
                {{ $sub_concept->sub_concept }}
            </div>

            <hr>

            <div class="p-5">
                <h4><b>Category:</b></h4>
            </div>
            <div class="p-5">
                {{ $sub_concept->category->category }}
            </div>

            <hr>

            <div class="p-5">
                <h4><b>Concept:</b></h4>
            </div>
            <div class="p-5">
                {{ $sub_concept->concept->concept }}
            </div>

            <div class="form-group text-right">
                <a href="{{ url('superadmin/sub-concepts') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection