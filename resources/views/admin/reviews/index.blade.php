@extends('layouts.dashboard')

@section('title','Reviews')

@push('dashboard_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}
	.msg_delete,
	.required_input_field {
		color: #e3342f; /* $red */
	}
	.msg_delete:hover {
		color: #d3231d; /* custom */
	}
	.modal-header,
	.modal-footer {
		border: none;
	}
	.modal-title {
		color: #212949; /* $primaryDarkBlue */
	}
	.modal-footer button {
		margin-left: 5px;
	}
</style>
@endpush

@section('content')

@php

	use App\Classes\DateDisplay;

	$my_user 	= Auth::user();
	$my_profile = $my_user->profile;

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12 col-md-10 col-lg-8 col-xl-7">

			<div class="d-flex">
				<h2 class="mr-auto p-2">Reviews</h2>
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
								<div class="msg_txt limit">{{ $review->rev_text}}</div> 
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
<div class="vertical_spacer"></div>

{{-- INCLUDE MODAL DELETE PROFILE --}}
@include('partials.modal_profile_delete')

@endsection


