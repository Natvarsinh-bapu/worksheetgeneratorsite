@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Institute</h3>            
        </div>

        <div class="panel-body">

            <div class="text-center" style="margin-bottom:50px;">
                <img class="image-round" src="{{ $institute->full_image_url }}" height="150px;" width="150px;">
            </div>

            <div class="row" style="margin-top:10px;">
                <div class="col-md-6">
                    Name: {{ $institute->name }}
                </div>                            
                <div class="col-md-6">
                    Email: {{ $institute->email }}
                </div>                
            </div>

            <div class="row" style="margin-top:10px;">
                <div class="col-md-6">
                    Phone: {{ $institute->phone }}
                </div>
                <div class="col-md-6">
                    Teachers limit: {{ $institute->no_of_teacher }}
                </div>
            </div>

            <div class="form-group text-right">
                <a href="{{ url('admin/institutes') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection