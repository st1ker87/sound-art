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
	.highlight_text {
    	/* font-size: 1.2em; */
    	font-weight: 800;
		color: gray;
	}
</style>
@endpush

@section('content')

@foreach ($sponsorships as $sponsorship)
	@if ($sponsorship->is_active)


		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 col-xl-7">

					<div class="msg_box">
						<div class="content">

							<h4>{{ucwords($sponsorship->name)}}</h4>
							<p>Only €{{$sponsorship->price}}</p>
							<div>{{$sponsorship->description}}</div>
							<a class="btn btn-success btn-sm msg_delete" href="{{ route('sponsorship',$sponsorship->id) }}">Buy</a>

						</div>
					</div>

				</div>
			</div>
		</div>		

	@endif
@endforeach

@endsection


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

