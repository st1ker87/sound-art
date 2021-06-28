@extends('layouts.app')

@section('title', 'Homepage')

@section('header')
    @include('partials.header_home')
@endsection

@section('content')

    <!-- Jumbotron -->
    <section class="jumbotron-container">
        <div class="container">
            <div class="jumbotron-title">
                <h1>Hire your artist</h1>
                <p>
                    If you are looking for session drummers, vocalists,
                    audio editing, mixing engineers, producers and more,
                    or you just want to have your private lessons, you can find all of that with us.
                </p>
                <div class="search-cnt">
                    <button v-on:click.stop="showSearch" type="button" class="btn btn-dark">
                        Search for artists <i class="fas fa-caret-right"></i>
                    </button>
                    <div v-if="searchHome" class="search">
                        <div class="categories-cnt">
                            <h5>Categories</h5>
                            <ul>
                                @foreach($categories->sortBy('name') as $category)
                                <li>
                                    <form action="{{ route('search') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="category" name="category" value="{{$category->name}}">
                                        <input v-on:click="stopProp" type="submit" role="button" value="{{ucwords($category->name)}}">
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="genres-cnt">
                            <h5>Genres</h5>
                            <ul>
                                @foreach($genres->sortBy('name') as $genre)
                                <li>
                                    <form action="{{ route('search') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="genre" name="genre" value="{{$genre->name}}">
                                        <input v-on:click="stopProp" type="submit" value="{{ucwords($genre->name)}}">
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Badges -->
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

    <!-- Want to work -->
    <section class="want-to-work">
        <div class="container">
            <h3>Want to work with <span>BTS's songwriter ?</span></h3>
            <p>Now you can, through SoundArt</p>
        </div>
    </section>

    @include('partials.cards_home')

    <!-- Get started -->
    <section class="get-started">
        <h3>Discover Artists</h3>
        <a href="{{ route('search') }}" class="btn btn-outline-dark btn-lg">Search for artists</a>
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

    <!-- Get started -->
    <section class="get-started">
            <h3>Get started for free</h3>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark btn-lg">Post your offers now</a>
    </section>

@endsection


@section('footer')
    @include('partials.footer_home')
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
