@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Institute</h3>            
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'admin/institutes', 'method' => 'POST', 'files' => true)) }}
            @csrf

            <div class="row">                    
                <div class="form-group col-md-6">
                    <label for="admin_institute_name">Name</label>
                    {{ Form::text('name', '', array('class' => 'form-control', 'id' => 'admin_institute_name', 'required' => true, 'placeholder' => 'Name')) }}
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>  
                
                <div class="form-group col-md-6">
                    <label for="admin_institute_email">Email</label>
                    {{ Form::email('email', '', array('class' => 'form-control', 'id' => 'admin_institute_email', 'required' => true, 'placeholder' => 'Email')) }}
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>                
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="admin_institute_password">Password</label>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'admin_institute_password', 'required' => true, 'placeholder' => 'Password')) }}
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>  

                <div class="form-group col-md-6">
                    <label for="admin_institute_password_confirmation">Confirm Password</label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'admin_institute_password_confirmation', 'required' => true, 'placeholder' => 'Confirm Password')) }}
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>                  
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="admin_institute_teacher">No. Of Teachers</label>
                    {{ Form::number('no_of_teacher', null,array('class' => 'form-control', 'id' => 'admin_institute_teacher', 'required' => true, 'placeholder' => 'No. of teacher', 'min' => '1', 'max' => '100')) }}
                    @if ($errors->has('password'))
                        <span class="no_of_teacher">{{ $errors->first('no_of_teacher') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('admin/institutes') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    <!-- END OVERVIEW --> 
@endsection