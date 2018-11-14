@extends('layouts.auth')

@section('content')



<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
                        @csrf
        <div class="input-group mb-3">
          
          <input id="email" type="email" placeholder="{{ __('Email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
              </label>
          </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
          <br>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
          </div>
        </div>
      </form>

        <br><br>
      <p class="mb-1">
      <a  href="{{ route('password.request') }}">
            {{ __('Hai dimenticato la tua Password?') }}
        </a>
      </p>
      <p class="mb-0">
      <a  href="{{ route('register') }}">{{ __('Registra un nuovo membro') }}</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection
