@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Worksheets</h3>
        </div>
        <div class="panel-body">
            
            {{ Form::open(array('url' => 'superadmin/worksheet-upload', 'method' => 'POST', 'files' => true, 'id' => 'upload_worksheet_form')) }}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: right;">
                            <div class="upload-btn-wrapper">
                                <button class="btn-upload cursor-pointer">Upload worksheet</button>
                                <input id="worksheet_upload_btn" class="" type="file" name="worksheets[]" multiple accept="application/pdf">
                            </div>
                            <div class="upload-btn-wrapper _upload_wait" style="display: none;">
                                <button class="btn-upload cursor-pointer">Wait...</button>
                            </div>
                            <div>Upload PDF files only</div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
            <hr>

            <div class="row">
                @forelse ($worksheets as $item)
                    <div class="col-md-6">
                        <div>
                            <object data="{{ $item->worksheet_url }}" type="application/pdf" width="100%" height="660px">
                                <embed src="{{ $item->worksheet_url }}" type="application/pdf" width="100%" height="660px" />
                            </object>
                        </div>
                        <div style="padding: 2px 0 10px 0;">
                            {{ Form::open(array('url' => url('superadmin/upload-worksheets/'.$item->id), 'method' => 'POST')) }}
                                @csrf
                                @method('DELETE')
                                <div style="text-align: center">
                                    <button class="btn btn-danger" type="submit" style=""><i class="fa fa-trash"></i>&nbsp; Delete</button>
                                    <a class="btn btn-success" href="{{ url('superadmin/worksheet-download/'. $item->id) }}"><i class="fa fa-download"></i>&nbsp; Download</a>
                                </div>
                            {{ Form::close() }}                            
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="text-center">
                            <h3>No worksheet available</h3>
                        </div>
                    </div>
                @endforelse               
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        {{ $worksheets->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection
