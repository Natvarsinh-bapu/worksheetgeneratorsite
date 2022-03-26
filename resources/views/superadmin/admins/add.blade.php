@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">Add New Admin (Client)</h3>            
        </div>

        <div class="panel-body">
            {{ Form::open(array('url' => 'superadmin/admins', 'method' => 'POST', 'files' => true)) }}
            @csrf

            <div class="row">                    
                <div class="form-group col-md-6">
                    <label for="superadmin_admin_name">Name</label>
                    {{ Form::text('name', '', array('class' => 'form-control', 'id' => 'superadmin_admin_name', 'required' => true, 'placeholder' => 'Name')) }}
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>  
                
                <div class="form-group col-md-6">
                    <label for="superadmin_admin_email">Email</label>
                    {{ Form::email('email', '', array('class' => 'form-control', 'id' => 'superadmin_admin_email', 'required' => true, 'placeholder' => 'Email')) }}
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>                
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="superadmin_admin_password">Password</label>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'superadmin_admin_password', 'required' => true, 'placeholder' => 'Password')) }}
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>  

                <div class="form-group col-md-6">
                    <label for="superadmin_admin_password_confirmation">Confirm Password</label>
                    {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'superadmin_admin_password_confirmation', 'required' => true, 'placeholder' => 'Confirm Password')) }}
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>                  
            </div>    
            
            <div class="row">
                <div class="col-md-12">                    
                    <label for="">Select categories</label>
                    <div style="padding:8px;">
                        <div>
                            <input type="checkbox" name="select_all_categories" id="select_all_categories" style="cursor:pointer;"> 
                            <label for="select_all_categories" style="cursor:pointer;"> Select all</label>

                            @if ($errors->has('categories'))
                                <span class="text-danger" style="margin-left:20px;">{{ $errors->first('categories') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="max-height:200px;overflow:auto;margin-bottom:20px;">                
                @forelse ($categories as $item)
                    <div class="col-md-2" style="margin-top:10px;">
                        <input id="chbx_{{ $item->id }}" type="checkbox" class="category-access-checkbox _category_add" name="categories[]" value="{{ $item->id }}">
                        <label for="chbx_{{ $item->id }}" style="font-size:16px;cursor:pointer;">{{ $item->category }}</label>
                    </div>
                @empty
                    
                @endforelse
            </div>

            <div class="form-group text-right">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href="{{ url('superadmin/admins') }}" class="btn btn-danger">Cancel</a>
            </div>
            {{ Form::close() }}
        </div>

    </div>
    <!-- END OVERVIEW --> 
@endsection