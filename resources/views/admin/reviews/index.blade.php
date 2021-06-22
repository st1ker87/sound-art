{{-- <h2>MODEL: Review, CRUD: index, AREA: admin - ELENCO REVIEW</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/reviews (get)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p> --}}


{{-- dati user autenticato --}}
@php
	$my_user 	= Auth::user();
	$my_profile = Auth::user()->profile;
@endphp

@extends('layouts.dashboard')

@section('title','dashboard-reviews')
@section('content')

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12">

            <h2>Your reviews</h2>
			
            @if(count($my_user->reviews)>0)

                @foreach ($my_user->reviews as $review)
                    <div class="msg_box">
                        <div class="rev_vote">
                            @for ($i = 0; $i < $review->rev_vote; $i++)
                                <i class='fas fa-star'></i>   
                            @endfor
                        </div>
                        <div class="msg_head">
                            <div class="row">
                                <span class="msg_obj col-md-6">{{ $review->rev_subject}}</span>
                                <span class="msg_sender col-md-6">{{ $review->created_at}}  from: {{ $review->rev_sender_name}}</span>
                            </div>
                        </div>
                        @if ($review->rev_text)
                            <div class="msg_content">
                                <span class="msg_obj">{{ $review->rev_text}}</span>
                            </div>    
                        @endif
                    </div>
                @endforeach
                    
            @else
                <p>No reviews to show yet.</p>
                
            @endif
        </div>
	</div>
</div>


@endsection