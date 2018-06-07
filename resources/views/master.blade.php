<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EGOVBENCH - @yield('title')</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css" integrity="sha256-/Z28yXtfBv/6/alw+yZuODgTbKZm86IKbPE/5kjO/xY="
	 crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="jquery.tagsinput.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js" integrity="sha256-Bhi6GMQ/72uYZcJXCJ2LToOIcN3+Cx47AZnq/Bw1f7A="
	 crossorigin="anonymous"></script>

	 <link href="{{ asset('/css/tags-input-beautifier.css')}}" rel="stylesheet">
	 <script src="{{ asset('js/tags-input-beautifier.js')}}"></script>

	 <script src="https://code.highcharts.com/highcharts.js"></script>

	 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.semanticui.min.css"/>
	 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.semanticui.min.css"/>

	 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	 <script src="https://cdn.datatables.net/1.10.16/js/dataTables.semanticui.min.js"></script>
	 <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
	 <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.semanticui.min.js"></script>

	 @yield('head')
</head>

<body>
	<div class="ui stackable borderless menu">
		<div class="ui container">
			<a id="home" class="item" href="{{ url('/') }}">Beranda</a>
			<a id="about" class="item" href="{{ url('/tentang') }}">About</a>
			<div id="dropd" class="ui dropdown item" tabindex="0">
				Peringkat
				<i class="dropdown icon"></i>
				<div class="menu transition hidden" tabindex="-1">
					<a id="web" class="item" href="{{ url('/peringkat/website') }}">Website </a>
					<a id="socmed" class="item" href="{{ url('/peringkat/sosial-media') }}">Sosial Media</a>
					<a id="vuln" class="item" href="{{ url('/peringkat/kerentanan') }}">Kerentanan</a>
					<a id="engagement" class="item" href="{{ route('peringkat.engagement') }}">Engagement Score</a>

				</div>
			</div>
			<div id="data" class="ui dropdown item" tabindex="0">
				Data
				<i class="dropdown icon"></i>
				<div class="menu transition hidden" tabindex="-1">
					<a id="dataweb" class="item" href="{{ url('/data/website') }}">Website</a>
					<a id="datasocmed" class="item" href="{{ url('/data/sosial-media') }}">Sosial Media</a>
					<a id="datavuln" class="item" href="{{ url('/data/kerentanan') }}">Kerentanan</a>
				</div>
			</div>
			<div id="dropd" class="ui dropdown item" tabindex="0">
				Metodologi
				<i class="dropdown icon"></i>
				<div class="menu transition hidden" tabindex="-1">
					<a id="meta1" class="item" href="{{ url('/metodologi/1') }}">EGOV Benchmark V1.0</a>
					<a id="meta2" class="item" href="{{ url('/metodologi/2') }}">EGOV Benchmark V2.0</a>
					<a id="meta3" class="item" href="{{ url('/metodologi/3') }}">EGOV Benchmark V3.0</a>
				</div>
			</div>
			<div id="komentar" class="ui dropdown item" tabindex="0">
				Komentar
				<i class="dropdown icon"></i>
				<div class="menu transition hidden" tabindex="-1">

					@guest
						<a id="kategorisasi" class="item" href="{{ route('kategorisasi.not.login') }}">Klasifikasi</a>
						<a id="kategorisasi" class="item" href="{{ route('kategorisasi.not.login') }}">Kategorisasi</a>
					@else
						@if (Auth::user()->verified)
							<a id="klasifikasiKomentar" class="item" href="{{ route('klasifikasi.komentar', ['id' => Auth::user()->idPemda]) }}">Klasifikasi</a>
							<a id="kategorisasi" class="item" href="{{ route('kategorisasi', ['id' => Auth::user()->idPemda] ) }}">Kategorisasi</a>
						@else
							<a id="kategorisasi" class="item" href="{{ route('validasi.pemda') }}">Klasifikasi</a>
							<a id="kategorisasi" class="item" href="{{ route('validasi.pemda') }}">Kategorisasi</a>
						@endif
					@endguest
				</div>
			</div>

			<div class="right menu">
					<!-- <a class="item" id="login" href="{{ route('login') }}">Login</a>
					<a class="item" id="register" href="{{ route('register') }}">Register</a> -->
					<!-- Authentication Links -->
					@guest
              <a class="item" href="{{ route('login') }}">{{ __('Login') }}</a>
              <a class="item" href="{{ route('register') }}">{{ __('Register') }}</a>
          @else
					<div id="dropd" class="ui dropdown item" tabindex="0">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->email }} <span class="caret"></span>
							</a>
							<i class="dropdown icon"></i>
							<div class="menu transition hidden" tabindex="-1">
									<a class="item" href="{{ route('user.logout') }}"
										 onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
											@csrf
									</form>
							</div>
					</div>
          @endguest
			</div>
		</div>
	</div>
	@yield('body')
	<div class="ui footer segment">
		<div class="ui center aligned container">
			<p>E-Gov Benchmark Departemen Sistem Informasi @php
				echo date('Y');
			@endphp</p>
		</div>
	</div>
</body>
@yield('script')

</html>
