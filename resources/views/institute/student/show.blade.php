@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Student</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="category">Name:</label>
                <label>{{ $student->name }}</label>
            </div>
            <div class="form-group">
                <label for="category">Email:</label>
                <label>{{ $student->email }}</label>
            </div>
            <div class="form-group">
                <label for="category">Enrollment No.:</label>
                <label>{{ $student->enrollment_no }}</label>
            </div>            
            <div class="form-group">
                <label for="category">Class:</label>
                <label>{{ $student->className->name }}</label>
            </div>            

            <div class="form-group text-right">
                <a href="{{ url('institute/students') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection