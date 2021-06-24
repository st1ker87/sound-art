{{------------------------------------------------------------------
	LAYOUT DASHBOARD
	contiene 
		in <head> (originale di laravel) 
			CSRF Token: ci serve?
			puntamento a app.css e app.js: NON ELIMINARE!
			Fonts: modificare
		in <body> 
			scatola Vue.js: NON ELIMINARE!

	in seguito si può differenziare per guest/admin

	DEFINITO QUI:
			$my_user 	= Auth::user();
			$my_profile = Auth::user()->profile;


------------------------------------------------------------------}}

{{-- DA QUI TUTTO UGUALE AL LAYOUT PRINCIPALE --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
	@if (Request::is('admin/sponsorship/*'))
		{{-- conflitto vuejs nel form di braintree! --}}
	@else
		<script src="{{ asset('js/app.js') }}" defer></script>	
	@endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Styles: single page addendum -->
	@stack('dashboard_head')

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title') | Sound Art</title>
</head>
<body>
    <div id="app">
        @include('partials.header_search')

        {{-- FINO A QUI TUTTO UGUALE AL LAYOUT PRINCIPALE --}}

		@php
			$my_user 	= Auth::user();
			$my_profile = Auth::user()->profile;
		@endphp

        {{-- JUMBOTRON DASHBOARD --}}
        <div class="jumbo-dash container-fluid">
            <div class="row">
                <div class="over-jumbo d-block d-xl-none"></div>
                <div class="container">
                    
                    
                    <div class="title-dash">
                        <h1>{{ Auth::user()->name }} {{ Auth::user()->surname }}</h1>
                        <h3>
                            @foreach (Auth::user()->categories as $category)
                                @if($loop->last)
                                    {{$category->name}}
                                    @else
                                    {{$category->name . ' |'}}
                                @endif
                            @endforeach
                        </h3>
                        @if ($my_profile)
                            <p>{{ $my_profile->work_town }}</p>  
                        @endif
                    </div>


                </div>
            </div>
        </div>

        {{-- DA CANCELLARE E RIPRENDERE VECCHIO STILE SE NON PIACE --}}

        {{-- PROVA NAVBAR SOTTO AL JUMBO AL POSTO DELLA NAV A SX --}}
        <div class="bar_under_jumbo container-fluid dashboard_nav">
            <div class="container">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    {{-- VALUTARE SE USARE O TOGLIERE BORDO PER ROTTA ATTIVA --}}
                    {{-- @if (request()->is('admin/dashboard')) --}}
                    <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    {{-- @else
                    <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif --}}

                    @if ($my_profile)
                    <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.profiles.show', $my_profile->slug) }}">My Profile</a>
                    @endif
                    <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.messages.index') }}">Messages</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.reviews.index') }}">Reviews</a>
                </nav>
            </div>
        </div>
            
        <div class="container">
            <div class="row">

                {{-- DA QUI NAVBAR COMUNE A SX --}}
                {{-- <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('dashboard') }}">
                                    <div class="row">
                                        <i class="fas fa-house-user col-lg-12 col-xl-3"></i>
                                        Dashboard

                                    </div>
                                </a>
                            </li>
                            @if ($my_profile)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.profiles.show', $my_profile->slug) }}">
                                    <div class="row">
                                        <i class="fas fa-id-card col-lg-12 col-xl-3"></i>
                                        Profile
                                    </div>
                                </a>
                            </li> 
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.messages.index') }}">
                                    <div class="row">
                                        <i class="fas fa-inbox col-lg-12 col-xl-3"></i>
                                        Messages

                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                                    <div class="row">
                                        <i class="fab fa-font-awesome-flag col-lg-12 col-xl-3"></i>
                                        Reviews

                                    </div>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <div class="row">
                                        <i class="fas fa-chart-line col-lg-12 col-xl-3"></i>
                                        Statistics                             
                                    </div>
                                </a>
                            </li> 
                        </ul>

                    </div>
                </nav> --}}
                
                {{-- FINO A QUI NAVBAR COMUNE A SX --}}



                <main role="main" class="dashboard_main col-12">
                    @yield('content')
                </main>
            </div>
        </div>

		@include('partials.footer_home')
    </div>
</body>
</html>
