
<header class="header-home q-540-black">
	<div class="container">
		<nav class="navbar">
			<a id="logo-link" class="navbar-brand" href="{{ url('/') }}">
				<img id="logo" src="{{ asset('img/logo_small.png') }}" alt="Sound Art logo">
			</a>
			<ul class="humburger">
				<li class="humburger-item">
					<button v-on:click="showHumburger" class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-bars"></i></button>
					<div v-if="humburger" class="nav-actions">
						<ul>
							<li>
								<a role="button" href="{{ route('search') }}">Explore</a>
							</li>
							@guest
							<li>
								<a role="button" href="{{ route('login') }}">{{ __('Login') }}</a>
							</li>
							<li>
								<a role="button" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
							@else
							<li>
								<a role="button" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
							</li>
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST">
									@csrf
								</form>
							</li>
							@endguest
						</ul>
					</div>
				</li>
			</ul>
		</nav>
	</div>
</header>
      		{{-- <ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('search') }}">Explore</a>
			</li>  
			@guest
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
			</li>					
			@endguest
      		</ul>
			<ul class="navbar-nav ml-auto">
			<!-- Authentication Links -->
			@guest
				<li class="nav-item">
					<a class="btn btn-outline-light" :class="{change_color_btn: scrollPosition > scrollChange}" role="button" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
				@if (Route::has('register'))
					<li class="nav-item">
						<a class="btn btn-outline-light" :class="{change_color_btn: scrollPosition > scrollChange}" role="button" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
				@endif
			@else
				<li class="nav-item dropdown">
					<a id="navbarDropdown btn btn-outline-light" :class="{change_color_btn: scrollPosition > scrollChange}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{ Auth::user()->name }}
					</a>
	
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
	
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</li>
			@endguest
			</ul>
		  </nav>
	</div> --}}

	{{-- HRADER NAVBAR START originale laravel --}}
	{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto">

				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }}
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav> --}}
	{{-- HRADER NAVBAR END --}}




	{{-- <div style="display: flex; justify-content: space-around;">
		<p style="color: red; font-size: 4em;">Sono l'header</p>
	
		<h2>Logo dell'header</h2>
	
		<ul>
			<li>Lista pagine del sito</li>
			<li>Seconda pagina</li>
			<li>terza pagina</li>
		</ul>
	</div> --}}
	
</header>