<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
   <link href="/css/app.css" rel="stylesheet">
	@yield('css')

	<!-- Scripts -->
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
	</script>
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Laravel') }} - {{ \App\Models\Year::current()->short_name }}
					</a>
				</div>
				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Connexion</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									{{Auth::user()->fullName()}} <span class="caret"></span>
								</a>
								<ul class="dropdown-menu multi-level" role="menu">
									@if (Auth::user()->isAdmin())
										@include('layouts.partials.admin')
									@endif
									@if (Auth::user()->isTeacher())
										@include('layouts.partials.teacher')
									@endif
									@if(Auth::user()->isStudent())
										@include('layouts.partials.student')
									@endif
									<li class="divider"></li>
									@include('layouts.partials.common')
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@if(Session::has('error'))
						<div class="alert alert-danger">{{Session::get('error')}}</div>
					@endif
					@if(Session::has('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="/js/app.js"></script>
	@yield('js')
</body>
</html>
