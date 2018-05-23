@extends('master-login-register')
@section('title')
Login
@endsection
@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Login') }}
      </div>
    </h2>
    <form class="ui large form"method="POST" action="{{ route('login') }}">
      @csrf
      <div class="ui left stacked segment">

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Login') }}
        </button>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      Belum Mendaftar? <a href="{{ route('register') }}">Register</a>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#login").addClass("active");
    });
    $('#search-select')
      .dropdown()
    ;

</script>
@endsection
