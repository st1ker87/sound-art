{{------------------------------------------------------------------
	CREATE MESSAGE 

	IL CONTENUTO DI QUESTA PAGINA VA DENTRO L'OVERLAY APERTO IN guest/profiles/show


------------------------------------------------------------------}}
{{-- <h2>MODEL: Message, CRUD: create, AREA: guest - FORM INSERIMENTO MESSAGGIO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/messages (get)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
@dd('') --}}



@extends('layouts.app')

@section('title', 'Search')

@section('header')
  @include('partials.header_search')
@endsection

@section('content')

<h2>TEST</h2>


@section('footer')
@include('partials.footer_search')
@endsection

@endsection

