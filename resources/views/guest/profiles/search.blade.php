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
  </main>

@endsection

@section('footer')
    @include('partials.footer_search')
@endsection