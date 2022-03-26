@extends('admin.layouts.main')

@section('content')    
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>
        <div class="panel-body">
            <div class="row">
                <a href="/admin/categories">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-list"></i></span>
                            <p>
                                <span class="number">{{ $total_categories }}</span>
                                <span class="title">Categories</span>
                            </p>
                        </div>
                    </div>
                </a>

                <a href="/admin/concepts">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-th-list"></i></span>
                            <p>
                                <span class="number">{{ $total_concepts }}</span>
                                <span class="title">Concepts</span>
                            </p>
                        </div>
                    </div>
                </a>

                <a href="/admin/sub-concepts">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-list-ol"></i></span>
                            <p>
                            <span class="number">{{ $total_sub_concepts }}</span>
                                <span class="title">Sub Concepts</span>
                            </p>
                        </div>
                    </div>
                </a>

                <a href="/admin/types">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <p>
                                <span class="number">{{ $total_types }}</span>
                                <span class="title">Types</span>
                            </p>
                        </div>
                    </div>
                </a>

                <a href="/admin/questions">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-question"></i></span>
                            <p>
                                <span class="number">{{ $total_questions }}</span>
                                <span class="title">Questions</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="/admin/institutes">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-building"></i></span>
                            <p>
                                <span class="number">{{ $total_institutes }}</span>
                                <span class="title">Institutes</span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}

        {{-- LINK --}}
        {{-- <div id="alert_div"></div>
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Your link for register institute under you</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="shared_link_div" style="display:inline-block;font-size:20px;word-break:break-word;">
                            {{ url('/') . '/institute/register/' . $admin->unique_token }}                            
                        </div>
                        <span id="copy_link" class="btn btn-primary" style="margin-left:20px;">
                            Copy <i class="fa fa-copy" style="cursor:pointer;font-size:20px;"></i>
                        </span>
                    </div>                    
                </div>
            </div>
        </div> --}}
        {{-- END LINK --}}
@endsection
