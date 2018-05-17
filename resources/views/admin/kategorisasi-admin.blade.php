@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui cards">
    <div class="card">
      <div class="content">
        <div class="header">
          Admin
        </div>
      </div>
      <div class="extra content">
        <a href="{{ route('pemda') }}">Lihat Pemda</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#kategorisasi-admin").addClass("active");
    });

</script>
@endsection
