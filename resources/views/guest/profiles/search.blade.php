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

    {{-- BARRA RICERCA --}}
    <section class="search-bar">
      <div class="container">
        <div class="row">

          {{-- FILTER --}}
          <div class="col-lg-2 col-md-4">
            <span>Filters</span>
          </div>

          {{-- CATEGORY --}}
          <div class="col-lg-2 col-md-4">
            <div class="categories-pannel">
              <button v-on:click="showCategory" type="button">@{{btnCategories}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showCategoryPannel" class="search">
                <div class="categories-cnt">
                    <ul>
                        @foreach($categories as $category)
                        <li>
                            <input v-on:click="setCategory($event.target.value)" type="button" value="{{$category->name}}">
                        </li>
                        @endforeach
                    </ul>
                </div>
              </div>
            </div>
          </div>

          {{-- GENRE --}}
          <div class="col-lg-2 col-md-4">
            <div class="categories-pannel">
              <button v-on:click="showGenres">@{{btnGeneres}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showGenrePannel" class="search">
                <div class="categories-cnt">
                    <ul>
                        @foreach($genres as $genre)
                        <li>
                            <input v-on:click="setGenre($event.target.value)" type="button" value="{{$genre->name}}">
                        </li>
                        @endforeach
                    </ul>
                </div>
              </div>
            </div>
          </div>

          {{-- VOTES --}}
          <div class="col-lg-2 col-md-4">
            <div class="categories-pannel">
              <button v-on:click="showVotes">@{{btnVotes}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showVotePannel" class="search">
                <div class="categories-cnt">
                    <ul>
                      @for($i = 1; $i <= 5; $i++)
                        <li>
                          <input v-on:click="setVote($event.target.value)" type="button" value="{{$i}}">
                        </li>
                      @endfor
                    </ul>
                </div>
              </div>
            </div>
          </div>

          {{-- REVIEWS --}}
          <div class="col-lg-2 col-md-4">
            <input id="number-of-views" v-model="reviewNum_selected" type="number" placeholder="N views">
          </div>

          {{-- SUBMIT --}}
          <div class="col-lg-2 col-md-4">
            <button id="submit-advanced-search" v-on:click="filterCall">Submit</button>
          </div>
        </div>
      </div>
    </section>


   {{-- <div class="container-fluid my-color-search">
     <div class="row">
       <div class="container">
          <div class="search-nav">
            <div class="btn-filter d-inline-block">
              <h3>Filters</h3>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select v-model="category_selected">
                    @foreach($categories as $category)
                      <option>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select v-model="genre_selected">
                    @foreach($genres as $genre)
                      <option>{{$genre->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <div class="box">
                  <select v-model="vote_selected">
                    @for($i = 1; $i <= 5; $i++)
                      <option>{{$i}}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <input v-model="reviewNum_selected" type="number" placeholder="Number of views">
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="btn-category">
                <button v-on:click="filterCall" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
       </div>
     </div>
    </div> --}}

   {{-- PROFILES --}}
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