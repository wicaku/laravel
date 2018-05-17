@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('admin.dashboard') }}"><i class="home icon"></i>Admin</a><span> / Pemda</span></h5></div>
      <div class="right floated column"><a href="{{ route('register')}}" class="small ui right floated green button"><i class="icon plus"></i>Tambah Dinas</a></div>
    </div>
  </div>

  <table class="ui celled table">
  <thead>
    <tr>
      <th>Nama Pemda</th>
      <th>Email Pemda</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
          <tr>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>
                <a href="{{ route('pemda.dinas', ['id'=> $user['_id']])}}" class='ui tiny icon green button' id='view-button'><i class="eye icon"></i></a>
                <a href="{{ route('edit.pemda', ['id' => $user['_id']])}}" class='ui tiny icon blue button' id='edit-button'><i class="edit icon"></i></a>
                <button class='ui tiny icon red button' type="submit"><i class="delete icon"></i></a>
            </td>
          </tr>
    @endforeach
  </tbody>
  </table>

</div>


@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $("#kategorisasi-admin").addClass("active");
    });
</script>
@endsection