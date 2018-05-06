@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('kategorisasi', ['id' => Auth::user()->_id]) }}"><i class="home icon"></i>{{Auth::User()->name }}</a><span> / Dinas</span></h5></div>
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
    @foreach ($dinas->dinas as $dinasArray)
    <tr>
      <td>{{$dinasArray['nama_dinas']}}</td>
      <td>{{$dinasArray['deskripsi_dinas']}}</td>
      <td>{{$dinasArray['keyword']}}</td>
      <td>
        <button class="ui tiny icon blue button" id="edit-button">
          <i class="edit icon"></i>
        </button>
        <button class="ui tiny icon red button">
          <i class="delete icon"></i>
        </button>
      </td>
    </tr>
    @endforeach
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
    <form class="ui form" action="{{ route('tambah.dinas', ['id' => Auth::user()->_id]) }}" method="post">
      <input name="id_pemda" type="hidden" value="{{Auth::user()->_id}}">
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
    <button class="ui button cancel">cancel</button>
    <button class="ui button submit ok" type="submit">submit</button>
    {{ csrf_field() }}
    </form>
  </div>
</div>

<div class="ui modal" id="edit-modal">
  <i class="close icon"></i>
  <div class="header">
    Edit Dinas
  </div>
  <div class="content">
    <form class="ui form" action="{{ route('tambah.dinas', ['id' => Auth::user()->_id]) }}" method="post">
      <input name="nama_dinas" type="hidden" value="{{Auth::user()->_id}}">
      <div class="field">
        <label>Nama Dinas</label>
        @foreach ($dinases as $dinas)
          @foreach ($dinas->dinas as $dinasArray)
              <input name="nama_dinas" placeholder="Nama Dinas" type="text" value="{{$dinasArray['nama_dinas']}}">
      </input>
      </div>
      <div class="field">
        <label>Deskripsi Dinas</label>
            <textarea name="deskripsi_dinas" placeholder="Deskripsi Dinas" value="{{$dinasArray['deskripsi_dinas']}}"></textarea>
          @endforeach
      @endforeach
      </div>
      <div class="field">
        <label>Keyword</label>
        <input name="keyword_dinas" placeholder="Keyword Dinas" type="text">
      </div>

  </div>
  <div class="actions">
    <button class="ui button cancel">cancel</button>
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
        $("#kategorisasi").addClass("active");
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $('#edit-button').click(function(){
          $('#edit-modal').modal('show');
        });
    });
</script>
@endsection
