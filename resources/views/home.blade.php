@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="jumbotron-container">
        <div class="title">
            <h1>Hire you artist</h1>
            <p>
                If you are looking for music artists, session drummers, vocalists,
                audio editing, mixing engineers, producers and more,
                or you just want to have your private lessons, you can find all of that with us.
            </p>
        </div>
    </section>
    <section class="badges">

    </section>
@endsection


    






















{{------------------------------------------------------------------
	HOME PER TUTTI
	
	distinguerà GUEST da ADMIN

	ex laravel welcome page: contenuto da eliminare
		
	rifare da zero con layout togliendo poco alla volta

	PER DISTRUGGERLA FARE UN BACKUP (ORIGINALE_home.blade.php)
	
------------------------------------------------------------------}}
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>

        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}

        {{-- @extends('partials.footer') --}}
    {{--</body>
</html> --}}
