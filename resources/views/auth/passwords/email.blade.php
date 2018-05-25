@extends('master-login-register')
@section('title')
Reset Password
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
    <form class="ui large form" method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="ui left stacked segment">

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
          </div>
          @if ($errors->has('email'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Send Password Reset Link') }}
        </button>
      </div>

      <div class="ui error message"></div>

    </form>

  </div>
</div>
@endsection
