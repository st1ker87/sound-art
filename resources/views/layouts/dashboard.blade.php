{{-- DA QUI TUTTO UGUALE AL LAYOUT PRINCIPALE --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- PER GRAFICI --}}
    

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
	@if ((Route::currentRouteName() != 'sponsorship') && (Route::currentRouteName() != 'statistics'))
		<script src="{{ asset('js/app.js') }}" defer></script>
	@endif
    @if (Route::currentRouteName() == 'statistics')
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
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

            use App\Classes\IsNowInInterval;

            $my_user		= Auth::user();
            $my_profile		= $my_user->profile;
            $my_contracts	= $my_user->contracts;
            $is_any_contract = (!$my_contracts->isEmpty());
            $is_active_sponsorship = false;
            foreach ($my_contracts as $my_contract) {
                if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) {
                    $is_active_sponsorship = true;
                }
            }

        @endphp

        {{-- JUMBOTRON DASHBOARD --}}
        @include('partials.jumbo_dashboard')

            {{-- navbar nascosta dentro hamburger --}}
            <div class="pos-f-t">
                <nav class="navbar navbar-light col-12 col-sm-12 d-md-none bg-light">
                    <div class="container">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </nav>
                <div class="collapse d-md-none" id="navbarToggleExternalContent">
                    <div class="bar_under_jumbo container-fluid dashboard_nav">
                        <div class="container">
                            <nav class="nav flex-column to_page_link">
                                {{-- VALUTARE SE USARE O TOGLIERE BORDO PER ROTTA ATTIVA --}}
                                <div class="link_box nav flex-column">
                                    <a class="dashboard_nav_link" href="{{ route('dashboard') }}">Dashboard</a>
                                    <a class="dashboard_nav_link" href="{{ route('admin.messages.index') }}">Messages</a>
                                    <a class="dashboard_nav_link" href="{{ route('admin.reviews.index') }}">Reviews</a>
                                    <a class="dashboard_nav_link" href="{{route('statistics')}}">Statistics</a>  
                                    @if ($is_any_contract)
                                        {{-- CHECK YOUR SPONSORSHIPS --}}
                                        <a class="dashboard_nav_link" href="{{ route('my_sponsorships') }}">Sponsorships</a>	
                                    @endif	
                                </div>

                                
                                {{-- NUOVA PARTE BOTTONI A DESTRA --}}
                                @if ($my_profile)
                                    {{-- EDIT PROFILE BUTTON --}}
                                    <a type="button" class="btn btn-primary my-color" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit Profile</a>
                                
                                    {{-- MODAL BUTTON -------------------------------------------------------------}}
                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Delete Profile</button>
                                    {{----------------------------------------------------------------------------}}
                                @else
                                    {{-- CREATE PROFILE BUTTON --}}
                                    <a class="btn btn-primary my-color" href="{{ route('admin.profiles.create') }}">Create Profile</a>
                                @endif
                                @if (!$is_active_sponsorship && $my_profile)
                                    {{-- SPONSOR YOUR PROFILE --}}
                                    <a class="btn btn-sponsor" href="{{ route('admin.sponsorships.index') }}">Sponsor Profile</a>
                                @endif
                                
                                
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fine navbar nascosta nell'hamburger --}}


        {{-- PROVA NAVBAR SOTTO AL JUMBO AL POSTO DELLA NAV A SX --}}
        <div class="bar_under_jumbo d-none d-md-block container-fluid dashboard_nav">
            <div class="container">
                <nav class="nav flex-column {{-- justify-content-between --}} flex-md-row to_page_link">
                    {{-- VALUTARE SE USARE O TOGLIERE BORDO PER ROTTA ATTIVA --}}
                    <div class="link_box nav flex-column flex-sm-column flex-md-row">
                        <a class="dashboard_nav_link" href="{{ route('dashboard') }}">Dashboard</a>
                        
                        {{-- LINK MY PROFILE RIMOSSO -> MY PROFILE INSERITO IN DASHBOARD --}}
                        {{-- @if ($my_profile)
                            <a class="dashboard_nav_link" href="{{ route('admin.profiles.show', $my_profile->slug) }}">My Profile</a>   
                            @else
                            <a class="btn btn-primary my-color btn_create" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
                            @endif --}}
                        <a class="dashboard_nav_link" href="{{ route('admin.messages.index') }}">Messages</a>
                        <a class="dashboard_nav_link" href="{{ route('admin.reviews.index') }}">Reviews</a>
                        <a class="dashboard_nav_link" href="{{route('statistics')}}">Statistics</a> 
                        <a class="dashboard_nav_link" href="{{ route('my_sponsorships') }}">Sponsorships</a>	
                    </div>
                        
                        
                    {{-- @if (request()->is('admin/dashboard')) --}}
                        {{-- NUOVA PARTE BOTTONI A DESTRA --}}
                        <div class="btn_box nav flex-column flex-sm-column flex-md-row md-block">
                            @if ($my_profile)
                                {{-- EDIT PROFILE BUTTON --}}
                                <a type="button" class="btn btn-primary my-color" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit Profile</a>
                                {{-- DELETE PROFILE BUTTON --}}
                                {{-- ORIGINAL BUTTON ----------------------------------------------------------}}
                                {{-- <form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
                                </form> --}}
                                {{-- MODAL BUTTON -------------------------------------------------------------}}
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Delete Profile</button>
                                {{----------------------------------------------------------------------------}}
                            @else
                                {{-- CREATE PROFILE BUTTON --}}
                                <a class="btn btn-primary my-color" href="{{ route('admin.profiles.create') }}">Create Profile</a>
                            @endif
                            @if (!$is_active_sponsorship && $my_profile)
                                {{-- SPONSOR YOUR PROFILE --}}
                                <a class="btn btn-sponsor" href="{{ route('admin.sponsorships.index') }}">Sponsor Profile</a>
                            @endif
                            {{-- @if ($is_any_contract)
                                {{-------- CHECK YOUR SPONSORSHIPS ------------
                                <a class="btn btn-primary my-color" href="{{ route('my_sponsorships') }}">Check Sponsorships</a>	
                            @endif --}}
                        </div>
                    {{-- @endif --}}
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
