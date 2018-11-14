@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Registra un nuovo membro</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">

                <input id="name" placeholder="{{ __('Name') }}" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                    name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <div class="input-group-append">
                    <span class="fa fa-user input-group-text"></span>
                </div>
            </div>

            <div class="input-group mb-3">
                <input id="email" placeholder="{{ __('Email') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <div class="input-group-append">
                    <span class="fa fa-envelope input-group-text"></span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control"
                    name="password_confirmation" required>
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>

                <div class="links">
                <br>
                @if (Route::has('login'))                
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Hai già un account?</a>
                    @endauth                
                @endif
                </div>
        </form>


    </div>
</div>
</div>

@endsection
