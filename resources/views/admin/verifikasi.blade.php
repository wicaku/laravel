@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui container">
    <div class="ui grid">
      <div class="two column row">
        <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('admin.dashboard') }}"><i class="home icon"></i>Admin</a><span> / Verifikasi Pemda</span></h5></div>
      </div>
    </div>

    <table class="ui celled table">
    <thead>
      <tr>
        <th>Email Pemda</th>
        <th>Nama Pegawai</th>
        <th>Surat Tugas</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
            <tr>
              <td>{{$user['email']}}</td>
              <td>{{$user['nama-pegawai']}}</td>
              <td><a href="{{ Storage::url($user->file) }}"> Download </a></td>
              <td>
                <a href="{{ route('admin.verifikasi.verified', ['id' => $user->idPemda] )}}" class='ui tiny icon green button' id='view-button'><i class="check icon"></i></a>
                <a href="{{ route('admin.verifikasi.rejected', ['id' => $user->idPemda] )}}" class='ui tiny icon red button' id='edit-button'><i class="delete icon"></i></a>
              </td>
            </tr>
      @endforeach
    </tbody>
    </table>

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
