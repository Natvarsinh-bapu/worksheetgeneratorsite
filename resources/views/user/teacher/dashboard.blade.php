@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>Dashboard</b></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <b>{{ $user->name }}</b>
                            </div>

                            @if ($user->role == 'student')
                                <div>
                                    <b>Class: {{ $user->className->name }}</b>
                                </div>
                            @endif                        
                        </div>
                    </div>
                </div>            
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <b>Menus</b>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ url('/worksheets') }}">
                            Worksheets
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <b>Class</b>
                    </div>
                    <div class="card-body">                
                        @forelse ($user->teacherClasses as $item)                        
                            <div>
                                <a class="btn btn-warning m-2" href="{{ url('/students/'. $item->class_id) }}">
                                    {{ $item->classname->name }}
                                </a>
                                <a class="" href="{{ url('/students/'. $item->class_id) }}">
                                    <span>View students</span>
                                </a>
                            </div>
                        @empty
                            No class assigned                        
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Assigned Worksheets</b>
                    </div>
                    <div class="card-body">
                        @forelse ($user->teacherClasses as $item)
                            <div>
                                <a class="btn btn-success m-2" href="{{ url('/assigned-worksheets/'. $item->class_id) }}">
                                    Class {{ $item->classname->name }}
                                </a>                        
                            </div>
                        @empty
                            No class assigned
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection