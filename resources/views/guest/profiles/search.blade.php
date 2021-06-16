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
   <div class="container-fluid my-color-search">
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
    </div>


   <!-- PROFILES -->
   <section class="card-list">
      <div class="container">
        <div class="row">
          {{-- FOR EACH PROFILE --}}
          @foreach($profiles as $profile)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card-cnt">

              {{-- CARD IMAGE --}}
              <div class="card-image">
                {{-- Da mettere l'immagine ({{$profile->image_url}}) --}}
                <img src="{{ asset('img/singer_photo.jpg') }}" alt="">
              </div>
  
              {{-- INIZIO PHP --}}
  
              @php
                // Get categories collection
                $categories = $profile->user->categories;
  
                // Get genres collection
                $genres = $profile->user->genres;
                
                /* VOTES */
  
                // Get votes collection
                $votes = $profile->user->reviews;
  
                // Set average vote to false
                $average_vote = false;

                // Keeps track of number of votes
                $counter = 0;
  
                // If collection of votes is not empty
                if($votes->isNotEmpty()) {
  
                  // Set average vote to 0 so I can start adding the votes found
                  $average_vote = 0;
  
                  foreach($votes as $vote) {
  
                    // For each vote add +1 to counter
                    $counter++;
  
                    // Update average vote
                    $average_vote += $vote->rev_vote;
                  }
  
                  // When for loop ends, do average and round the result
                  $average_vote = round($average_vote / $counter);
                }
  
                /* DESCRIPTION */
                $description = $profile->bio_text1;
                if (strlen($description) > 71)
                  $description = substr($description, 0, 70) . '...';
              @endphp
  
              {{-- FINE PHP --}}
  
  
              {{-- BODY DELLA CARTA --}}
              <div class="card-content">
  
                {{-- Categorie --}}
                <div class="provided-card-title">
                  <a class="provided-categories" href="{{ route('profiles.show', $profile->slug) }}">
                    <h3>
                      @foreach($categories as $category)
                          @if($loop->last)
                            {{$category->name}}
                          @else
                          {{$category->name . '/'}}
                          @endif
                      @endforeach
                    </h3>
                  </a>
    
                  {{-- Name, Surname, Work Town --}}
                  <a class="provided-name" href="{{ route('profiles.show', $profile->slug) }}">
                    <span>{{$profile->user->name}} {{$profile->user->surname}}</span>
                  </a>
                  <span>, {{$profile->work_town}}</span>
                </div>
  
                {{-- Vote --}}
                <div class="vote">
                  @for ($i = 0; $i < $average_vote; $i++)
                    <i class="fas fa-star filled"></i>
                  @endfor
                  @if ($average_vote < 5)
                    @for ($i = 0; $i < 5 - $average_vote; $i++)
                    <i class="fas fa-star empty"></i>
                    @endfor
                  @endif
                  <span>({{$counter}})</span>     
                </div>
                
  
                {{-- DESCRIZIONE --}}
                <div class="provided-description">
                  <p>{{$description}}</p>
                </div>
                
                {{-- Genres --}}
                <div class="provided-genres">
                  <h6>Genres</h6>
                  <span>
                      @foreach($genres as $genre)
                        @if($loop->last)
                          {{$genre->name}}
                        @else
                          {{$genre->name . '/'}}
                        @endif
                      @endforeach
                  </span>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
   </section>
  </main>

@endsection

@section('footer')
    @include('partials.footer_search')
@endsection