@extends('master-login-register')
@section('title')
Login
@endsection

@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Reset Password') }}
      </div>
    </h2>
    @if (session('status'))
        <div class="ui message">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <form class="ui large form" method="POST" action="{{ route('password.request') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="ui left stacked segment">

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
          </div>
          @if ($errors->has('email'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
          </div>
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Reset Password') }}
        </button>
      </div>

      <div class="ui error message"></div>

    </form>
  </div>
</div>

@endsection
