@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      @auth('admin')
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('pemda') }}"><i class="home icon"></i>Admin / Pemda</a> / {{$pemda->name}}</h5><span> / Rekomendasi Keyword </span></div>
      @else
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('kategorisasi', ['id' => $user->idPemda]) }}"><i class="home icon"></i>{{$pemda->name }}</a><span> / Rekomendasi Keyword</span></h5></div>
      @endauth
    </div>
  </div>

  <table id="dinas" class="ui celled table responsive nowrap">
  <thead>
    <tr>
      <th>Nama Dinas</th>
      <th>Keyword</th>
      <th>Rekomendasi Keyword</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dinases as $dinas)
          <tr>
            <td>{{$dinas['nama_dinas']}}</td>
            <td>{{$dinas['keyword']}}</td>
            <td>{{$dinas['rekomendasi']}}</td>
            <td>
              <a href="{{ route('rekomendasi.tambah', ['id' => $user->idPemda, 'idDinas' => $dinas['_id']] )}}" class='ui tiny icon blue button' id='edit-button'>Tambah Rekomendasi</a>
              <a href="{{ route('rekomendasi.hapus', ['id' => $user->idPemda, 'idDinas' => $dinas['_id']] )}}" class='ui tiny icon red button' id='edit-button'>Hapus Rekomendasi</a>
              </form>
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
        $('#dinas').DataTable();
        $("#kategorisasi").addClass("active");

    })
</script>
@endsection
