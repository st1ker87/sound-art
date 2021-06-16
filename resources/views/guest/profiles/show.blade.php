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
            {{-- <i v-for="i in vote(best.vote_average)" class="fas fa-star"></i> --}}

              @if ($average_vote)
                @for ($i = 0; $i < $average_vote; $i++)
                  <i class='fas fa-star'></i>   
                @endfor      
              @endif         
          </div>

        </div>
      </div>
    </section>
  </main>






@endsection























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

