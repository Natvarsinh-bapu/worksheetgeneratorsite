@extends('superadmin.layouts.main')

@section('content')
    <style>
        .layout-header-titles {
            border-bottom: 1px solid;
            margin-top: 10px;
        }
        .class-roll-div {
            display:flex;
            justify-content:space-between;
            border-bottom: 1px solid;
            margin-top:10px;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Worksheet</h3>            
            <div style="text-align:right;">
                <a href="{{ url('/superadmin/edit-worksheets') }}" class="btn btn-danger">Back</a>
            </div>
        </div>

        <div class="panel-body">

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
            
                <span id="question_span" style="display: none;">{{ $worksheet->question }}</span>
                <div id="print_div" style="background-color: #fff !important;">
                    {!! $worksheet->html !!}
                </div>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a href="javascript:void(0)" class="btn btn-success" id="print_pdf">Download Worksheet</a>
                            <a href="javascript:void(0)" class="btn btn-primary" id="print_pdf_wait" style="cursor: not-allowed;display:none;">Wait...</a>                      
                        </div>
                    </div>
                </div>            

        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection