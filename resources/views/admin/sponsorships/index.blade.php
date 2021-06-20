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
@section('content')


{{-- TRNSACTION RESULT MESSAGE --}}
@if (session()->has('success_message'))
	<div class="alert alert-success">
		{{ session()->get('success_message') }}
	</div>
@endif
@if(count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif


@foreach ($sponsorships as $sponsorship)
	@if ($sponsorship->is_active)
		<div>
			{{$sponsorship->name}} - €{{$sponsorship->price}}
			<a class="btn btn-info btn-sm" href="{{ route('sponsorship',$sponsorship->id) }}">Buy</a>
		</div>
		<div>{{$sponsorship->description}}</div>
		<hr>	
	@endif
@endforeach




@endsection