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
@extends('layouts.dashboard')

@section('title','dashboard')


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
	<div class="alert alert-success col-md-4 offset-md-1">
		{{ session()->get('status') }}
	</div>
	@endif
	{{-- transaction result with() [success] --}}
	@if (session()->has('transaction_feedbak'))
		<div class="alert alert-success col-md-4 offset-md-1">
			{{ session()->get('transaction_feedbak') }}
		</div>
	@endif
	{{-- redirect withErrors() [errors] --}}
	@if(count($errors) > 0)
		<div class="alert alert-danger col-md-4 offset-md-1">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>



{{-- dati user autenticato --}}
{{-- ##### QUESTA PARTE DI CALCOLI È CAMBIATA >> SOSTITUIRE IL BLOCCO ##### --}}
@php
	date_default_timezone_set('Europe/Rome');
	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_active_sponsorship = false;
	$is_any_contract = false;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
			$is_any_contract = true;
		}
	}
@endphp



<div class="row dashboard_home">
	<div class="{{-- col-md-4 offset-md-1 --}}">
		@if ($my_profile)
			{{-- EDIT --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your Profile</a>
			{{-- DELETE --}}
			<form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
			</form>
		@else
			{{-- CREATE --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		{{-- ##### PULSANTE PER FARE SPONSORSHIP (se non ne hai nessuna attiva) ##### --}}
		@if (!$is_active_sponsorship && $my_profile)
		{{-- SPONSOR YOUR PROFILE --}}
		<a class="btn btn-primary btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@endif

		{{-- ##### PULSANTE PER VEDERE I CONTRATTI PASSATI (se ce ne sono) ##### --}}
		@if ($is_any_contract)
		{{-- CHECK YOUR SPONSORSHIPS --}}
		<a class="btn btn-primary btn-block" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
		@endif
		
	</div>
</div>



@endsection
