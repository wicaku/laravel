@extends('master-admin')
@section('title')
Register
@endsection
@section('body')
<div class="ui text container middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        {{ __('Register') }}
      </div>
    </h2>
    <form class="ui large form"method="POST" action="{{ route('admin.register.pemda.register') }}" enctype="multipart/form-data">
      @csrf
      <div class="ui left stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <div class="ui fluid search dropdown selection">
               <input name="idPemda" type="hidden">
              <div class="default text">Masukkan Nama Pemerintah Daerah</div>
               <i class="dropdown icon"></i>
               <div class="menu">
                 @foreach ($datas as $data)
                    <div class="item" data-value="{{ $data->_id }}">{{ $data->name }}</div>
                 @endforeach
               </div>
            </div>
          </div>
          @if ($errors->has('idPemda'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('idPemda') }}</strong>
              </span>
          @endif
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
          </div>
        </div>

        <div class="field">
          <label style="text-align: left">Upload Surat Tugas</label>
          <div class="ui center icon input">
            <input type="file" name="file">
          </div>
          @if ($errors->has('file'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('file') }}</strong>
              </span>
          @endif
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="address card icon"></i>
            <input id="nama-pegawai" name="nama-pegawai" class="form-control{{ $errors->has('nama-pegawai') ? ' is-invalid' : '' }}" name="nama-pegawai" value="{{ old('nama-pegawai') }}" placeholder="Nama Pegawai" required>
          </div>
          @if ($errors->has('nama-pegawai'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('nama-pegawai') }}</strong>
              </span>
          @endif
        </div>

        <button type="submit" class="ui fluid large teal submit button">
            {{ __('Register') }}
        </button>
        <div class="ui error message"></div>
      </div>



    </form>

    <div class="ui message">
      Sudah Mendaftar? <a href="{{ route('login') }}">Login</a>
    </div>
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
</script>
@endsection
