@extends('master-admin')
@section('title')
Edit Dinas
@endsection
@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Edit Dinas') }}
      </div>
    </h2>
    <form class="ui form" action="{{ route('pemda.update.dinas', ['id' => $user->idPemda]) }}" method="post">
      @csrf
      <div class="ui left stacked segment">
        <input type="hidden" name="id_pemda" value="{{$user->idPemda}}"></input>
        @foreach ($dinases as $dinas)
        <input type="hidden" name="id_dinas" value="{{$dinas->_id}}"></input>
        <div class="field">
          <label class="ui text container left aligned left aligned grid">Nama Dinas</label>
          <input name="nama_dinas" type="text" value="{{$dinas->nama_dinas}}">
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Deskripsi Dinas</label>
          <textarea name="deskripsi_dinas" placeholder="Masukkan Deskripsi Untuk Dinas">{{$dinas->deskripsi_dinas}}</textarea>
        </div>

        <div class="field">
          <label class="ui text container left aligned left aligned grid">Keyword</label>
          <input name="keyword_dinas" placeholder="Masukkan satu keyword untuk dinas" type="text" value="{{$dinas->keyword}}">
        </div>
        @endforeach
        <div class="ui error message"></div>
        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Edit Dinas') }}
        </button>
        {{ csrf_field() }}

      </div>
    </form>
  </div>
</div>

@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#register").addClass("active");
    });

    $('#search-select')
      .dropdown()
    ;
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
</script>
@endsection
