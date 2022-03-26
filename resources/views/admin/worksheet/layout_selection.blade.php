@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Select layout</h3>
        </div>
        <div class="panel-body"> 
            <div class="row" style="display:none;">
                <div class="col-md-2">
                    <label for="question">Category</label>
                </div>
                <div class="col-md-2">
                    <label for="question">Concept</label>
                </div>
                <div class="col-md-2">
                    <label for="question">Sub Concept</label>
                </div>
                <div class="col-md-2">
                    <label for="question">Type</label>
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row" style="display:none;">
                {{ Form::open(array('url' => 'admin/worksheet/create', 'method' => 'GET', 'files' => true)) }}
                    <div class="col-md-2">
                        {{ Form::select('category', $categories, Request::get('category'), array('class' => 'form-control', 'id' => 'category_filter')) }}
                        @if ($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                    <div class="col-md-2">
                        {{ Form::select('concept', ['' => 'Select Concept'], '', array('class' => 'form-control', 'id' => 'concept_filter')) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::select('sub_concept', ['' => 'Select Sub Concept'], '', array('class' => 'form-control', 'id' => 'sub_concept_filter')) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::select('type', ['' => 'Select Type'], '', array('class' => 'form-control', 'id' => 'type_filter')) }}
                    </div>
                    <div class="col-md-2" style="text-align:center;">
                        {{ Form::submit('Filter', array('class' => 'btn btn-success')) }}
                    </div>
                    <div class="col-md-2" style="text-align:left;">
                        <a href="/admin/worksheet/create" class="btn btn-info">Clear Filter</a>
                    </div>
                {{ Form::close() }}
            </div>
            <hr>

            <div class="row">
                @for ($i = 1; $i < 9; $i++)
                    <div class="col-md-3">
                        <a href="{{ url('/admin/layouts/'.$i) }}">
                            <div class="worksheet-layout">
                                <img src="{{ asset('worksheet_layout/layout-'.$i.'.png') }}" height="100%" width="100%">
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection