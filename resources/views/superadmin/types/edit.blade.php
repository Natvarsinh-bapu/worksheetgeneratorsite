@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Edit Type</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <span id="edit_type_span" data-id="{{ $type->id }}"></span>

        <div class="panel-body">
            {{ Form::open(array('url' => array('superadmin/types', $type->id), 'method' => 'PUT', 'files' => true)) }}
            @csrf

            <div class="form-group">
                <label for="category_id">Category</label>
                {{ Form::select('category_id', $categories, $type->category_id, array('class' => 'form-control', 'id' => 'superadmin_category_edit_for_type', 'required' => true)) }}
                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="concept_id">Concept</label>
                {{ Form::select('concept_id', [], '', array('class' => 'form-control', 'id' => 'superadmin_concept_edit_for_type', 'required' => true)) }}
                @if ($errors->has('concept_id'))
                    <span class="text-danger">{{ $errors->first('concept_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="concept_id">Sub Concept</label>
                {{ Form::select('sub_concept_id', [], '', array('class' => 'form-control', 'id' => 'superadmin_sub_concept_edit_for_type', 'required' => true)) }}
                @if ($errors->has('sub_concept_id'))
                    <span class="text-danger">{{ $errors->first('sub_concept_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                {{ Form::text('type', $type->type, array('class' => 'form-control', 'placeholder' => 'Type', 'id' => 'type', 'required' => true, 'maxlength' => '50')) }}
                @if ($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div>
                    <label for="images">Images</label>
                </div>
                <div id="image_list" class="row">
                    @forelse ($type_images as $item)
                        <div class="col-md-3 type-image type-image-main _parent_type_{{ $item->id }}">
                            <div class="type-image-div">
                                <img src="{{ $item->image_url }}">
                                <div class="type-image-trash">
                                    <i data-id="{{ $item->id }}" class="fa fa-trash _remove_type_image" style="cursor: pointer;"></i>
                                </div>
                            </div>
                            
                        </div>
                    @empty                        
                    @endforelse
                    {{-- IMAGE APPEND DYNAMICALLY --}}
                    <div class="col-md-3 upload-btn-div">
                        <div class="upload-btn-wrapper">
                            <button class="btn-upload">Upload image</button>
                            <input id="file_upload" class="image_file_type" type="file" name="images[]">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('superadmin/types') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
     {{-- END OVERVIEW --}}
@endsection