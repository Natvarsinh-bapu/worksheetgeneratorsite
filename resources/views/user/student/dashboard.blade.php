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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Assigned Worksheets by teachers</b>
                    </div>
                    <div class="card-body">
                        @forelse ($teachers as $item)
                            <div>
                                <a class="btn btn-success m-2" href="{{ url('/my-worksheets/' . $item->teacher->id) }}">
                                    {{ $item->teacher->name }}
                                </a>
                            </div>
                        @empty
                            No teachers assigned
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <b>Title</b>
                    </div>
                    <div class="card-body">
                        Data
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <b>Title</b>
                    </div>
                    <div class="card-body">
                        Data
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection