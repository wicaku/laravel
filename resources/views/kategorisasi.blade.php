@extends('master')

@section('body')
<div class="ui container">
  <div class="ui cards">
    <div class="card">
      <div class="content">
        <div class="header">
          {{ Auth::user()->name }}
        </div>
      </div>
      <div class="extra content">
        <a href="{{ route('dinas', ['id' => Auth::user()->_id]) }}">Lihat Dinas</a>
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
