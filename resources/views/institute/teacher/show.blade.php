@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Teacher</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="category">Name:</label>
                <label>{{ $teacher->name }}</label>
            </div>
            <div class="form-group">
                <label for="category">Email:</label>
                <label>{{ $teacher->email }}</label>
            </div>
            <div class="form-group">
                <label for="category">Phone:</label>
                <label>{{ $teacher->phone }}</label>
            </div>            
            <div class="form-group">
                <label for="category">Class:</label>
                <div>
                    @forelse ($classes as $item)
                        <span style="font-size: 30px">{{ $item->classname->name }}, </span>
                    @empty
                        
                    @endforelse
                </div>
            </div>            

            <div class="form-group text-right">
                <a href="{{ url('institute/teachers') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection