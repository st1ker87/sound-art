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
	@if (Auth::user()->profile->id)
		<a class="btn btn-primary" href="#{{-- {{ route('admin.posts.edit') }} --}}" class="btn btn-primary">
    		Edit your profile
    	</a>
	@else 
		<a class="btn btn-primary" href="#{{-- {{ route('admin.posts.create') }} --}}" class="btn btn-primary">
			Create your profile
		</a>
	@endif


@endsection
