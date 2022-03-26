@extends('superadmin.layouts.main')

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
                    <a href="{{ url('/superadmin/categories') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-list"></i></span>
                            <p>
                                <span class="number">{{ $total_categories }}</span>
                                <span class="title">Categories</span>
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ url('/superadmin/concepts') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-th-list"></i></span>
                            <p>
                                <span class="number">{{ $total_concepts }}</span>
                                <span class="title">Concepts</span>
                            </p>
                        </div>
                    </a>
                </div>
                                
                <div class="col-md-3">
                    <a href="{{ url('/superadmin/sub-concepts') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-list-ol"></i></span>
                            <p>
                            <span class="number">{{ $total_sub_concepts }}</span>
                                <span class="title">Sub Concepts</span>
                            </p>
                        </div>
                    </a>
                </div>
                                
                <div class="col-md-3">
                    <a href="{{ url('/superadmin/types') }}">
                        <div class="metric">                        
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <p>
                                <span class="number">{{ $total_types }}</span>
                                <span class="title">Types</span>
                            </p>
                        </div>
                    </a>
                </div>
            
                <div class="col-md-3">
                    <a href="{{ url('/superadmin/edit-worksheets') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-edit"></i></span>
                            <p>
                                <span class="number">{{ $total_html_worksheet }}</span>
                                <span class="title">Edit Worksheets</span>
                            </p>
                        </div>
                    </a>
                </div>

                {{-- <div class="col-md-3">
                    <a href="{{ url('/superadmin/questions') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-question"></i></span>
                            <p>
                                <span class="number">{{ $total_questions }}</span>
                                <span class="title">Questions</span>
                            </p>
                        </div>
                    </a>
                </div> --}}

                {{-- <div class="col-md-3">
                    <a href="{{ url('/superadmin/worksheet') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-file"></i></span>
                            <p>
                                <span class="number">{{ $total_worksheets }}</span>
                                <span class="title">Worksheets</span>
                            </p>
                        </div>
                    </a>
                </div> --}}
                
                {{-- <div class="col-md-3">
                    <a href="{{ url('/superadmin/templates') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-file"></i></span>
                            <p>
                                <span class="number">{{ $total_templates }}</span>
                                <span class="title">Templates</span>
                            </p>
                        </div>        
                    </a>
                </div> --}}

                <div class="col-md-3">
                    <a href="{{ url('/superadmin/upload-worksheets') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-file"></i></span>
                            <p>
                                <span class="number">{{ $total_uploaded }}</span>
                                <span class="title">Uploaded Worksheets</span>
                            </p>
                        </div>        
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ url('/superadmin/admins') }}">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <p>
                                <span class="number">{{ $total_admins }}</span>
                                <span class="title">Admins</span>
                            </p>
                        </div>        
                    </a>
                </div>

            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection
