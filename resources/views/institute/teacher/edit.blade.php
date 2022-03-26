@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Teacher</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => array('institute/teachers', $teacher->id), 'method' => 'PUT')) }}
            @csrf
            <div class="row">                    
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    {{ Form::text('name', $teacher->name, array('class' => 'form-control', 'id' => 'name', 'required' => true, 'placeholder' => 'Name')) }}
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>  
                
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    {{ Form::email('email', $teacher->email , array('class' => 'form-control', 'id' => 'email', 'required' => true, 'placeholder' => 'Email')) }}
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>                
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password')) }}
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>  

                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    {{ Form::text('phone', $teacher->phone ,array('class' => 'form-control', 'id' => 'phone', 'required' => true, 'placeholder' => 'Phone')) }}
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div> 

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Confirm Password')) }}
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
            </div> 

            <label for="">Select class</label>
            <div class="row">                
                @forelse ($classes as $key => $value)
                    <div class="col-md-2">
                        <div>
                            <input type="checkbox" name="classes[]" value="{{ $key }}" id="class_{{ $loop->iteration }}" {{ in_array($key, $selected_classes) ? 'checked' : '' }}>
                            &nbsp; <label for="class_{{ $loop->iteration }}">{{ $value }}</label>
                        </div>
                    </div>
                @empty
                    
                @endforelse                
            </div> 

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/teachers') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection