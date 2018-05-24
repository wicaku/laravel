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
        <th>Surat Tugas</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
            <tr>
              <td>{{$user['email']}}</td>
              <td><a href="{{ Storage::url($user->file) }}"> Download </a></td>
              <td>
                  <form>
                  {{ method_field('delete')}}
                  {{ csrf_field() }}
                  <a href="" class='ui tiny icon green button' id='view-button'><i class="eye icon"></i></a>
                  <a href="" class='ui tiny icon blue button' id='edit-button'><i class="edit icon"></i></a>
                  <button class='ui tiny icon red button' type="submit"><i class="delete icon"></i></a>
                  </form>
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
