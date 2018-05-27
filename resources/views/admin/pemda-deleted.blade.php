@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('pemda') }}"><i class="home icon"></i>Admin / Pemda</a><span> / Deleted </span></h5></div>
    </div>
  </div>

  <table id="deleted-pemda" class="ui celled table responsive nowrap">
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
                <a href="{{ route('pemda.deleted.restore', ['id'=> $user['idPemda']])}}" class='ui tiny icon green button' id='view-button'><i class="history icon"></i></a>
                <a href="{{ route('pemda.deleted.forceDelete', ['id'=> $user['idPemda']])}}" class='ui tiny icon red button' id='view-button'><i class="ban icon"></i></a>
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
        $('#deleted-pemda').DataTable();
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $("#kategorisasi-admin").addClass("active");
    });
</script>
@endsection
