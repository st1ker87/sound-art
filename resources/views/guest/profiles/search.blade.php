{{------------------------------------------------------------------
	ADEVANCED SEARCH PROFILE PER TUTTI

	equivale a index.blade.php


------------------------------------------------------------------}}


@extends('layouts.app')

@section('title', 'Search')

@section('header')
  @include('partials.header_search')
@endsection

@section('content')
  <main>
    {{-- jumbo con testi --}}
    <section class="jumbotron-container-search">
      <div class="container">
        <div class="title-search">
          <h1>Find your Artist</h1>
          <p>Migliorare il testo QUI</p>
        </div>
      </div>
    </section>
    {{-- barra ricerca --}}
   <section class="container-fluid my-color-search">
     <div class="row">
       <div class="container">
          <div class="search-nav">
            <div class="btn-filter d-inline-block">
              <h3>Filters</h3>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select>
                    <option disabled selected><h3>-- Categories --</h3></option>
                    <option value="band">Band</option>
                    <option value="bass">Bass</option>
                    <option value="cello">Cello</option>
                    <option value="drums">Drums</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select>
                    <option disabled selected><h3>-- Genrs --</h3></option>
                    <option value="rock">Rock</option>
                    <option value="punk">Punk</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="jazz">Jazz</option>
                    <option value="hip-hop">Hip-Hop</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select>
                    <option disabled selected><h3>-- Votes--</h3></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <h3>Number Reviews</h3>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="btn-category">
                <button class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
       </div>
     </div>
   </section>


   <!-- PROFILES -->
   <section>
      <div class="container">

        {{-- FOR EACH PROFILE --}}
        @foreach($profiles as $profile)

          <div class="card-cnt" style="border-bottom: 2px solid black;">
            <div class="card-image">
              Da mettere l'immagine ({{$profile->image_url}})
            </div>

            {{-- INIZIO PHP --}}

                  @php
                  // Get categories collection
                    $categories = $profile->user->categories;

                  // Get genres collection
                  $genres = $profile->user->genres;
                  
                  // Get votes collection
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

            {{-- FINE PHP --}}


            {{-- BODY DELLA CARTA --}}
            <div class="card-content">

              {{-- Categorie --}}
                <h5>
                  @foreach($categories as $category)
                      @if($loop->last)
                        {{$category->name}}
                      @else
                      {{$category->name . '/'}}
                      @endif
                  @endforeach
                </h5>

              {{-- Name, Surname, Work Town --}}
                <h6>
                    {{$profile->user->name}} {{$profile->user->surname}} - 
                    <span>Città: {{$profile->work_town}}</span> 
                </h6>

              {{-- Vote --}}
                @if ($average_vote)
                  <h6>{{$average_vote}}</h6>
                @else
                  <h6>No rating</h6>        
                @endif
              

              {{-- DESCRIZIONE --}}

              <p>DESCRIZIONE</p>

              {{-- Genres --}}
                <h6>
                  @foreach($genres as $genre)
                    @if($loop->last)
                      {{$genre->name}}
                    @else
                      {{$genre->name . '/'}}
                    @endif
                  @endforeach
                </h6>
            </div>
          </div>
        @endforeach
      </div>
   </section>
  </main>

@endsection

@section('footer')
    @include('partials.footer_search')
@endsection