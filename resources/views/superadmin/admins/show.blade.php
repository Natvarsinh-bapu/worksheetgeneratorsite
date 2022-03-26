@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Admin</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <span id="admin_id_span" style="display:none;">{{ $admin->id }}</span>

        <div class="panel-body">

            <div class="text-center" style="margin-bottom:50px;">
                <img class="image-round" src="{{ $admin->details->full_image_url }}" height="150px;" width="150px;">
            </div>

            <div class="row" style="margin-top:10px;">
                <div class="col-md-6">
                    Name: {{ $admin->name }}
                </div>
                <div class="col-md-6">
                    Phone: {{ $admin->details->phone }}
                </div>                
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-6">
                    Email: {{ $admin->email }}
                </div>
                <div class="col-md-6">
                    @if($admin->status == 0)
                        Status: {{ Form::select('status', ['0' => 'Requested', '1' => 'Active', '2' => 'Blocked'], $admin->status, array('class' => '', 'id' => 'status_admin_select')) }}
                    @else
                        Status: {{ Form::select('status', ['1' => 'Active', '2' => 'Blocked'], $admin->status, array('class' => '', 'id' => 'status_admin_select')) }}
                    @endif                    
                </div>                
            </div>

            <div class="form-group text-right">
                <a href="{{ url('superadmin/admins') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection