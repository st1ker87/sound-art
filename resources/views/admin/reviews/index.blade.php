@extends('layouts.dashboard')

@section('title','Your Reviews')

@section('content')

@php

	use App\Classes\DateDisplay;

	$my_user 	= Auth::user();
	$my_profile = $my_user->profile;

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12 col-md-10 col-lg-8 col-xl-7">

			<div class="d-flex justify-content-between align-items-center">
				<h2>Your Reviews</h2>
			</div>

			@if(count($my_user->reviews)>0)

				{{-- @foreach ($my_user->reviews as $review) --}}
				@foreach ($my_user->reviews->sortByDesc('created_at') as $review)
					<div class="msg_box">
						<div class="content">
							<div class="rev_vote">
								@for ($i = 0; $i < $review->rev_vote; $i++)
									<i class='fas fa-star'></i>   
								@endfor
							</div>
								<div class="msg_date">
									{{ (new DateDisplay)->get($review->created_at) }}
									@if ($review->rev_sender_name)
										by <span class="sender_name">{{ $review->rev_sender_name }}</span>
									@endif
								</div>
								<div class="msg_obj">{{ $review->rev_subject}}</div>
							@if ($review->rev_text)
								<div class="msg_txt">{{ $review->rev_text}}</div> 
							@endif
						</div>
					</div>
				@endforeach
					
			@else
				<p>No reviews to show yet.</p>
			@endif

		</div>
	</div>
</div>


@endsection




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

