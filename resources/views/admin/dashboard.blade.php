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

<div class="row dashboard_home">
	<div>
		@if ($my_profile)
			{{-- EDIT PROFILE BUTTON --}}
			<a type="button" class="btn btn-primary my-color btn-block" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit your Profile</a>
			{{-- DELETE PROFILE BUTTON --}}
			{{-- ORIGINAL BUTTON ----------------------------------------------------------}}
			{{-- <form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger btn-block">Delete your Profile</button>
			</form> --}}
			{{-- MODAL BUTTON -------------------------------------------------------------}}
			<button type="submit" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-delete">Delete your Profile</button>
			{{----------------------------------------------------------------------------}}
		@else
			{{-- CREATE PROFILE BUTTON --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
		@endif
		@if (!$is_active_sponsorship && $my_profile)
			{{-- SPONSOR YOUR PROFILE --}}
			<a class="btn btn-primary btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
		@endif
		@if ($is_any_contract)
			{{-- CHECK YOUR SPONSORSHIPS --}}
			<a class="btn btn-primary btn-block" href="{{ route('my_sponsorships') }}">Check your Sponsorships</a>	
		@endif		
	</div>
</div>




{{----------------------------------------------------------------------------}}
{{-- MODAL CONTENTS start ----------------------------------------------------}}

@if ($my_profile)
	<!-- MODAL DELTE start-->
	<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header" style="border:none;">
					<h5 class="modal-title" id="demoModalLabel" style="color: #212949;">Profile Removal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<p>You are about to remove all your Profile's informations from this platform. No one will be able to reach you.</p>
					<p>
						@if ($is_active_sponsorship)
							Your current Sponsorship will cease immediately.				
						@endif
					</p>
					<p>All your past activities (sponsorships, messages, reviews) will remain in our database, unless you decide to cancel your account.</p>
					<p>This action can't be undone.</p>
				</div>

				<div class="modal-footer" style="border:none;">
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
	</div>
	<!-- MODAL DELETE End-->

	<script type="application/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	{{-- <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
	{{-- <script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

@endif

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