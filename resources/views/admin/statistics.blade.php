@extends('layouts.dashboard')

@section('title','Dashboard')


@section('content')

@php

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;

@endphp

<h1>Qui le statistiche di {{$my_user->name}}</h1>












@endsection


{{-- <h5>TABELLE DISPONIBILI</h5>
<p>$users = @dump($users)</p>
<p>$profiles = @dump($profiles)</p>
<p>$categories = @dump($categories)</p>
<p>$genres = @dump($genres)</p>
<p>$offers = @dump($offers)</p>
<p>$messages = @dump($messages)</p>
<p>$reviews = @dump($reviews)</p>
<p>$contracts = @dump($contracts)</p>
<p>$sponsorships = @dump($sponsorships)</p>
@dd('') --}}
