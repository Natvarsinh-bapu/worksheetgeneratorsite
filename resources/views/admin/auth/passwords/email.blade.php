@extends('admin.layouts.app')

@section('content')
<div class="container" style="margin:5% auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-center">
                <div class="" style="text-align:center;">
                    <h2>{{ __('RESET PASSWORD') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">

                                @if (Session::has('error_message'))
                                    <div style="color:red;">
                                        <strong>{{ Session::get('error_message') }}</strong>
                                    </div>
                                @endif
                                @if ($errors->has('email'))
                                    <div style="color:red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                <a href="{{ route('admin.login') }}" class="btn btn-danger">
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
