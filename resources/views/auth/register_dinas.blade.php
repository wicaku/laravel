@extends('master-login-register')
@section('title')
Register
@endsection
@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Register Dinas') }}
      </div>
    </h2>
    <div class="ui info message">
      <i class="close icon"></i>
      <div>
        Masukkan nama dinas untuk pemerintah kota dan keyword yang terkait.
      </div>
    </div>
    <form class="ui form" action="{{ route('tambah.dinas.store', ['id' => Auth::user()->_id]) }}" method="post">
      @csrf
      <div class="ui left stacked segment">
        <input type="hidden" name="id_pemda" value="{{Auth::user()->_id}}"></input>
        <div class="field">
          <label class="ui text container left aligned left aligned grid">Nama Dinas</label>
          <input name="nama_dinas" placeholder="Masukkan Nama Dinas Tanpa Singkatan" type="text">
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Deskripsi Dinas</label>
          <textarea name="deskripsi_dinas" placeholder="Masukkan Deskripsi Untuk Dinas"></textarea>
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Keyword</label>
          <input name="keyword_dinas" placeholder="Masukkan satu keyword untuk dinas" type="text">
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Register Dinas') }}
        </button>
        <div class="ui error message"></div>
      </div
    </form>
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
        name: {
          identifier: 'name',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter your name'
            }
          ]
        },
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
        password: {
          identifier: 'password',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter a password'
            },
            {
              type   : 'minLength[6]',
              prompt : 'Your password must be at least {ruleValue} characters'
            }
          ]
        },
        password_confirmation: {
          identifier: 'password_confirmation',
          rules: [
            {
              type   : 'empty',
              prompt : 'Please enter a password'
            },
            {
              type   : 'minLength[6]',
              prompt : 'Your password must be at least {ruleValue} characters'
            },
            {
              type   : 'match[password]',
              prompt : 'Your password is not match'
            },
          ]
        },
      }
    });
</script>
@endsection
