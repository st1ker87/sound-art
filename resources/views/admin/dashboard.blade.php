@extends('layouts.dashboard')

@section('title','Dashboard')

{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/dashboard.blade.php

	>>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<
	<!-- Styles: single page addendum -->
	@stack('dashboard_head')
-----------------------------------------------------------}}
@push('dashboard_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}	
	.required_input_field {
		color: #e3342f; /* $red */
	}
	.modal-header,
	.modal-footer {
		border: none;
	}
	.modal-title {
		color: #212949; /* $primaryDarkBlue */
	}
	.modal-footer button {
		margin-left: 5px;
	}
</style>
@endpush


@section('content')

@php

	use App\Classes\IsNowInInterval;

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_any_contract = (!$my_contracts->isEmpty());
	$is_active_sponsorship = false;
	foreach ($my_contracts as $my_contract) {
		if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) {
			$is_active_sponsorship = true;
		}
	}

@endphp


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

{{-- <div class="row dashboard_home">
	<div class="btn_box col-8 offset-2">
		@if ($my_profile)
			{{-- EDIT PROFILE BUTTON --
			<a type="button" class="btn btn-primary my-color btn-block" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your Profile</a>
			{{-- DELETE PROFILE BUTTON --}}
			{{-- ORIGINAL BUTTON ----------------------------------------------------------}}
			{{-- <form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
			</form> --}}
			{{-- MODAL BUTTON -------------------------------------------------------------
			<button type="submit" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-delete">Delete your Profile</button>
			{{----------------------------------------------------------------------------
		@else
			{{-- CREATE PROFILE BUTTON }}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		@if (!$is_active_sponsorship && $my_profile)
			{{-- SPONSOR YOUR PROFILE }}
			<a class="btn btn-sponsor btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@endif
		@if ($is_any_contract)
			{{-- CHECK YOUR SPONSORSHIPS }}
			<a class="btn btn-primary my-color btn-block" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
		@endif		
	</div>
</div> --}}

{{-- INTEGRAZIONE SHOW PROFILE IN DASHBOARD --}}
@if ($my_profile)
	<section class="container main-show" id="about_me">
		<div class="row">
			<div  class="description col-sm-12 col-md-7 col-lg-7">

				{{-- <h2>About me</h2> --}}
				@if($my_profile->bio_text1)
					<h2>About Me</h2>
					{{-- <p>{{$my_profile->bio_text1}}</p> --}}
					@php $pars = preg_split("/\r\n|\n|\r/", $my_profile->bio_text1); @endphp
					@foreach ($pars as $par) <p>{{$par}}</p> @endforeach
				@endif
				@if($my_profile->bio_text2)
					{{-- <p>{{$my_profile->bio_text2}}</p> --}}
					@php $pars = preg_split("/\r\n|\n|\r/", $my_profile->bio_text2); @endphp
					@foreach ($pars as $par) <p>{{$par}}</p> @endforeach
				@endif
				@if($my_profile->bio_text3)
					{{-- <p>{{$my_profile->bio_text3}}</p> --}}
					@php $pars = preg_split("/\r\n|\n|\r/", $my_profile->bio_text3); @endphp
					@foreach ($pars as $par) <p>{{$par}}</p> @endforeach
				@endif
			</div>
		{{-- IMMAGINE RIMOSSA --}}
        	<div  class="offert col-sm-12 col-md-4 offset-md-1 col-lg-4 offest-lg-1">
          		<div class="services">
					  <div class="genres">
						  <h2>Services Provided</h2>     
						  <hr>
							@foreach($my_user->offers as $offer)
							  @if($loop->last)
							  <span>{{ucwords($offer->name)}}</span>
							  @else
							  <span>{{ucwords($offer->name) . ','}}</span>
							  @endif
							@endforeach
					  </div>
          		</div>
		  		@if ($my_user->genres->isNotEmpty())
         			<div class="fav_music">
                		<div  class="genres">
							<h2>My favorite music</h2>
							<hr>
							@foreach($my_user->genres as $genre)
								<span>{{ucwords($genre->name)}}</span>
							@endforeach
                		</div>
					</div> 
				@endif
        	</div>
		</div>
	</section>
@else 
	<p class="empty_profile">Compile your profile to show your personal information here.</p>
@endif
    {{--:class="{(scrollPosition > scrollChange) ? 'appear' : ''}" --}}
{{-- <a href="#up">
	<div class="freccia_su" >
	<i class="fas fa-arrow-up"></i>
	</div>
</a> --}}



{{----------------------------------------------------------------------------}}
{{-- MODAL CONTENTS start ----------------------------------------------------}}



@include('partials.modal_profile_delete')
	<!-- MODAL DELETE PROFILE start-->
	{{-- <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="modal-title" id="demoModalLabel">Profile Removal</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<p>You are about to remove all your Profile's informations from this platform. No one will be able to reach you in the search area.</p>
					<p>
						@if ($is_active_sponsorship)
							Your current Sponsorship will cease immediately.				
						@endif
					</p>
					<p>All your past activities (sponsorships, messages, reviews) will remain in our database, unless you decide to cancel your account.</p>
					<p>This action can't be undone.</p>
				</div>

				<div class="modal-footer">
					<div>
						<form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
							@csrf
							@method('DELETE')
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
							<button type="submit" class="btn btn-danger">Confirm Delete</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div> --}}
	<!-- MODAL DELETE PROFILE end-->



{{-- MODAL CONTENTS end ------------------------------------------------------}}
{{----------------------------------------------------------------------------}}




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