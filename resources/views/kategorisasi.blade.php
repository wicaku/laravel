@extends('master')

@section('body')
<div class="ui container">
  <div class="ui cards">
    <div class="card">
      <div class="content">
        <div class="header">
          {{ $pemda->name }}
        </div>
        <div class="description">
          <strong>Facebook</strong> : {{$pemda->facebook_resmi}} <br>
          <strong>Twitter</strong> : {{$pemda->twitter_resmi}} <br>
          <strong>Youtube</strong> : {{$pemda->youtube_resmi}} <br>
        </div>
      </div>

      <div class="extra content">
        <li><a href="{{ route('dinas', ['id' => Auth::user()->idPemda]) }}">Lihat Dinas</a>
        <li><a href="{{ route('user.sosmed.pemda.edit', ['id' => Auth::user()->idPemda]) }}">Edit Sosial Media</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#kategorisasi").addClass("active");
    });

</script>
@endsection
