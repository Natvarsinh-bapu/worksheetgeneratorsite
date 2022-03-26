@extends('admin.layouts.main')

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
        .rating-image-div{
            width: 30px;
        }
    </style>

    {{-- OVERVIEW --}}
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Worksheets</h3>
            {{-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> --}}
        </div>
        <div class="panel-body">                        

            <div class="row" style="overflow: auto;max-height:1450px;">
                @forelse ($worksheets as $item)
                    <div class="col-md-6">
                        <div style="padding:5px;height: 1040px;">
                            <div style="background-color: #fff !important;">
                                {!! $item->html !!}
                            </div>
                        </div>
                        <div class="text-center" style="margin-top:5px">
                            {{ Form::open(array('url' => url('/admin/remove-worksheet'), 'method' => 'POST')) }}
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <a href="{{ url('/admin/edit-worksheets/'. $item->id) }}" class="btn btn-primary">Edit</a>
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
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
