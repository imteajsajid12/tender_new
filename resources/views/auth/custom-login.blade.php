@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="sky-card">
                    <div style="text-align: center"><img src="{{ asset('img/logo.png') }}"></div>
                    <div class="sky-login-container row">
                        <div class="card-body col-md-6">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <div class="login-label  sky-rtl">התחברות</div>
                                        <input placeholder="שם משתמש" id="email" type="email" class="sky-rtl form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input placeholder="סיסמא" id="password" type="password" class="sky-rtl form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn sky-btn-primary">
                                            {{ __('התחבר') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('img/right-logo.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
