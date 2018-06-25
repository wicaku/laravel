@extends('master')
@section('title')
Error
@endsection
@section('body')
<div class="ui container">
	<div class="ui message">
  <div class="header">
    Halaman yang anda minta tidak tersedia
  </div>
  <p>Kami sedang memperbaiki halaman ini :)</p>
</div>

</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        
    });

</script>
@endsection
