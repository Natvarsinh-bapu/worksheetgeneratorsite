@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading" style="display:flex;justify-content:space-between;">
            <h3 class="panel-title">Category Access</h3>
            <a href="{{ url('/superadmin/admins') }}" class="btn btn-danger">Back</a>
        </div>
        <div class="panel-body">

            {{ Form::hidden('admin_id', $id, array('id' => 'admin_id')) }}

            <div class="row">
                <div>Requested Categories</div>
            </div>
            <div id="accessable_category_div" class="row">
                @forelse ($categories as $item)
                    @if (in_array($item->id, $requested_categories))
                        <div class="col-md-2 {{ in_array($item->id, $accessable_categories)?'access-success' :'access-danger' }}" style="margin-top:10px;">
                            <input id="category_chbx_{{ $item->id }}" type="checkbox" class="_category_checkbox category-access-checkbox" name="category" value="{{ $item->id }}" {{ in_array($item->id, $accessable_categories)?'checked' :'' }}>
                            <label for="category_chbx_{{ $item->id }}" style="font-size:16px;cursor:pointer;">{{ $item->category }}</label>
                        </div>
                    @endif                    
                @empty
                @endforelse
            </div>
            <hr>
            
            <div class="row">
                <div>Your others categories</div>
            </div>
            <div class="row">
                @forelse ($categories as $item)
                    @if (!in_array($item->id, $requested_categories))
                        <div class="col-md-2 access-danger" style="margin-top:10px;">
                            <input id="category_chbx_{{ $item->id }}" type="checkbox" class="_category_checkbox category-access-checkbox _not_requested_category" name="category" data-name="{{ $item->category }}" value="{{ $item->id }}" {{ in_array($item->id, $accessable_categories)?'checked' :'' }}>
                            <label for="category_chbx_{{ $item->id }}" style="font-size:16px;cursor:pointer;">{{ $item->category }}</label>
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>
    {{-- END OVERVIEW --}}
@endsection