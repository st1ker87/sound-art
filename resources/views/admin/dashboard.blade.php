@extends('layouts.dashboard')

@section('title','Dashboard')


@section('content')

{{-- <h1>{{ Auth::user()->name }}'s Dashboard</h1> --}}


{{-- FEEDBACK MESSAGES --}}
<div class="d-flex justify-content-between align-items-center alert_box">	
	{{-- redirect with() [success] --}}
	@if (session()->has('status'))
	{{-- ALERT RICHIUDIBILE DI BOOTSTRAP DA PROVARE --}}
	{{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Holy guacamole!</strong> You should check in on some of those fields below.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> --}}
	<div class="alert alert-success col-12">
		{{ session()->get('status') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
	{{-- transaction result with() [success] --}}
	@if (session()->has('transaction_feedbak'))
		<div class="alert alert-success col-12">
			{{ session()->get('transaction_feedbak') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	{{-- redirect withErrors() [errors] --}}
	@if(count($errors) > 0)
		<div class="alert alert-danger col-12">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
</div>



{{-- dati user autenticato --}}
@php
	date_default_timezone_set('Europe/Rome');
	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_any_contract = (!$my_contracts->isEmpty());
	$is_active_sponsorship = false;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
		}
	}
@endphp



<div class="row dashboard_home">
	<div class="btn_box col-8 offset-2">
		@if ($my_profile)
			{{-- EDIT PROFILE BUTTON --}}
			<a type="button" class="btn btn-primary my-color btn-block" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your Profile</a>
			{{-- DELETE PROFILE BUTTON --}}
			<form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
			</form>
		@else
			{{-- CREATE PROFILE BUTTON --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		@if (!$is_active_sponsorship && $my_profile)
			{{-- SPONSOR YOUR PROFILE --}}
			<a class="btn btn-sponsor btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@endif
		@if ($is_any_contract)
			{{-- CHECK YOUR SPONSORSHIPS --}}
			<a class="btn btn-primary my-color btn-block" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
		@endif		
	</div>
</div>

{{-- INTEGRAZIONE SHOW PROFILE IN DASHBOARD --}}
@if ($my_profile)
	<section class="container main-show" id="about_me">
		<div class="row">
			<div  class="description col-sm-12 col-md-7 col-lg-7">
				@if($my_profile->bio_text1 && $my_profile->bio_text2)
				{{-- <h2>About me</h2> --}}
				<p>{{$my_profile->bio_text1}}</p>
				<p>{{$my_profile->bio_text2}}</p>
				<p>{{$my_profile->bio_text2}}</p>

				@endif
			</div>
		{{-- IMMAGINE RIMOSSA --}}
        	<div  class="offert col-sm-12 col-md-4 offset-md-1 col-lg-4 offest-lg-1">
          		<div class="services">
            		<h2>Services Provided</h2>     
            		<hr>
          			@foreach($my_user->offers as $offer)
						@if($loop->last)
						<p>{{$offer->name}}</p>
						@else
						{{$offer->name . ','}}
						@endif
          			@endforeach
          		</div>
		  		@if ($my_user->genres->isNotEmpty())
         			<div class="fav_music">
                		<div  class="genres">
							<h2>My favorite music</h2>
							<hr>
							@foreach($my_user->genres as $genre)
								<span>{{$genre->name}}</span>
							@endforeach
                		</div>
					</div> 
				@endif
        	</div>
		</div>
	</section>
@endif
    {{--:class="{(scrollPosition > scrollChange) ? 'appear' : ''}" --}}
<a href="#up">
	<div class="freccia_su" >
	<i class="fas fa-arrow-up"></i>
	</div>
</a>


@endsection


{{------------------------------------------------------------------
	DASHBOARD ADMIN

	si vede

		pulsante: 
			vedi/modifica tuo profilo > [ProfileController@show]
			crea profilo > [Admin/ProfileController@create]

		pulsante:
			fai la sponsorship > [sponsorship.blade.php]

		vedi i messaggi > [MessageController@index]

		vedi i review > [ReviewController@index]

		vedi le statistiche

	altre funzioni quali?

	DISPONIBILE IN PAGINA:
			$my_user 	= Auth::user();
			$my_profile = Auth::user()->profile;

------------------------------------------------------------------}}