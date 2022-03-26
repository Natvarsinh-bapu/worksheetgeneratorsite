@extends('admin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Institutes</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>
        <div class="panel-body">
            <div class="form-group text-left">
                <a href="{{ url('admin/institutes/create') }}" class="btn btn-success">ADD</a>
            </div>

            <div class="row">
                {{-- BASIC TABLE --}}
                <table class="table" id="admin_institutes_table">
                    <thead>
                        <tr>
                            <th>Name</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                 {{-- END BASIC TABLE  --}}
            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection

{{-- MODAL FOR DELETE ADMIN CONFIRM _START --}}
<div id="institute_delete_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-danger" style="font-size:18px;">Are you sure you want to delete this institute?</p>
          <p class="text-danger" style="font-size:18px;">It will remove with all related data!</p>
        </div>
        <div class="modal-footer model-footer-padding">
            {{ Form::open(array('url' => 'admin/delete-institute', 'method' => 'POST')) }}
            @csrf
            {{ Form::hidden('id', '', array('id' => 'institute_id')) }}
                <button type="submit" class="btn btn-danger delete-button">Delete</button>
            {{ Form::close() }}
        </div>
      </div>
    </div>
</div>
{{-- MODAL FOR DELETE ADMIN CONFIRM _END --}}