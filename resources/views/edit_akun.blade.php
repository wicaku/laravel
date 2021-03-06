@extends('master')
@section('title')
Register
@endsection
@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('kategorisasi', ['id'=> $user->idPemda]) }}"><i class="home icon"></i>Kategorisasi</a><span> / {{ $userName->name}}</span></h5></div>
    </div>
  </div>

  <div class="ui text container middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <div class="content">
          {{ __('Edit Akun Pemerintah Daerah') }}
        </div>
      </h2>
      <form class="ui large form"method="POST" action="{{ route('kategorisasi.update', ['id'=> $user->idPemda]) }}">
        @csrf
        <div class="ui left stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <div class="ui disabled fluid search normal dropdown selection">
                 <input name="name" type="hidden" value="{{ $userName->name }}">
                 <i class="dropdown icon"></i>
                 <div class="text">{{ $userName->name}}</div>
                 <div class="menu">
                   @foreach ($pemdas as $pemda)
                      <div class="item" data-value="{{ $user->name }}">{{ $user->name }}</div>
                   @endforeach
                 </div>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" placeholder="Email" required>
              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
          </div>

          <button type="submit" class="ui fluid large teal submit button">
              {{ __('Edit') }}
          </button>
          <div class="ui error message"></div>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#register").addClass("active");
    });

    $('#search-select')
      .dropdown()
    ;

    $('.ui.form')
    .form({
      fields: {
        email: {
          identifier: 'email',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter an email'
            },
            {
              type   : 'email',
              prompt : 'Please enter a valid email'
            },
          ]
        },
      }
    });
</script>
@endsection
