@extends('master')

@section('body')
<div class="ui container">
  <div class="ui message">
    <div class="header">
      Terima Kasih telah mendaftar!
    </div>
    <p>Untuk memastikan keaslian akun pemerintah daerah, kami membutuhkan waktu untuk melakukan verifikasi berkas.</p>
    <p>Mohon tunggu pemberitahuan lebih lanjut melalui email.</p>
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
