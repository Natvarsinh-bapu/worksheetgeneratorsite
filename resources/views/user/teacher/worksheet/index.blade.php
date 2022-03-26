@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url('/dashboard') }}" class="btn btn-warning">Back</a>
                            <span class="ml-2">Worksheets</span>
                        </div>
                        <div>
                            <button id="assign_btn" class="btn btn-success">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="overflow: auto;max-height:1450px;">
                        @forelse ($worksheets as $item)
                            <div class="col-md-4">
                                <div class="m-2" style="border: 1px solid #8C8787;border-radius:5px;">
                                    <div class="card-body">
                                        <img src="{{ $item->image_url }}" alt="" width="100%" height="100%">
                                    </div>
                                    <div class="text-center p-2">
                                        <input class="_assign_worksheet" type="checkbox" name="worksheets[]" value="{{ $item->id }}">
                                    </div>
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
                            <div class="m-2" style="display:flex;justify-content:flex-end;">
                                {{ $worksheets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- assigne limit modal --}}
    <div class="modal fade" id="assign_limit_modal" tabindex="-1" role="dialog" aria-labelledby="assign_limit_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assign_limit_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger" id="assign_message"></h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    {{-- student list modal --}}
    <div id="student_list_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                     <div style="max-width:600px;">
                        <select class="form-control" name="class_select" id="class_select">
                            <option value="">Select class</option>
                            @forelse (Auth::user()->teacherClasses as $item)
                                <option value="{{ $item->classname->id }}">{{ $item->classname->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div id="assigned_alert_div" class="ml-2"></div>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="student_list_div" class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
