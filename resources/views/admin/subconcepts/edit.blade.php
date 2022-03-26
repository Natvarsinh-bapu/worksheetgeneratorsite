@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Sub Concept</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <span id="edit_sub_concept_span" data-id="{{ $sub_concept->id }}"></span>

        <div class="panel-body">
            {{ Form::open(array('url' => array('admin/sub-concepts', $sub_concept->id), 'method' => 'PUT')) }}
            @csrf

            <div class="form-group">
                    <label for="category_id">Category</label>
                    {{ Form::select('category_id', $categories, $sub_concept->category_id, array('class' => 'form-control', 'id' => 'admin_category_for_sub_concept_edit', 'required' => true)) }}
                    @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
    
                <div class="form-group">
                    <label for="concept_id">Concept</label>
                    {{ Form::select('concept_id', [], '', array('class' => 'form-control', 'id' => 'admin_concept_for_sub_concept_edit', 'required' => true)) }}
                    @if ($errors->has('concept_id'))
                        <span class="text-danger">{{ $errors->first('concept_id') }}</span>
                    @endif
                </div>

            <div class="form-group">
                <label for="sub_concept">Sub Concept</label>
                {{ Form::text('sub_concept', $sub_concept->sub_concept, array('class' => 'form-control', 'placeholder' => 'Sub Concept', 'id' => 'sub_concept', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('sub_concept'))
                    <span class="text-danger">{{ $errors->first('sub_concept') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('admin/sub-concepts') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection