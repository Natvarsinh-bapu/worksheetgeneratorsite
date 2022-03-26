@extends('institute.layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Layout-{{ $id }}</h3>            
            <div style="text-align:right;">
                <a href="{{ url('/institute/worksheets') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

        <div class="panel-body">            
            <div class="row" style="margin-bottom:10px;display:none;">
                <div class="col-md-3">
                    <div>
                        Category
                    </div>
                    <div>
                        {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        Concept
                    </div>
                    <div>
                        {{ Form::select('concept', $concepts, null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        Sub Concept
                    </div>
                    <div>
                        {{ Form::select('sub_concept', $sub_concepts, null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        Type
                    </div>
                    <div>
                        {{ Form::select('type', $types, null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <hr>

            {{-- IMAGES MODAL _START --}}
            <div class="modal fade" id="images_modal_layout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width: 95%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Select Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -22px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="append_images_div" style="padding: 10px;display:flex;justify-content:center;flex-wrap:wrap;">
                                {{-- dynamic appends --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-id="0" id="load_more_images" type="button" class="btn btn-primary">Load more images</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- IMAGES MODAL _END --}}  
            
                @include('institute.worksheet.layout-'.$id)            

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <input type="hidden" name="img_val" id="img_val" value="" />
                            <a href="javascript:void(0)" class="btn btn-success" id="print_pdf">Download Worksheet</a>
                            <a href="javascript:void(0)" class="btn btn-primary" id="print_pdf_wait" style="cursor: not-allowed;display:none;">Wait...</a>
                        </div>
                    </div>
                </div>
            {{-- {{ Form::close() }} --}}

        </div>
    </div>
    {{-- END OVERVIEW --}}

@endsection