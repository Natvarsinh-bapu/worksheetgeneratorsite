@extends('superadmin.layouts.app')

@section('content')
<div class="container" style="margin:5% auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-center">
                <div class="" style="text-align:center;">
                    <h2>{{ __('CHANGE PASSWORD') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('superadmin.change-password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="curr_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="curr_password" type="password" class="form-control{{ $errors->has('curr_password') ? ' is-invalid' : '' }}" name="curr_password" placeholder="Current Password" required>

                                @if ($errors->has('curr_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('curr_password') }}</strong>
                                    </span>
                                @endif
                                
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>

                                <a href="{{ url('/superadmin/dashboard') }}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
