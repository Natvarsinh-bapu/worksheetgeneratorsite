@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => array('institute/concepts', $concept->id), 'method' => 'PUT')) }}
            @csrf
            <div class="form-group">
                <label for="concept">Concept</label>
                {{ Form::text('concept', $concept->concept, array('class' => 'form-control', 'placeholder' => 'Concept', 'id' => 'concept', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('concept'))
                    <span class="text-danger">{{ $errors->first('concept') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/concepts') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection