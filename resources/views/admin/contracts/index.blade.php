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
	.vertical_spacer {
		margin-bottom: 24px;
	}
	.highlight_text {
    	font-size: 1.2em;
    	font-weight: 800;
		color: gray;
	}
	.txt_1 {
    	font-size: 1em;
	}
</style>
@endpush

@section('content')

@php

	use App\Classes\DateDisplay;
	use App\Classes\IsNowInInterval;

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_active_sponsorship = false;
	foreach ($my_contracts as $my_contract) {
		if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) {
			$is_active_sponsorship = true;
		}
	}

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12 col-md-10 col-lg-8 col-xl-7">

			<div class="d-flex">
				<h2 class="mr-auto p-2">Your Sponsorships</h2>
				{{-- PULSANTE SPOSTATO IN BASSO --}}
				{{-- @if (!$is_active_sponsorship && $my_profile)
					<div class="p-2">
						<a class="btn btn-success btn-block" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
					</div>
				@endif --}}
			</div>

			@foreach ($my_contracts->sortByDesc('date_start') as $contract)

				<div class="msg_box">
					<div class="content">

						<div class="highlight_text">{{ucwords($contract->sponsorship->name)}}</div>
						<div>Contract id: {{$contract->id}} - Duration: {{$contract->sponsorship->hour_duration}} hours</div>

						<p>
							<table>
								<tr><td>Start</td><td>: {{ (new DateDisplay)->get($contract->date_start) }}</td></tr>
								<tr><td>End  </td><td>: {{ (new DateDisplay)->get($contract->date_end)   }}</td></tr>
							</table>
						</p>
					
						<div>Transactions status: 
							@if ($contract->transaction_status == 'submitted_for_settlement')
								<span class="badge badge-success">Payed</span>
							@else
								<span class="badge badge-warning">Issues occurred</span>
							@endif				
						</div>

						@if ((new IsNowInInterval)->get($contract->date_start,$contract->date_end))
							<span class="msg_delete badge badge-success txt_1">Currently active</span>
						@else 
							<span class="msg_delete badge badge-secondary txt_1">Expired</span>
						@endif

					</div>
				</div>

			@endforeach

			{{-- @if (!$is_active_sponsorship && $my_profile) --}}
				<div class="p-2">
					<a class="btn btn-success {{-- btn-block --}} sponsor_bottom" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
				</div>
			{{-- @endif --}}

        </div>
	</div>
</div>

{{-- INCLUDE MODAL DELETE PROFILE --}}

@include('partials.modal_profile_delete')


@endsection





{{-- <h2>MODEL: Contract, CRUD: index, AREA: admin - DETTAGLIO SINGOLO CONTRATTO MIO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/sponsorship/list (get)</p>
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


