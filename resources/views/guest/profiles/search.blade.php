{{------------------------------------------------------------------
	ADEVANCED SEARCH PROFILE PER TUTTI

	equivale a index.blade.php

------------------------------------------------------------------}}
{{-- <h2>MODEL: Profile, CRUD: index (search / search_from_home), AREA: guest - ELENCO PROFILI</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/search (get)</p>
<h5>PARAMETRO FILTRO PASSATO DALLA RICERCA SEMPLICE</h5>
@isset($search_from_home)
	<p>dump($search_from_home) = @dump($search_from_home)</p>
@else 
	{{'$search_from_home non disponibile, sei arrivato qui senza ricerca semplice'}}
@endisset
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
@dd('') --}}

@php
if(isset($search_from_home)) {

  $is_category = array_key_exists('category',$search_from_home);
  $is_genre = array_key_exists('genre',$search_from_home);
  if ($is_category) {
    $search_from_home_key = 'category';
    $search_from_home_value = $search_from_home['category'];
  } else if ($is_genre) {
    $search_from_home_key = 'genre';
    $search_from_home_value = $search_from_home['genre'];
  } 
  else {
      $search_from_home_key = '';
      $search_from_home_value = '';
    }
}
else {
  $search_from_home_key = '';
  $search_from_home_value = '';
}

@endphp

<script type="text/javascript">
    const search_from_home_key 	= '<?php echo $search_from_home_key; ?>';
    const search_from_home_value= '<?php echo $search_from_home_value; ?>';
</script>

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
              <button id="prova" v-on:click="showCategory" type="button">@{{btnCategories}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showCategoryPannel" class="search">
                <div class="categories-cnt">
                    <ul>
                      <li><input v-on:click="setCategory($event.target.value)" type="button" value="No filter"></li>
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
                      <li><input v-on:click="setCategory($event.target.value)" type="button" value="No filter"></li>
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
                      <li><input v-on:click="setCategory($event.target.value)" type="button" value="No filter"></li>
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

    {{-- CARDS --}}
    <section class="card-list">
      <div class="container">
        <div class="row">
          <div v-for="(card, index) in iper_profiles" :key="card.id" class="col-lg-3 col-md-4 col-sm-6">
            <div class="card-cnt">

              {{-- CARD IMAGE --}}
              <div class="card-image">
                <img src="{{ asset('img/singer_photo.jpg') }}" alt="Artist image">
              </div>

              {{-- BODY DELLA CARTA --}}
              <div class="card-content">

                {{-- Categories --}}
                <div class="provided-card-title">
                  <a class="provided-categories" v-bind:href="'search/' + card.slug">
                    <h3>
                      <span v-for="category, index in card.categories" :key="category.id" v-if="index < 3">@{{category}}
                        <span v-if="index < (card.categories.length - 1)">/</span>
                      </span>          
                    </h3>
                  </a>

                  {{--Name, Surname, Work town--}}
                  <a class="provided-name" v-bind:href="'search/' + card.slug">
                    <span>@{{card.name}} @{{card.surname}}</span>
                  </a>
                  <span>, @{{card.work_town}}</span>
                </div>

                {{-- Vote --}}
                <div class="vote">
                    <i v-for="filled in Math.round(card.average_vote)" :key="filled.id" class="fas fa-star filled"></i>
                    <i v-if="Math.round(card.average_vote) < 5" v-for="empty in (5 - Math.round(card.average_vote))" :key="empty.id" class="fas fa-star empty"></i>
                    <span>(@{{card.rev_count}})</span>     
                </div>

                {{-- DESCRIZIONE --}}
                <div class="provided-description">
                  <p>
                    @{{card.bio_text4.substring(0, 90)}}
                    <span v-if="card.bio_text4.length > 80">...</span>
                  </p>
                </div>

                {{-- Genres --}}
                <div class="provided-genres">
                  <h6>Genres</h6>
                  <span v-for="genre, index in card.genres" :key="genre.id" v-if="index < 5">
                      @{{genre}}
                      <span v-if="index < card.genres.length - 1">/</span>
                  </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection

@section('footer')
    @include('partials.footer_search')
@endsection