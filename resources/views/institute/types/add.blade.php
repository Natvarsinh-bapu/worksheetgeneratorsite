@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Type</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'institute/types', 'method' => 'POST')) }}
            @csrf
            <div class="form-group">
                <label for="type">Type</label>
                {{ Form::text('type', '', array('class' => 'form-control', 'placeholder' => 'Type', 'id' => 'type', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/types') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection