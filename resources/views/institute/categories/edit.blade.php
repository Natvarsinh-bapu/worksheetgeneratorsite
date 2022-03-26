@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Category</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => array('institute/categories', $category->id), 'method' => 'PUT')) }}
            @csrf
            <div class="form-group">
                <label for="category">Category</label>
                {{ Form::text('category', $category->category, array('class' => 'form-control', 'placeholder' => 'Category', 'id' => 'category', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('institute/categories') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection