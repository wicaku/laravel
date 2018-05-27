@extends('master')
@section('title')
Edit Sosial Media Pemda
@endsection
@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('kategorisasi', ['id' => $pemda->_id]) }}"><i class="home icon"></i>{{ $pemda->name}}</a><span> / Edit Sosial Media</span></h5></div>
    </div>
  </div>

  <div class="ui text container middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui teal image header">
        <div class="content">
          {{ __('Edit Sosial Media Pemda') }}
        </div>
      </h2>
      <form class="ui large form"method="POST" action="{{ route('user.sosmed.pemda.update', ['id'=> $pemda->_id]) }}">
        @csrf
        <div class="ui left stacked segment">

          <div class="field">
            <label style="text-align:left">Nama Pemda</label>
              <div class="ui input disabled">
                <input name="name" value="{{ $pemda->name }}">
              </div>
          </div>

          <div class="field">
            <label style="text-align:left">Facebook Resmi</label>
            <input name="facebook_resmi" value="{{ $pemda->facebook_resmi }}" placeholder="Username Facebook Resmi">
          </div>

          <div class="field">
            <label style="text-align:left">Twitter Resmi</label>
            <input name="twitter_resmi" value="{{ $pemda->twitter_resmi }}" placeholder="Username Twitter Resmi">
          </div>


          <div class="field">
            <label style="text-align:left">Youtube Resmi</label>
            <input name="youtube_resmi" value="{{ $pemda->youtube_resmi }}" placeholder="ID Channel Youtube Resmi">
          </div>
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Edit') }}
        </button>
        <div class="ui error message"></div>

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
