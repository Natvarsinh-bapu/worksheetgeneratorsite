@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-list"></i></span>
                        <p>
                            <span class="number">{{ $total_categories }}</span>
                            <span class="title">Categories</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-th-list"></i></span>
                        <p>
                            <span class="number">{{ $total_concepts }}</span>
                            <span class="title">Concepts</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-list-ol"></i></span>
                        <p>
                        <span class="number">{{ $total_sub_concepts }}</span>
                            <span class="title">Sub Concepts</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                        <p>
                            <span class="number">{{ $total_types }}</span>
                            <span class="title">Types</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection
