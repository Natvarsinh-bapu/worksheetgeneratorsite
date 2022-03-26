@extends('superadmin.layouts.main')

@section('content')
    {{-- OVERVIEW --}}
    <div class="panel panel-headline">

        <div class="panel-heading">
            <h3 class="panel-title">View Type</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>

        <div class="panel-body">
            <div class="p-5">
                <h4><b>Type:</b></h4>                
            </div>
            <div class="p-5">
                {{ $type->type }}                
            </div>

            <hr>

            <div class="p-5">
                <h4><b>Sub Concept:</b></h4>                
            </div>
            <div class="p-5">
                {{ $type->sub_concept->sub_concept }}                
            </div>

            <hr>

            <div class="p-5">
                <h4><b>Concept:</b></h4>                
            </div>
            <div class="p-5">
                {{ $type->concept->concept }}                
            </div>

            <hr>

            <div class="p-5">
                <h4><b>Category:</b></h4>                
            </div>
            <div class="p-5">
                {{ $type->category->category }}                
            </div>            

            <div class="p-5">
                <h4><b>Images:</b></h4>                
            </div>
            <div class="row">
                @forelse ($type->images as $item)
                    <div class="col-md-3" style="margin-top:5px;">
                        <div class="type-image-div">
                            <img src="{{ $item->image_url }}" height="200px;" width="200px;">
                        </div>
                    </div>
                @empty                    
                @endforelse
            </div>

            <div class="form-group text-right">
                <a href="{{ url('superadmin/types') }}" class="btn btn-danger">Back</a>
            </div>

        </div>

    </div>
    {{-- END OVERVIEW --}}
@endsection