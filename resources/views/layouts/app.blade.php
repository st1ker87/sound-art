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
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Styles: single page addendum -->
	@stack('app_head')

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title') | Sound Art</title>
</head>
<body>
    <div id="app">
		@yield('header')

        @yield('content')

		@yield('footer')
    </div>
</body>
</html>
{{------------------------------------------------------------------
	LAYOUT PRINCIPALE
	contiene 
		in <head> (originale di laravel) 
			CSRF Token: ci serve?
			puntamento a app.css e app.js: NON ELIMINARE!
			Fonts: modificare
		in <body> 
			scatola Vue.js: NON ELIMINARE!

	in seguito si può differenziare per guest/admin
------------------------------------------------------------------}}
