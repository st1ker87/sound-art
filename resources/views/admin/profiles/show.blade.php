{{-- dati user autenticato --}}
@php
	$my_user 	= Auth::user();
	$my_profile = Auth::user()->profile;
@endphp

@extends('layouts.dashboard')

@section('title','dashboard-my-profile')

@section('content')

<div class="row dashboard_home">
	<div class="btn_box col-12">
		<div class="row flex-column align-items-end">
			@if ($my_profile)
				{{-- EDIT PROFILE BUTTON --}}
				<a type="button" class="btn btn-primary my-color" href="{{ route('admin.profiles.edit',$my_profile->slug) }}">Edit Profile</a>
				{{-- DELETE PROFILE BUTTON --}}
				<form class="d-inline-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger btn-block">Delete Profile</button>
				</form>
			@else
				{{-- CREATE PROFILE BUTTON --}}
				<a class="btn btn-primary btn-block" href="{{ route('admin.profiles.create') }}">Create your Profile</a>
			@endif
		</div>		
	</div>
</div>
{{-- sempre presente --}}
	<section class="container main-show" id="about_me">
		<div class="row">
			<div  class="description col-sm-12 col-md-7 col-lg-7">
				@if($my_profile->bio_text1 && $my_profile->bio_text2)
				{{-- <h2>About me</h2> --}}
				<p>{{$my_profile->bio_text1}}</p>
				<p>{{$my_profile->bio_text2}}</p>
				<p>{{$my_profile->bio_text2}}</p>

				@endif
			</div>
		{{-- IMMAGINE RIMOSSA --}}
        	<div  class="offert col-sm-12 col-md-4 offset-md-1 col-lg-4 offest-lg-1">
          		<div class="services">
            		<h2>Services Provided</h2>     
            		<hr>
          			@foreach($my_user->offers as $offer)
						@if($loop->last)
						<p>{{$offer->name}}</p>
						@else
						{{$offer->name . ','}}
						@endif
          			@endforeach
          		</div>
		  		@if ($my_user->genres->isNotEmpty())
         			<div class="fav_music">
                		<div  class="genres">
							<h2>My favorite music</h2>
							<hr>
							@foreach($my_user->genres as $genre)
								<span>{{$genre->name}}</span>
							@endforeach
                		</div>
					</div> 
				@endif
        	</div>
		</div>
	</section>

    {{--:class="{(scrollPosition > scrollChange) ? 'appear' : ''}" --}}
    <a href="#up">
      <div class="freccia_su" >
      <i class="fas fa-arrow-up"></i>
      </div>
    </a>

@endsection
{{-- VECCHIO SHOW PROFILE NELLA DASHBOARD --}}
{{-- <div id="about_me" class="description">
  @if($my_profile->bio_text1 && $my_profile->bio_text2)
    <h2>About me</h2>
    <p>{{$my_profile->bio_text1}}</p>
    <p>{{$my_profile->bio_text2}}</p>
  @endif
</div>

@if (count($my_user->genres)>0)
  <div id="genres" class="genres">
    <h2>My favorite music</h2>
    @foreach($my_profile->user->genres as $genre)
      @if($loop->last)
        {{$genre->name}}
      @else
        {{$genre->name . ','}}
      @endif
    @endforeach
  </div>    
@endif

@if(count($my_profile->user->offers)>0)
  <div id="offers" class="offert">
    <h2>Offers</h2>
    @foreach($my_profile->user->offers as $offer)
      @if($loop->last)
        {{$offer->name}}
      @else
        {{$offer->name . ','}}
      @endif
    @endforeach    
  </div>
@endif

@endsection --}}
{{-- FINE DEL VECCHIO SHOW NELLA DASHBOARD --}}

  {{-- mancante video, audio e foto
    visualizzazione form messaggio, visualizzazione review --}}


{{------------------------------------------------------------------
	SHOW PROFILE ADMIN - SOLO SE STESSO

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
{{-- <h2>MODEL: Profile, CRUD: show, AREA: admin - DETTAGLIO SINGOLO PROFILO - SOLO SE STESSO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/profiles/{slug} (get)</p>
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