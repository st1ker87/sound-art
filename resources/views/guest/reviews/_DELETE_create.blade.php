{{--------------------------------------------}}
{{--------------------------------------------}}
{{--------------------------------------------}}
{{--------------------------------------------}}
{{-- PAGINA IN DISUSO PER PASSAGGIO A MODAL --}}
{{--------------------------------------------}}
{{--------------------------------------------}}
{{--------------------------------------------}}
{{--------------------------------------------}}




@extends('layouts.app')

@section('title', 'Search')

{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/app.blade.php

	>>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<
	<!-- Styles: single page addendum -->
	@stack('app_head')
-----------------------------------------------------------}}
@push('app_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}	
	.required_input_field {
		color: #e3342f; /* $red */
	}
</style>
@endpush

@section('header')
  @include('partials.header_search')
@endsection

@section('content')

<section class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center">
                <h1>Write a review for {{$user->name}}</h1>
            </div>

			{{-- SERVE QUESTO ?? --}}
            {{-- <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div> --}}

            <form action="{{ route('reviews_store',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
				@method('POST') 


				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label>Subject <span class="required_input_field">*</span></label>
							<input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="You ask for..." value="{{ old('subject') }}" required>
							@error('subject')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="vote">Vote <span class="required_input_field">*</span></label>
							<select name="vote" id="vote" class="form-control @error('vote') is-invalid @enderror" required>
								<option value="" {{ old('vote') == '' ? 'selected' : '' }}>select</option>
								<option value="1" {{ old('vote') == 1 ? 'selected' : '' }}>1</option>
								<option value="2" {{ old('vote') == 2 ? 'selected' : '' }}>2</option>
								<option value="3" {{ old('vote') == 3 ? 'selected' : '' }}>3</option>
								<option value="4" {{ old('vote') == 4 ? 'selected' : '' }}>4</option>
								<option value="5" {{ old('vote') == 5 ? 'selected' : '' }}>5</option>
							</select>
							@error('vote')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Insert your name" value="{{ old('name') }}">
							@error('name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				<div class="form-group">
                    <label>Text <span class="required_input_field">*</span></label>
                    <textarea rows="5" name="text" class="form-control @error('text') is-invalid @enderror" rows="10" placeholder="Write here your message please..." required>{{ old('text') }}</textarea>
                    @error('bio_text1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

				<div><span class="required_input_field">* Required informations</span></div>
				<div class="vertical_spacer"></div>

				<div class="form-group">
                    <button type="submit" class="btn btn-success">Submit your review for {{$user->name}}</button>
                </div>

            </form>
			
        </div>
    </div>
</section>


@section('footer')
	@include('partials.footer_search')
@endsection


@endsection





{{------------------------------------------------------------------
	CREATE REVIEW 

	IL CONTENUTO DI QUESTA PAGINA VA DENTRO L'OVERLAY APERTO IN guest/profiles/show


------------------------------------------------------------------}}
{{-- <h2>MODEL: Review, CRUD: create, AREA: guest - FORM INSERIMENTO REVIEW</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/reviews/create/{slug} (get)</p>
<h5>UTENTE DESTINATARIO</h5>
<p>$user->id = @php echo $user->id @endphp</p>
<p>dump($user) = @dump($user)</p>
<p>dump($user->profile) = @dump($user->profile)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
@dd('') --}}

