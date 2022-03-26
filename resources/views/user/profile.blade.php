@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/dashboard') }}" class="btn btn-warning">Back</a>
                    <span class="ml-2">Profile</span>
                </div>
                <div class="card-body">
                    @if ($user->role == 'student')
                        @include('user.student.profile')
                    @else
                        @include('user.teacher.profile')
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
