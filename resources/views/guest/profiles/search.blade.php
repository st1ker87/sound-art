{{------------------------------------------------------------------
	ADEVANCED SEARCH PROFILE PER TUTTI

	equivale a index.blade.php


------------------------------------------------------------------}}


@extends('layouts.app')

@section('title', 'Search')
    
@section('content')
  <main>
    {{-- jumbo con testi --}}
    <div class="jumbotron-container-search">
      <div class="container">
        <div class="title-search">
          <h1>Find your Artist</h1>
          <p>Migliorare il testo QUI</p>
        </div>
      </div>
    </div>
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
                <h3>Categories</h3>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <h3>Genres</h3>
              </div>
            </div>
            <div class="filter-show d-inline-block">
              <div class="my-set btn-category">
                <h3>Votes</h3>
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
  </main>

@endsection