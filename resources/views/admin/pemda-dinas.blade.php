@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('pemda') }}"><i class="home icon"></i>Admin / Pemda</a> / {{$user->name}}</h5></div>
      <div class="right floated column"><button class="small ui right floated green button" id="tambah-button"><i class="icon plus"></i>Tambah Dinas</button></div>
    </div>
  </div>

  <table class="ui celled table">
  <thead>
    <tr>
      <th>Nama Dinas</th>
      <th>Deskripsi Dinas</th>
      <th>Keyword</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dinases as $dinas)
          <tr>
            <td>{{$dinas['nama_dinas']}}</td>
            <td>{{$dinas['deskripsi_dinas']}}</td>
            <td>{{$dinas['keyword']}}</td>
            <td>
              <form action="{{ route('pemda.delete.dinas', ['id' => $user->id, 'idDinas' => $dinas['_id']] )}}" method="post">
                {{ method_field('delete')}}
                {{ csrf_field() }}
                <a href="{{ route('pemda.edit.dinas', ['id' => $user->id, 'idDinas' => $dinas['_id']] )}}" class='ui tiny icon blue button' id='edit-button'><i class="edit icon"></i></a>
                <button class='ui tiny icon red button' type="submit"><i class="delete icon"></i></a>
              </form>
            </td>
          </tr>
    @endforeach
  </tbody>
  </table>

</div>

<div class="ui modal" id="tambah-modal">
  <i class="close icon"></i>
  <div class="header">
    Tambah Dinas
  </div>
  <div class="content">
    <form class="ui form" action="{{ route('pemda.tambah.dinas.store', ['id' => $user->id]) }}" method="post">
      <input name="id_pemda" type="hidden" value="{{$user->id}}">
      <div class="field">
        <label>Nama Dinas</label>
        <input name="nama_dinas" placeholder="Nama Dinas" type="text">
      </div>
      <div class="field">
        <label>Deskripsi Dinas</label>
        <textarea name="deskripsi_dinas" placeholder="Deskripsi Dinas"></textarea>
      </div>
      <div class="field">
        <label>Keyword</label>
        <input name="keyword_dinas" placeholder="Keyword Dinas" type="text">
      </div>

  </div>
  <div class="actions">
    <button type="button" class="ui button cancel">cancel</button>
    <button class="ui button submit ok" type="submit">submit</button>
    {{ csrf_field() }}
    </form>
  </div>
</div>


@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#kategorisasi-admin").addClass("active");
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });

    })
</script>
@endsection
