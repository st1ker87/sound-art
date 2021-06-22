@extends('layouts.app')

@section('title', 'Search')

@section('header')
  @include('partials.header_search')
@endsection

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

  <main>  
    <div class="torno_su" id="torno_su"></div>
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
    {{-- per i standard da noi dati il div sottostante dovrebbe essere una section 
    ma anche per questa sezione usero un div <3 --}}
    <div class="bar_under_jumbo container-fluid">
      <div class="row search-nav">
        <div class="container d-flex my_flex">
          <a href="#about_me">About Me</a>
          <a href="#genres">Genres</a>
          <a href="#genres">Reviews</a>
          <a href="#offers">Offers</a>
          {{-- <button  class="btn btn-primary">Contact {{$profile->user->name}}</button> --}}
		  <a class="btn btn-primary" href="{{ route('messages_create',$profile->slug) }}">Contact {{$profile->user->name}}</a>
		  <a class="btn btn-primary" href="{{ route('reviews_create',$profile->slug) }}">Write a Review for {{$profile->user->name}}</a>
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
          <img src="{{ asset('img/singer_photo.jpg') }}" alt="">
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
      <div class="row border_bottom">
        <div id="reviews" class="reviews">
          <h2>Reviews</h2>
          @foreach($profile->user->reviews as $review)
          <p>{{$review->rev_sender_name}}</p>
          <p>{{$review->vote}}</p>
          <p>{{$review->rev_subject}}</p>
          <p>{{$review->rev_text}}</p>
          <hr>
      @endforeach
        </div>
      </div>
    </section>



    <div class="freccia_su">
      <a href="#torno_su">freccia su</a>
    </div>
  </main>

  
  {{-- foto
    visualizzazione form messaggio, visualizzazione review --}}
  @section('footer')
    @include('partials.footer_search')
  @endsection

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

