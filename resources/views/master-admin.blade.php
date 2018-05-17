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
			<a id="kategorisasi-admin" class="item" href="{{ url('/kategorisasi-admin') }}">Kategorisasi Admin</a>
			<div class="right menu">
					<!-- <a class="item" id="login" href="{{ route('login') }}">Login</a>
					<a class="item" id="register" href="{{ route('register') }}">Register</a> -->
					<!-- Authentication Links -->

					<div id="dropd" class="ui dropdown item" tabindex="0">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->email }} <span class="caret"></span>
							</a>
							<i class="dropdown icon"></i>
							<div class="menu transition hidden" tabindex="-1">
									<a class="item" href="{{ route('admin.logout') }}"
										 onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
											@csrf
									</form>
							</div>
					</div>
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
