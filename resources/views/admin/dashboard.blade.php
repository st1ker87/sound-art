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

		statistiche

		
	altre funzioni quali?




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

@php

	$my_user 	= Auth::user();
	$my_profile = Auth::user()->profile;

@endphp

@if ($my_profile)
	{{-- @if (Auth::user()->profile->id) --}}
	<a class="btn btn-primary" href="{{ route('admin.profiles.edit',$my_profile->slug)}}" class="btn btn-primary">
		Edit your profile
	</a>
	{{-- @endif --}}
@else
	{{-- se non esiste --}}
	<a class="btn btn-primary" href="{{ route('admin.profiles.create') }}" class="btn btn-primary">
		Create your profile
	</a>		
@endif





@endsection
