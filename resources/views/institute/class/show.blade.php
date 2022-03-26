@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Class</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="category">Class name:</label>
                <label>{{ $class_data->name }}</label>
            </div>
            
            <div class="form-group">
                <label for="category">Teachers:</label>
                @forelse ($class_data->classTeachers as $item)
                    <div>{{ $loop->iteration }}.  {{ $item->teacher->name }}</div>
                @empty
                    <div>No teachers</div>
                @endforelse
            </div>

            <div class="form-group text-right">
                <a href="{{ url('institute/class') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection