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
      <div class="jumbotron-title flex">
        <h1>Find your Artist</h1>
        <p>Mix & Mastering Engineers, Singers, Recording Studios & Session Musicians for Hire</p>
      </div>
    </section>

    {{-- BARRA RICERCA --}}
    <section class="search-bar-white">
      <div class="container">
        <div class="row">

          {{-- FILTER --}}
          <div class="col-lg-1 flex border-right">
            <button>Filters</button>
          </div>

          <div id="filters-cnt" class="col-lg-10 filters-cnt">
            {{-- CATEGORY --}}
            <div class="categories-pannel flex">
              <label for="category-button">Category:</label>
              <button id="category-button" v-on:click.stop="showCategory" type="button">@{{btnCategories}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showCategoryPannel" class="search">
                <div class="categories-cnt">
                    <ul>
                      <li><input class="btn-no-filter" v-if="btnCategories != 'No filter'" v-on:click="setCategory($event.target.value)" type="button" value="No filter"></li>
                        @foreach($categories as $category)
                        <li>
                            <input v-on:click="setCategory($event.target.value)" type="button" value="{{ucwords($category->name)}}">
                        </li>
                        @endforeach
                    </ul>
                </div>
              </div>
            </div>
  
            {{-- GENRE --}}
            <div class="categories-pannel flex">
              <label for="genre-button">Genre:</label>
              <button id="genre-button" v-on:click.stop="showGenres">@{{btnGeneres}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showGenrePannel" class="search">
                <div class="categories-cnt">
                    <ul>
                      <li><input class="btn-no-filter" v-if="btnGeneres != 'No filter'" v-on:click="setGenre($event.target.value)" type="button" value="No filter"></li>
                        @foreach($genres as $genre)
                        <li>
                            <input v-on:click="setGenre($event.target.value)" type="button" value="{{ucwords($genre->name)}}">
                        </li>
                        @endforeach
                    </ul>
                </div>
              </div>
            </div>
  
            {{-- VOTES --}}
            <div class="categories-pannel flex">
              <label for="votes-button">Votes:</label>
              <button id="votes-button" v-on:click.stop="showVotes">@{{btnVotes}} <i class="fas fa-sort-down"></i></button>
              <div v-if="showVotePannel" class="search">
                <div class="votes-cnt">
                    <ul>
                      <li><input class="btn-no-filter" v-if="btnVotes != 'No filter'" v-on:click="setVote($event.target.value)" type="button" value="No filter"></li>
                      @for($i = 1; $i <= 5; $i++)
                        <li>
                          <input v-on:click="setVote($event.target.value)" type="button" value="{{$i}}">
                        </li>
                      @endfor
                    </ul>
                </div>
              </div>
            </div>
  
            {{-- REVIEWS --}}
            <div class="reviews-pannel flex">
              <label for="number-of-views">Reviews:</label>
              <div class="input-cnt">
                <input id="number-of-views" v-model="reviewNum_selected" type="number" placeholder="number">
              </div>
            </div>
  
          </div>
          {{-- SUBMIT --}}
          <div class="col-lg-1 flex submit-btn-cnt">
            <button id="submit-advanced-search" v-on:click="btnSubmit">Submit</button>
          </div>
        </div>
      </div>
    </section>

    @include('partials.cards_search')
  </main>

@endsection

@section('footer')
    @include('partials.footer_search')
@endsection