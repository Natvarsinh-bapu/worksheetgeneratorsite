@extends('admin.layouts.app')

@section('content')
    <div class="container" style="margin:5% auto;">
        <div class="row justify-content-center">
            <div class="login-center">
                <div class="" style="text-align:center;">
                    <h2>{{ __('SELECT CATEGORIES') }}</h2>
                </div>

                <div class="card-body">

                    @if (Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    @if (Session::has('error_message'))
                        <div class="alert alert-danger">
                            {{ Session::get('error_message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('admin/request-categories') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        {{ Form::hidden('admin_id', $admin->id) }}

                        @if ($errors->any())            
                                <div style="padding:10px;">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>                            
                        @endif                       

                        <div class="row" style="background-color:#f1f1f1; justify-content:center;border-bottom:1px solid  #85929e;">
                            <div style="margin:10px 10px;">
                                <span style="margin-right:10px; color:#000;">Enter Number of Institutes</span>
                                <input type="text" name="no_of_institutes" value="" placeholder="No. Institutes (e.g. 5)">
                            </div>
                        </div>

                        <div class="row category-verify" style="background-color:#f1f1f1">
                            @forelse ($categories as $item)
                                <div class="col-md-2">
                                    <div>
                                        <input type="checkbox" class="category-select-checkbox" name="categories[]" value="{{ $item->id }}">
                                        <span>{{ $item->category }}</span>
                                    </div>
                                </div>    
                            @empty
                                <div class="col-md-12" style="margin:auto;text-align:center;">
                                    <div>
                                        <h5>No categories available.</h5>
                                    </div>
                                </div>  
                            @endforelse
                        </div>

                        <div class="form-group row" style="margin-top:20px;justify-content:center;">
                            @if($categories->isNotEmpty())
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Request categories & verify') }}
                                </button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
