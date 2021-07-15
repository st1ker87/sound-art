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

// $my_contracts = null;

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12 col-md-10 col-lg-8 col-xl-7">

			<div class="d-flex">
				<h2 class="mr-auto p-2">Subscribed Sponsorships</h2>
			</div>

			<!-- TODO IMPLEMENTARE RIASSUNTO SPESE SPONSORSHIP PER ADMIN --> 
			{{-- @if ($my_contracts)
			<section class="container main-show" id="about_me">
				<div class="row">
					<div  class="description col-sm-12 col-md-7 col-lg-7">
		
						COSE 1
		
					</div>
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
									<h2>My Genres</h2>
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
				<p class="empty_profile">Sponsor your profile to see your subscriptions here.</p>
			@endif
		 --}}


			@foreach ($my_contracts->sortByDesc('date_start') as $contract)

				<div class="msg_box">
					<div class="content">

						<div class="highlight_text">{{ucwords($contract->sponsorship->name)}}</div>
						<div>Contract id: {{$my_user->id}}.{{$contract->id}} - Duration: {{$contract->sponsorship->hour_duration}} hours</div>

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

			@if (!$is_active_sponsorship && $my_profile)
				<div class="d-flex justify-content-center p-2">
					<a class="btn btn-success {{-- btn-block --}} sponsor_bottom" href="{{ route('admin.sponsorships.index') }}">Sponsor your Profile</a>
				</div>
			@endif

        </div>
	</div>
</div>
<div class="vertical_spacer"></div>

{{-- INCLUDE MODAL DELETE PROFILE --}}

@include('partials.modal_profile_delete')


@endsection


