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


@extends('layouts.dashboard')
@section('title','My Sponsorship')
@section('content')


{{-- dati user autenticato --}}
@php
	date_default_timezone_set('Europe/Rome');

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_active_sponsorship = false;
	$my_sponsorship_id = null;
	foreach ($my_contracts as $my_contract) {
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
		$now 		= new DateTime();
		if ($date_start < $now && $date_end >= $now) {
			$is_active_sponsorship = true;
			$my_contract_id = $my_contract->id;
		}
	}
@endphp

<h2>Your Sponsorships</h2>

@foreach ($my_contracts->sortByDesc('created_at') as $contract)

	<div class="msg_box">
		<div class="content">
			<div>Contract id: {{$contract->id}} - {{ucwords($contract->sponsorship->name)}} - Duration: {{$contract->sponsorship->hour_duration}} hours</div>
			<div>Start: {{$contract->date_start}} - End: {{$contract->date_end}}</div>
		
			@php
				$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_start);
				$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_end);
				$now 		= new DateTime();
			@endphp
		
			@if ($contract->transaction_status == 'submitted_for_settlement')
				<span>Payed</span>
			@else
				<span>Issues occurred</span>
			@endif
		
			@if ($date_start < $now && $date_end >= $now)
				<span class="msg_delete">Currently active</span>
			@else 
				<span class="msg_delete">Expired</span>
			@endif

		</div>

	</div>

@endforeach



@endsection
