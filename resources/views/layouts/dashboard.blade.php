{{-- DA QUI TUTTO UGUALE AL LAYOUT PRINCIPALE --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Scripts -->
	@if (Route::currentRouteName() != 'sponsorship')
		<script src="{{ asset('js/app.js') }}" defer></script>
	@endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Styles: single page addendum -->
	@stack('dashboard_head')

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title') | Sound Art</title>
</head>
<body>
    <div id="app">
      
        @include('partials.header_dash')
     

        {{-- FINO A QUI TUTTO UGUALE AL LAYOUT PRINCIPALE --}}

		@php
			$my_user 	= Auth::user();
			$my_profile = Auth::user()->profile;
		@endphp

        {{-- JUMBOTRON DASHBOARD --}}
        @include('partials.jumbo_dashboard')

        {{-- DA CANCELLARE E RIPRENDERE VECCHIO STILE SE NON PIACE --}}

        {{-- PROVA NAVBAR SOTTO AL JUMBO AL POSTO DELLA NAV A SX --}}
        <div class="bar_under_jumbo container-fluid dashboard_nav">
            <div class="container">
                <nav class="nav flex-column flex-md-row to_page_link">
                    {{-- VALUTARE SE USARE O TOGLIERE BORDO PER ROTTA ATTIVA --}}
                    {{-- @if (request()->is('admin/dashboard')) --}}
                    <a class="dashboard_nav_link" href="{{ route('dashboard') }}">Dashboard</a>

                    {{-- LINK MY PROFILE RIMOSSO -> MY PROFILE INSERITO IN DASHBOARD --}}
                    {{-- @if ($my_profile)
                        <a class="dashboard_nav_link" href="{{ route('admin.profiles.show', $my_profile->slug) }}">My Profile</a>   
                    @else
                        <a class="btn btn-primary my-color btn_create" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
                    @endif --}}
                    <a class="dashboard_nav_link" href="{{ route('admin.messages.index') }}">Messages</a>
                    <a class="dashboard_nav_link" href="{{ route('admin.reviews.index') }}">Reviews</a>
                    <a class="dashboard_nav_link" href="{{-- route('admin.statistics') --}}">Statistics</a>  
                    
                </nav>
            </div>
        </div>
            
        <div class="container">
            <div class="row">
                <main role="main" class="dashboard_main col-12">
                    @yield('content')
                </main>
            </div>
        </div>

		@include('partials.footer_search')
    </div>
</body>
</html>
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
