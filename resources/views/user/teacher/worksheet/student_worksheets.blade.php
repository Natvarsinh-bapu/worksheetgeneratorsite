@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ url('/assigned-worksheets/' . $user->class) }}" class="btn btn-warning">Back</a>
                            <span class="ml-2">Worksheets assigned to {{ $user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="overflow: auto;max-height:1450px;">
                        @forelse ($worksheets as $item)
                            <div class="col-md-4">
                                <div class="m-2" style="border: 1px solid #8C8787;border-radius:5px;">
                                    <div class="card-body">
                                        <img src="{{ $item->worksheet->image_url }}" alt="" width="100%" height="100%">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-right">
                                            <div class="p-1">
                                                @if ($item->is_checked)
                                                    <span class="p-1 text-light" style="background-color: green;border-radius:5px;">
                                                        Done
                                                    </span>
                                                @else
                                                    @if ($item->is_submit)
                                                        <span class="p-1" style="background-color: yellow;border-radius:5px;">
                                                            Submitted
                                                        </span>
                                                    @endif
                                                @endif                                                
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="p-1">
                                                <span>Assigned at {{ Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}</span>
                                            </div>
                                        </div>
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
</div>
@endsection