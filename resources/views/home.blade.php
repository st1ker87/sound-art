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
    <section class="container badges">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div>
                    <img src="{{ asset('img/badge-best.svg') }}" alt="Imagine of a black star">
                </div>
                <div>
                    <h3 id="ciao">The world's best</h3>
                    <p>Work with winners from around the globe</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div>
                    <img src="{{ asset('img/badge-approved.svg') }}" alt="Imagine of a checked box">
                </div>
                <div>
                    <h3>Trusted platform</h3>
                    <p>Safe and secure with tens of thousands of verified reviews</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div>
                    <img src="{{ asset('img/badge-sound.svg') }}" alt="Imagine of sound barriers">
                </div>
                <div>
                    <h3>Sound your best</h3>
                    <p>
                        Radio singles, YouTube hits and chart-topping albums,
                        all made on SoundArt.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="want-to-work">
        <div class="container">
            <h3>Want to work with <span>BTS's songwriter ?</span></h3>
            <p>Now you can, through SoundArt</p>
        </div>
    </section>
    <section class="artist-in-evidence">
        <h1>In Evidence</h1>
        <p>In attesa...</p>
    </section>
    <section class="how-it-works">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 relative-60">
                    <article class="descriptions">
                        <h3>How SoundArt works:</h3>
                        <ol>
                            <li>Describe your project in seconds</li>
                            <li>Get free proposals from top professionals</li>
                            <li>Hire a pro and get awesome sounding tracks</li>
                        </ol>
                    </article>
                </div>
                <div class="col-sm-12 col-md-6 relative-60 descriptions-images">
                    <!-- Da completare -->
                </div>
            </div>
        </div>
    </section>
    <section class="get-started">

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
