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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <link href="/css/app.css" rel="stylesheet">
   <link href="/css/style.css" rel="stylesheet">
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
						{{ config('app.name', 'Laravel') }}
					</a>
				</div>
				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									{{Auth::user()->fullName()}} <span class="caret"></span>
								</a>
								<ul class="dropdown-menu multi-level" role="menu">
									@if (Auth::user()->isAdmin())
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#"><span class="caret-left"></span>Administration</a>
										  	<ul class="dropdown-menu">
													<li>
														<a href="{{url('professeurs')}}">Professeurs</a>
													</li>
													<li>
														<a href="{{url('classes')}}">Classes</a>
													</li>
													<li>
														<a href="{{url('categories')}}">Categories</a>
													</li>
													<li>
														<a href="{{url('activites')}}">Activités</a>
													</li>
													<li>
														<a href="{{url('activites_principales')}}">Activités obligatoires</a>
													</li>
												</ul>
											</li>
									@endif
									@if (Auth::user()->isTeacher())
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#"><span class="caret-left"></span>Mes classes</a>
										  	<ul class="dropdown-menu">
										  		@if(Auth::user()->teacherOf->count() > 0)
											  		@foreach (Auth::user()->teacherOf as $group)
											  			<li>
											  				<a href="{{ url('classes/'.$group->id) }}">@include('groups.partials.name')</a>
											  			</li>
											  		@endforeach
											  	@else
											  		<li><a href="#">Aucune classe assignée</a></li>
											  	@endif
										  	</ul>
										</li>
										<li>
											<a href="{{url('situation')}}">Situations</a>
										</li>
									@endif
									@if(Auth::user()->isStudent())
										<li>
											<a href="{{url('situation')}}">Situations @include('groups.partials.lock', ['group' => Auth::user()->group])</a>
										</li>
										@if(Auth::user()->isOpened())
											<li>
												<a href="{{url('situation/create')}}">Ajouter une situation</a>
											</li>
										@endif
										<li
										@cannot ('viewPDF', \Auth::user())
											class="disabled" onclick='return false;'
										@endcan
										>
											<a href="{{url('bilanPDF/'.Auth::id())}}">Bilan PDF</a>
										</li>
										<li
										@cannot('changerNumeroCandidat', Auth::user())
											class="disabled" onclick='return false;'
										@endcan
										>
											<a href="{{url('changerNumeroCandidat')}}">Mon numéro de candidat
											@cannot('changerNumeroCandidat', Auth::user())
												<i class="fa fa-lock"></i>
											@endcan
											@if (\Auth::user()->numeroCandidat == null)
												<i class="fa fa-warning"></i>
											@endif
											</a>
										</li>
										@endif
									@can('view', \App\Models\MacAddress::class)
									<li>
										<a href="{{url('macAddress')}}">
											@can('haveMany', \App\Models\MacAddress::class)
							          Mes addresses
							        @else
							          Mon adresse
							        @endcan
											MAC
										</a>
									</li>
									@endcan
									@can('view', \App\Models\Poll::class)
									<li>
										<a href="{{url('poll')}}">
											Mes voeux pour le deuxième semestre
										</a>
									</li>
									@endcan
									@endif
									<li class="divider"></li>
									<li>
										<a href="{{url('changerMdp')}}">Changer de mot de passe</a>
									</li>
									<li>
										<a href="{{ url('/logout') }}"
											onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
											Déconnexion
										</a>

										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
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
	<script
	src="https://code.jquery.com/jquery-3.1.1.min.js"
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{{-- <script src="/js/app.js"></script> --}}
	@yield('js')
</body>
</html>
