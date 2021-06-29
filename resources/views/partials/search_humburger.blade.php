
<header class="header-home q-540-blue">
	<div class="container">
		<nav class="navbar">
			<a id="logo-link" class="navbar-brand" href="{{ url('/') }}">
				<img id="logo" src="{{ asset('img/logo_small.svg') }}" alt="Sound Art logo">
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