@extends('layouts.dashboard')

@section('title','Sponsorship Shop')

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
	.highlight_text {
    	/* font-size: 1.2em; */
    	font-weight: 800;
		color: gray;
	}
</style>
@endpush

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8 col-xl-7">

			<div class="d-flex">
				<h2 class="mr-auto p-2">Sponsorship Shop</h2>
			</div>

			@foreach ($sponsorships as $sponsorship)
				@if ($sponsorship->is_active)
					<div class="msg_box">
						<div class="content">
							<h4>{{ucwords($sponsorship->name)}}</h4>
							<p>Only €{{$sponsorship->price}}</p>
							<div>{{$sponsorship->description}}</div>
							<a class="btn btn-success btn-sm msg_delete" href="{{ route('sponsorship',$sponsorship->id) }}">Buy</a>
						</div>
					</div>
				@endif
			@endforeach

		</div>
	</div>
</div>		
<div class="vertical_spacer"></div>

{{-- INCLUDE MODAL DELETE PROFILE --}}
@include('partials.modal_profile_delete')


@endsection


