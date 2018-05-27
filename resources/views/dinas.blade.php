@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      @auth('admin')
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('pemda') }}"><i class="home icon"></i>Admin / Pemda</a> / {{$user->name}}</h5></div>
      @else
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('kategorisasi', ['id' => $user->idPemda]) }}"><i class="home icon"></i>{{$pemda->name }}</a><span> / Dinas</span></h5></div>
      @endauth
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
              <form action="{{ route('delete.dinas', ['id' => $user->idPemda, 'idDinas' => $dinas['_id']] )}}" method="post">
                {{ method_field('delete')}}
                {{ csrf_field() }}
                <a href="{{ route('edit.dinas', ['id' => $user->idPemda, 'idDinas' => $dinas['_id']] )}}" class='ui tiny icon blue button' id='edit-button'><i class="edit icon"></i></a>
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
    <form class="ui form" action="{{ route('tambah.dinas.store', ['id' => $user->idPemda]) }}" method="post">
      <input name="id_pemda" type="hidden" value="{{$user->idPemda}}">
      <div class="field required">
        <label>Nama Dinas</label>
        <input name="nama_dinas" placeholder="Nama Dinas" type="text">
      </div>
      <div class="field required">
        <label>Deskripsi Dinas</label>
        <textarea name="deskripsi_dinas" placeholder="Deskripsi Dinas"></textarea>
      </div>
      <div class="field">
        <label>Keyword</label>
        <div class="ui tiny message">
          <p>Jika lebih dari satu kata, pisahkan dengan koma</p>
        </div>
        <input name="keyword_dinas" placeholder="Keyword Dinas" type="text">
      </div>
      <div class="ui error message"></div>

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
        $("#kategorisasi").addClass("active");
        $('.modal').modal({
    			onApprove : function() {
    			  //Submits the semantic ui form
    			  //And pass the handling responsibilities to the form handlers, e.g. on form validation success
    			  $('.ui.form').submit();
    			  //Return false as to not close modal dialog
    			  return false;
    			},
    		});
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });

        var tags = new TIB(document.querySelector('input[name="keyword_dinas"]'));
        var formValidationRules =
        {
        	nama_dinas: {
        	  identifier : 'nama_dinas',
        	  rules: [
        		{
        		  type   : 'empty',
        		  prompt : 'Masukkan nama dinas'
        		}
        	  ]
        	},
        	deskripsi_dinas: {
        	  identifier : 'deskripsi_dinas',
        	  rules: [
        		{
        		  type   : 'empty',
        		  prompt : 'Masukkan deksripsi dinas'
        		}
        	  ]
        	},
          keyword_dinas: {
        	  identifier : 'keyword_dinas',
        	  rules: [
        		{
        		  type   : 'empty',
        		  prompt : 'Masukkan keyword dinas'
        		}
        	  ]
        	},
        }

        var formSettings =
        {
        	onSuccess : function()
        	{
        	  //Hides modal on validation success
        	  $('.modal').modal('hide');
        	},
        }

        $('.ui.form').form(formValidationRules, formSettings);

    })
</script>
@endsection
