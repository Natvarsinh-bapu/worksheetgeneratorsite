@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Category</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
    
            <div class="p-5">
                <h4><b>Category:</b></h4>
            </div>
            <div class="p-5">
                {{ $category->category }}
            </div>

            <div class="form-group text-right">
                <a href="{{ url('superadmin/categories') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection