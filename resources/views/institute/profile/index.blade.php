@extends('institute.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">My Profile</h3>            
        </div>

        <div class="panel-body">

            <div class="text-center" style="margin-bottom:50px;">
                <img class="image-round" src="{{ $institute->full_image_url }}" height="150px;" width="150px;">
                <div style="margin-top:10px;">
                    <div class="upload-btn-wrapper">
                        <button class="btn btn-success">Change</button>
                        {{ Form::open(array('url' => 'institute/change-profile-pic', 'method' => 'POST', 'files' => true, 'id' => 'profile_pic_form')) }}
                            @csrf
                            <input type="file" name="profile" id="profile_pic_upload" style="cursor:pointer;" />
                        {{ Form::close() }}
                    </div>
                    <div id="file_upload_error" class="text-danger"></div>
                </div>
            </div>

            {{ Form::open(array('url' => 'institute/update-institute-details', 'method' => 'POST', 'id' => 'profile_form')) }}
                <div class="row" style="margin-top:10px;">                
                    <div class="col-md-6">
                        Name: 
                        <span class="_profile_label">{{ $institute->name }} </span>
                        <div>
                            <input id="profile_name" type="text" class="_profile_field" name="name" value="{{ $institute->name }}" style="display:none;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        Phone:
                        <span class="_profile_label"> {{ $institute->phone }} </span>
                        <div>
                            <input id="profile_phone" type="text" class="_profile_field" name="phone" value="{{ $institute->phone }}" style="display:none;" >
                        </div>
                    </div>                
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6">
                        Email: 
                        <span>{{ $institute->email }} </span>
                    </div>
                    <div class="col-md-6">
                        Status:
                        @if($institute->status == 1)
                            <span class="custom-badge-success">Active</span>
                        @else
                            <span class="custom-badge-danger">Blocked</span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-right">
                    <a href="javascript:void(0)" id="edit_profile" class="btn btn-primary">Edit</a>                    
                    <a href="{{ url('/institute') }}" class="btn btn-danger _back_btn">Back</a>

                    <button id="update_profile" type="submit" class="btn btn-success" style="display:none;">Update</button>
                    <a href="javascript:void(0)" id="cancel_profile" class="btn btn-danger" style="display:none;">Cancel</a>
                </div>
            {{ Form::close() }}
        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection