@extends('master-admin')
@section('title')
Edit Dinas
@endsection
@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Edit Dinas') }}
      </div>
    </h2>
    <form class="ui form" action="{{ route('pemda.update.dinas', ['id' => $user->id]) }}" method="post">
      @csrf
      <div class="ui left stacked segment">
        <input type="hidden" name="id_pemda" value="{{$user->id}}"></input>
        @foreach ($dinases as $dinas)
        <input type="hidden" name="id_dinas" value="{{$dinas->_id}}"></input>
        <div class="field">
          <label class="ui text container left aligned left aligned grid">Nama Dinas</label>
          <input name="nama_dinas" type="text" value="{{$dinas->nama_dinas}}">
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Deskripsi Dinas</label>
          <textarea name="deskripsi_dinas" placeholder="Masukkan Deskripsi Untuk Dinas">{{$dinas->deskripsi_dinas}}</textarea>
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Keyword</label>
          <input name="keyword_dinas" placeholder="Masukkan satu keyword untuk dinas" type="text" value="{{$dinas->keyword}}">
        </div>
        @endforeach
        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Edit Dinas') }}
        </button>
        {{ csrf_field() }}
        <div class="ui error message"></div>
      </div>
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
