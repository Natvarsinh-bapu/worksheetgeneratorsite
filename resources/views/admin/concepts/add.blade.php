@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'admin/concepts', 'method' => 'POST')) }}
            @csrf

            <div class="form-group">
                <label for="category_id">Category</label>
                {{ Form::select('category_id', $categories, '', array('class' => 'form-control', 'id' => 'category_id', 'required' => true)) }}
                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <label for="concept">Concept</label>
                {{ Form::text('concept', '', array('class' => 'form-control', 'placeholder' => 'Concept', 'id' => 'concept', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('concept'))
                    <span class="text-danger">{{ $errors->first('concept') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('admin/concepts') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection