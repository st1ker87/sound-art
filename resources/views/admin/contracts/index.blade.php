{{-- <h2>MODEL: Contract, CRUD: show, AREA: admin - DETTAGLIO SINGOLO CONTRATTO MIO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/sponsorship/{id} (get)</p>
<h5>SINGOLO CONTRATTO PASSATO</h5>
<p>contract->id = @php echo $contract->id @endphp</p>
<p>dump($contract) = @dump($contract)</p>
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

@php
	$counter = 1;
@endphp

@foreach ($my_contracts as $contract)

	<p>{{$counter}} (id: {{$contract->id}}) - {{$contract->sponsorship->name}} (duration: {{$contract->sponsorship->hour_duration}} hours)</p>
	<p>start: {{$contract->date_start}} - end: {{$contract->date_end}}</p>

	@php
		$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_start);
		$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_end);
		$now 		= new DateTime();
	@endphp

	@if ($contract->transaction_status == 'submitted_for_settlement')
		<p>Payed</p>
	@else
		<p>Issues occurred</p>
	@endif

	@if ($date_start < $now && $date_end >= $now)
		<p>Currently active</p>
	@else 
		<p>Expired</p>
	@endif
	<hr>

@endforeach



@endsection
