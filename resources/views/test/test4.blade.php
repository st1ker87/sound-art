@extends('layouts.app')

@section('title', 'Search')

@section('header')
@include('partials.header_search')
@endsection


{{----------------------------------------------------------------------------}}
{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/app.blade.php

	>>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<

	<!-- Styles: single page addendum -->
	@stack('app_head')

-----------------------------------------------------------}}
@push('app_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}	
	.required_input_field {
		color: #e3342f; /* $red */
	}
</style>
@endpush
{{----------------------------------------------------------------------------}}



@section('content')

@php

$votes = $profile->user->reviews;
// Set average vote to false
$average_vote = false;
// If collection of votes is not empty
if($votes->isNotEmpty()) {
	// Set average vote to 0 so I can start adding the votes found
	$average_vote = 0;
	// Keeps track of number of votes
	$counter = 0;
	foreach($votes as $vote) {
	// For each vote add +1 to counter
	$counter++;
	// Update average vote
	$average_vote += $vote->rev_vote;
	}
	// When for loop ends, do average and round the result
	$average_vote = round($average_vote / $counter);
}

@endphp

<main class="main_show">  
	<div class="torno_su" id="up"></div>
	{{-- pensavo di mettere la foto nel jumbo come da sito  --}}
	<section class="jumbotron-container-show">
	<div class="container">
		<div class="title-search">
			<h1>{{$profile->user->name}} {{$profile->user->surname}}</h1>
			<p>
				@foreach($profile->user->categories as $category)
					@if($loop->last)
						{{$category->name}}
					@else
						{{$category->name . ','}}
					@endif
				@endforeach
			</p>
			<div class="votes">
				@if ($average_vote)
					@for ($i = 0; $i < $average_vote; $i++)
						<i class='fas fa-star'></i>   
					@endfor
				@else <span>No raiting</span>
				@endif 
				<p>{{$profile->work_town}}</p>
			</div>
		</div>
	</div>
	</section>
	{{-- d-flex my_flex --}}
	{{-- per i standard da noi dati il div sottostante dovrebbe essere una section 
	ma anche per questa sezione usero un div <3 --}}
	<div class="bar_under_jumbo container-fluid">
		<div class="row search-nav">
			<div class="container d-flex my_flex">
				<div class="to_page_link">
					<a href="#about_me">About Me</a>
					<a href="#genres">Genres</a>
					<a href="#genres">Reviews</a>
					<a href="#offers">Offers</a>
				</div>
				{{-- <button  class="btn btn-primary">Contact {{$profile->user->name}}</button> --}}
				<div class="contacts_btn">
					{{-- ORIGINAL BUTTONS ---------------------------------------------------------}}
					{{-- <a class="btn btn-primary my-color" href="{{ route('messages_create',$profile->slug) }}">Contact {{$profile->user->name}}</a> --}}
					{{-- <a class="btn btn-primary my-color" href="{{ route('reviews_create',$profile->slug) }}">Write a Review for {{$profile->user->name}}</a> --}}
					{{-- MODAL BUTTONS ------------------------------------------------------------}}
					<a type="button" class="btn btn-primary my-color" data-toggle="modal" data-target="#modal-message">Contact {{$profile->user->name}}</a>
					<a type="button" class="btn btn-primary my-color" data-toggle="modal" data-target="#modal-review">Write a Review for {{$profile->user->name}}</a>
					{{----------------------------------------------------------------------------}}
				</div>
			</div>
		</div>
	</div>

	{{-- FEEDBACK MESSAGES --}}
	{{-- redirect with() [success] --}}
	@if (session()->has('status'))
		<section class="container main-show">
			<div class="row border_bottom">
				<div class="alert alert-success">
					{{ session()->get('status') }}
				</div>
			</div>
		</section>
	@endif

	<section class="container main-show">
		<div class="row border_bottom">
			<div id="about_me" class="description col-sm-12 col-md-12 col-md-6 col-lg-6">
				@if($profile->bio_text1 && $profile->bio_text2)
					<h2>About me</h2>
					<p>{{$profile->bio_text1}}</p>
					<p>{{$profile->bio_text2}}</p>
				@endif
			</div>
			<div class="pic-show col-sm-12 col-md-12 col-md-6 col-lg-6">
				<img src="{{asset('storage/'.$profile->image_url)}}" alt="">
			</div>
		</div>
	</section>
	<section class="container main-show">
		<div class="row border_bottom">
			<div id="offers" class="offert">
				<h2>Offerts</h2>         
				@foreach($profile->user->offers as $offer)
					@if($loop->last)
						<span>{{$offer->name}}</span>
					@else
						{{$offer->name . ','}}
					@endif
				@endforeach
			</div>
		</div>
	</section>
	<section class="container main-show">
		<div class="row border_bottom">
			<div id="genres" class="genres">
				<h2>My favorite music</h2>
				@foreach($profile->user->genres as $genre)
					{{-- @if($loop->last) --}}
					<span>{{$genre->name}}</span>
					{{-- @else
					{{$genre->name}}
					@endif --}}
				@endforeach
			</div>
		</div>
	</section>
	<section class="container main-show">
		<h2>Reviews</h2>
		@foreach($profile->user->reviews as $review)
			<div id="reviews" class="reviews">
				<div class="rev_vote">
					<div class="stars">
						@for ($i = 0; $i < $review->rev_vote; $i++)
						<i class='fas fa-star'></i>   
						@endfor
					</div>
					<div class="name">
						<p>{{$review->rev_sender_name}}</p>
					</div>
				</div>
				<div class="text_area">
					<p class="bold">{{$review->rev_subject}}</p>
					<p>{{$review->rev_text}}</p>
					<p>{{$review->created_at}}</p>
				</div>
				{{-- <hr> --}}
			</div>
		@endforeach
	</section>
	{{--:class="{(scrollPosition > scrollChange) ? 'appear' : ''}" --}}
	<a href="#up">
		<div class="freccia_su" >
			<i class="fas fa-arrow-up"></i>
		</div>
	</a>
</main>


{{-- foto
	visualizzazione form messaggio, visualizzazione review --}}
@section('footer')
	@include('partials.footer_search')
@endsection







{{----------------------------------------------------------------------------}}
{{-- MODAL CONTENTS start ----------------------------------------------------}}

@php
	// former guest/messages/create.blade.php
	// $profile esiste già in questa pagina
	use App\User;
	$user = User::where('id',$profile->user_id)->first();
	$slug = $profile->slug;					
@endphp


<!-- MODAL MESSAGE start-->
<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form action="{{ route('messages_store',$user->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('POST') 

				<div class="modal-header">
					<h1 class="modal-title" id="demoModalLabel">Contact {{$user->name}}</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
	
				<div class="modal-body">
					
					<div class="container">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Email <span class="required_input_field">*</span></label>
									<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Insert your email" value="{{ old('email') }}" required>
									@error('email')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Insert your name" value="{{ old('name') }}">
									@error('name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Subject <span class="required_input_field">*</span></label>
							<input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="You ask for..." value="{{ old('subject') }}" required>
							@error('subject')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Text <span class="required_input_field">*</span></label>
							<textarea rows="5" name="text" class="form-control @error('text') is-invalid @enderror" rows="10" placeholder="Write here your message please..." required>{{ old('text') }}</textarea>
							@error('text')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div><span class="required_input_field">* Required informations</span></div>
					</div>

				</div> <!-- modal body -->
	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Send your message to {{$user->name}}</button>
				</div>

			</form>

		</div>
	</div>
</div>
<!-- MODAL MESSAGE end-->


<!-- MODAL REVIEW start-->
<div class="modal fade" id="modal-review" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form action="{{ route('reviews_store',$user->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('POST') 

				<div class="modal-header">
					<h1 class="modal-title" id="demoModalLabel">Write a review for {{$user->name}}</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
	
				<div class="modal-body">
					
					<div class="container">
						<div class="row">
							<div class="col-3">
								<div class="form-group">
									<label for="vote">Vote <span class="required_input_field">*</span></label>
									<select name="vote" id="vote" class="form-control @error('vote') is-invalid @enderror" required>
										<option value="" {{ old('vote') == '' ? 'selected' : '' }}>select</option>
										<option value="1" {{ old('vote') == 1 ? 'selected' : '' }}>1</option>
										<option value="2" {{ old('vote') == 2 ? 'selected' : '' }}>2</option>
										<option value="3" {{ old('vote') == 3 ? 'selected' : '' }}>3</option>
										<option value="4" {{ old('vote') == 4 ? 'selected' : '' }}>4</option>
										<option value="5" {{ old('vote') == 5 ? 'selected' : '' }}>5</option>
									</select>
									@error('vote')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="col-9">
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Insert your name" value="{{ old('name') }}">
									@error('name')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Subject <span class="required_input_field">*</span></label>
							<input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="You ask for..." value="{{ old('subject') }}" required>
							@error('subject')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Text <span class="required_input_field">*</span></label>
							<textarea rows="5" name="text" class="form-control @error('text') is-invalid @enderror" rows="10" placeholder="Write here your message please..." required>{{ old('text') }}</textarea>
							@error('bio_text1')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div><span class="required_input_field">* Required informations</span></div>
					</div>

				</div> <!-- modal body -->
	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Submit your review for {{$user->name}}</button>
				</div>

			</form>

		</div>
	</div>
</div>
<!-- MODAL REVIEW end-->

{{-- MODAL CONTENTS end ------------------------------------------------------}}
{{----------------------------------------------------------------------------}}







@endsection



 
 
 {{-- #attributes: array:9 [▼
	 "id" => 107
	 "user_id" => 22
	 "slug" => "dolor-aperiam-delectus-sapiente-minima"
	 "rev_sender_name" => "Prof. Joaquin Mills"
	 "rev_subject" => "Dolor aperiam delectus sapiente minima."
	 "rev_vote" => 3
	 "rev_text" => "Sapiente dolores hic molestias sint tempore. Ducimus reiciendis nostrum unde laudantium. Sequi enim voluptatem corporis est ut voluptas."
	 "created_at" => "2021-06-22 09:47:15"
	 "updated_at" => "2021-06-22 09:47:15" --}}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 {{------------------------------------------------------------------
	 SHOW PROFILE GUEST E ADMIN
 
	 vedo tutti i dettagli con CV, solo vista
 
	 ____
	 { GUEST OR ADMIN } AND { ID != SE STESSO }
		 pulsante:
			 manda un messaggio > [MessageController@create]
			 >>> VORREMMO NON APRIRE UN'ALTRA VIEW <<<
		 pulsante:
			 fai una recensione > [ReviewController@create]
			 >>> VORREMMO NON APRIRE UN'ALTRA VIEW <<<
	 _____
	 { SOLO ADMIN } AND { ID = STESSO }
		 pulsante:
			 modifica tuo profilo > [Admin/ProfileController@edit]
	 
 
 ------------------------------------------------------------------}}
 {{-- <h2>MODEL: Profile, CRUD: show, AREA: guest - DETTAGLIO SINGOLO PROFILO</h2>
 <h5>URL</h5>
 <p>url: http://localhost:8000/search/{slug} (get)</p>
 <h5>SINGOLO PROFILO PASSATO</h5>
 <p>profile->id = @php echo $profile->id @endphp</p>
 <p>profile->slug = @php echo $profile->slug @endphp</p>
 <p>dump($profile) = @dump($profile)</p>
 <h5>ALTRE TABELLE DISPONIBILI</h5>
 <p>dump($users) = @dump($users)</p>
 <p>dump($profiles) = @dump($profiles)</p>
 <p>dump($categories) = @dump($categories)</p>
 <p>dump($genres) = @dump($genres)</p>
 <p>dump($offers) = @dump($offers)</p>
 <p>dump($messages) = @dump($messages)</p>
 <p>dump($reviews) = @dump($reviews)</p> --}}
 
 