<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EGOVBENCH - @yield('title')</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css" integrity="sha256-/Z28yXtfBv/6/alw+yZuODgTbKZm86IKbPE/5kjO/xY="
	 crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js" integrity="sha256-Bhi6GMQ/72uYZcJXCJ2LToOIcN3+Cx47AZnq/Bw1f7A="
	 crossorigin="anonymous"></script>
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
			<div class="right menu">
					<a class="item" href="{{ route('login') }}">Login</a>
					<a class="item" href="{{ route('register') }}">Register</a>
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
