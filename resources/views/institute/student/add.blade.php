@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Student</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'institute/students', 'method' => 'POST')) }}
            @csrf
            <div class="row">                    
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    {{ Form::text('name', '', array('class' => 'form-control', 'id' => 'name', 'required' => true, 'placeholder' => 'Name')) }}
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    {{ Form::email('email', '', array('class' => 'form-control', 'id' => 'email', 'required' => true, 'placeholder' => 'Email')) }}
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>                
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'required' => true, 'placeholder' => 'Password')) }}
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>  

                <div class="form-group col-md-6">
                    <label for="enrollment_no">Enrollment No.</label>
                    {{ Form::text('enrollment_no', null,array('class' => 'form-control', 'id' => 'enrollment_no', 'required' => true, 'placeholder' => 'Enrollment No.')) }}
                    @if ($errors->has('enrollment_no'))
                        <span class="text-danger">{{ $errors->first('enrollment_no') }}</span>
                    @endif
                </div>
            </div> 

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'required' => true, 'placeholder' => 'Confirm Password')) }}
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="class">Class</label>
                    {{ Form::select('class', $classes, null, array('class' => 'form-control', 'id' => 'class', 'required' => true)) }}
                    @if ($errors->has('class'))
                        <span class="text-danger">{{ $errors->first('class') }}</span>
                    @endif
                </div>
            </div> 

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/students') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    <!-- END OVERVIEW -->
@endsection