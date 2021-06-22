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
<div class="d-flex justify-content-between align-items-center">
	
	{{-- redirect with() [success] --}}
	@if (session()->has('status'))
	<div class="alert alert-success">
		{{ session()->get('status') }}
	</div>
	@endif
	{{-- transaction result with() [success] --}}
	@if (session()->has('transaction_feedbak'))
		<div class="alert alert-success">
			{{ session()->get('transaction_feedbak') }}
		</div>
	@endif
	{{-- redirect withErrors() [errors] --}}
	@if(count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

</div>



{{-- dati user autenticato --}}
@php
	date_default_timezone_set('Europe/Rome');
	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_active_sponsorship = false;
	$my_contract_id = null;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
			$my_contract_id = $my_contract->id;
		}
	}
@endphp
<div class="row">
	<div class="col-md-4 offset-md-1">
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
			<a class="btn btn-primary" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		
		@if (!$is_active_sponsorship)
			{{-- SPONSOR YOUR PROFILE --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@else
			{{-- CHECK YOUR SPONSORSHIP --}}
			<a class="btn btn-primary btn-block" href="{{ route('my_sponsorships',$my_contract_id) }}">Check your Sponsorships</a>	
		@endif
	</div>
</div>







@endsection
