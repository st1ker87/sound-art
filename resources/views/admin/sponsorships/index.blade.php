{{-- <h2>MODEL: Sponsorship, CRUD: index, AREA: admin - ELENCO SPONSORSHIP IN VENDITA</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/sponsorships (get)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
<p>dump($sponsorships) = @dump($sponsorships)</p>
<p>dump($contracts) = @dump($contracts)</p>
@dd('') --}}


@extends('layouts.dashboard')
@section('title','Sponsorships')

{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/dashboard.blade.php

	>>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<

	<!-- Styles: single page addendum -->
	@stack('dashboard_head')

-----------------------------------------------------------}}
@push('dashboard_head')
<style>
	#bt_form #card-number, 
	#bt_form #cvv, 
	#bt_form #expiration-date {
		/* MODIFICABILE IN BASE AGLI ALTRI FORM */
		background: white;
		height: 38px;
		border: 1px solid #CED4DA;
		padding: .375rem .75rem;
		border-radius: .25rem;
	}
	#bt_form #bt_message_container {
		display: none;
	}
	.vertical_spacer {
		margin-bottom: 24px;
	}
	.required_input_field {
		color: #e3342f; /* $red */
	}
</style>
@endpush

@section('content')

@foreach ($sponsorships as $sponsorship)
	@if ($sponsorship->is_active)

		<div class="msg_box">
			<div class="content">
				<div>{{ucwords($sponsorship->name)}}, only €{{$sponsorship->price}}</div>
				<div>{{$sponsorship->description}}</div>
				{{-- ORIGINAL BUTTONS ---------------------------------------------------------}}
				<a class="btn btn-info btn-sm msg_delete" href="{{ route('sponsorship',$sponsorship->id) }}">Buy</a>
				{{-- MODAL BUTTONS ------------------------------------------------------------}}
				{{-- <a type="button" class="btn btn-info btn-sm msg_delete buy-sponsorship-btn" data-sponsorship_id="{{ $sponsorship->id }}" data-toggle="modal" data-target="#modal-buy">Buy</a> --}}
				{{-- <a type="button" class="btn btn-info btn-sm msg_delete" data-sponsorship="{{ $sponsorship }}" data-toggle="modal" data-target="#modal-buy">Buy</a> --}}
				{{-- <a type="button" class="btn btn-info btn-sm msg_delete" data-toggle="modal" data-target="#modal-buy">Buy</a> --}}
				{{----------------------------------------------------------------------------}}
			</div>
		</div>

		{{----------------------------------------------------------------------------}}
		{{-- MODAL CONTENTS start ----------------------------------------------------}}

		@php
			// former Admin/ContractController@create
			// echo $sponsorship->name;
			// double check: creation only for users without sponsorship
			date_default_timezone_set('Europe/Rome');
			$my_contracts = Auth::user()->contracts;
			$is_active_sponsorship = false;
			foreach ($my_contracts as $my_contract) {
				$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
				$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
				$now 		= new DateTime();
				if ($date_start < $now && $date_end >= $now) $is_active_sponsorship = true;
			}
			if ($is_active_sponsorship)
				return redirect()->route('dashboard')->withErrors('A Sponsorship is already active!');

			// con \Braintree invece di Braintree risolvo la classe introvabile... 
			$gateway = new \Braintree\Gateway([
				'environment' 	=> config('services.braintree.environment'),
				'merchantId' 	=> config('services.braintree.merchantId'),
				'publicKey' 	=> config('services.braintree.publicKey'),
				'privateKey' 	=> config('services.braintree.privateKey')
			]);

			$token = $gateway->ClientToken()->generate();
			
		@endphp

		<!-- MODAL CONTRACT start-->
		<div class="modal fade" id="modal-buy" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<form action="{{ route('checkout') }}" method="post" enctype="multipart/form-data" id="buy-sponsorship-form">
						@csrf
						@method('POST') 

						<div class="modal-header">
							<h1 class="modal-title" id="demoModalLabel">{{ucwords($sponsorship->name)}}</h1>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
			
						<div class="modal-body">
							<h4>{{$sponsorship->description}}</h4>
							

						</div> <!-- modal body -->
			
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success">Submit Payment</button>
						</div>

					</form>

				</div>
			</div>
		</div>
		<!-- MODAL CONTRACT end-->


		{{-- MODAL CONTENTS end ------------------------------------------------------}}
		{{----------------------------------------------------------------------------}}

	@endif
@endforeach



<script type="application/javascript">

	// $('.buy-sponsorship-btn').on('click', function () {
	// 	$('#buy-sponsorship-form').attr('action', $(this).data('sponsorship_id'));
	// });

	// console.log('sponsorship_id',sponsorship_id);

	// var ATTRIBUTES = ['sponsorship'];

	// $('[data-toggle="modal"]').on('click', function (e) {
	// 	var $target = $(e.target);
	// 	var modalSelector = $target.data('target');

	// 	ATTRIBUTES.forEach(function (attributeName) {
	// 		var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
	// 		var dataValue = $target.data(attributeName);
	// 		$modalAttribute.text(dataValue || '');
	// 	});
	// });

</script>


{{----------------------------------------------------------------------------}}
{{-- MODAL SCRIPTS start -----------------------------------------------------}}

<script type="application/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
{{-- <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
<script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{-- MODAL SCRIPTS end -------------------------------------------------------}}
{{----------------------------------------------------------------------------}}


@endsection