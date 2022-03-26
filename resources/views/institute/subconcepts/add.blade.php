@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Sub Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'institute/sub-concepts', 'method' => 'POST')) }}
            @csrf
            <div class="form-group">
                <label for="sub_concept">Sub Concept</label>
                {{ Form::text('sub_concept', '', array('class' => 'form-control', 'placeholder' => 'Sub Concept', 'id' => 'sub_concept', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('sub_concept'))
                    <span class="text-danger">{{ $errors->first('sub_concept') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="concept_id">Concept</label>
                {{ Form::select('concept_id', $concepts, '', array('class' => 'form-control', 'id' => 'concept_id', 'required' => true)) }}
                @if ($errors->has('concept_id'))
                    <span class="text-danger">{{ $errors->first('concept_id') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/sub-concepts') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection