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

<h1>{{ Auth::user()->name }}'s Dashboard</h1>

<div class="d-flex justify-content-between align-items-center">
	{{-- REDIRECT message management --}}
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
</div>

{{-- dati user autenticato --}}
@php
	$my_user 	= Auth::user();
	$my_profile = Auth::user()->profile;
@endphp

@if ($my_profile)
	{{-- EDIT --}}
	<a class="btn btn-primary" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your profile</a>
	{{-- DELETE --}}
	<form class="d-inline-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger">
			Delete your profile
		</button>
	</form>
@else
	{{-- CREATE --}}
	<a class="btn btn-primary" href="{{ route('admin.profiles.create') }}">Create your profile</a>
@endif

@endsection
