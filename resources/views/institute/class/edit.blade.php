@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Class</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => array('institute/class', $class_data->id), 'method' => 'PUT')) }}
            @csrf
            <div class="form-group">
                <label for="name">name</label>
                {{ Form::text('name', $class_data->name, array('class' => 'form-control', 'placeholder' => 'Class name', 'id' => 'name', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/class') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection