@extends('layouts.dashboard')

@section('title','Create Profile')

{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/dashboard.blade.php

	TODO >>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<
	<!-- Styles: single page addendum -->
	@stack('dashboard_head')
-----------------------------------------------------------}}
@push('dashboard_head')
<style>
	.content {
		background-color: white;
		border-radius: 8px 8px 0 0;
    	box-shadow: 3px 3px 10px #d4d4d4;
    	padding: 25px;
	}
	#preview-image {
		max-width: 100%;
		max-height: 350px;
	}
	.vertical_spacer {
		margin-bottom: 24px;
	}
	.required_input_field {
		color: #e3342f; /* $red */
	}
	button {
		margin-left: 5px;
	}
</style>
@endpush


@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-8">
        	
			<div class="content">

				<div class="d-flex justify-content-between align-items-center">
					<h1>Create your profile</h1>
					<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
				</div>
				<div class="vertical_spacer"></div>
	
				{{-- PROBABILMENTE NON SERVE QUESTO --}}
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
	
				<form action="{{ route('admin.profiles.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('POST') 
	
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Work Town <span class="required_input_field">*</span></label>
								<input type="text" name="work_town" class="form-control @error('work_town') is-invalid @enderror" placeholder="Insert your work town" value="{{ old('work_town') }}" required>
								@error('work_town')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Phone number</label>
								<input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Insert your phone" value="{{ old('phone') }}">
								@error('phone')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
	
					<div class="form-group">
						<label>Work Address</label>
						<input type="text" name="work_address" class="form-control @error('work_address') is-invalid @enderror" placeholder="Insert your work address" value="{{ old('work_address') }}">
						@error('work_address')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label>About me <span class="required_input_field">*</span></label>
						<textarea rows="5" name="bio_text1" class="form-control @error('bio_text1') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{ old('bio_text1') }}</textarea>
						@error('bio_text1')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Professional Services</label>
						<textarea rows="5" name="bio_text2" class="form-control @error('bio_text2') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text2') }}</textarea>
						@error('bio_text2')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Extra informations</label>
						<textarea rows="5" name="bio_text3" class="form-control @error('bio_text3') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text3') }}</textarea>
						@error('bio_text3')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Preview text (for short presentation in Search Pages) <span class="required_input_field">*</span></label>
						<textarea rows="2" name="bio_text4" class="form-control @error('bio_text4') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{ old('bio_text4') }}</textarea>
						@error('bio_text4')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Your profile image <span class="required_input_field">*</span></label>
						<input type="file" name="image_url" id="image_url" class="form-control-file @error('image_url') is-invalid @enderror" value="{{ old('image_url') }}" required>
						@error('image_url')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
						<div class="vertical_spacer"></div>
						<img id="preview-image" src="{{ asset('img/choose_your_image.png') }}" alt="preview image">
					</div>
	
					{{-- <div class="form-group">
						<label>Your video essay</label>
						<input type="file" name="video_url" class="form-control-file @error('video_url') is-invalid @enderror" value="{{ old('video_url') }}">
						@error('video_url')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div> --}}
					{{-- <div class="form-group">
						<label>Your audio preview</label>
						<input type="file" name="audio_url" class="form-control-file @error('audio_url') is-invalid @enderror" value="{{ old('audio_url') }}">
						@error('audio_url')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div> --}}
	
					<div class="vertical_spacer"></div>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<p>Select your Category <span class="required_input_field">*</span></p>
								@foreach ($categories as $category)
									<div class="form-check @error('categories') is-invalid @enderror">
										<input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"
										{{ in_array($category->id, old('categories', [])) ? 'checked=checked' : '' }}>
										<label class="form-check-label">
											{{ ucwords($category->name) }}
										</label>
									</div>
								@endforeach
								@error('categories')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>		
						</div>
						<div class="col-4">
							<div class="form-group">
								<p>Select your Genre</p>
								@foreach ($genres as $genre)
									<div class="form-check @error('genres') is-invalid @enderror">
										<input name="genres[]" class="form-check-input" type="checkbox" value="{{ $genre->id }}"
										{{ in_array($genre->id, old('genres', [])) ? 'checked=checked' : '' }}>
										<label class="form-check-label">
											{{ ucwords($genre->name) }}
										</label>
									</div>
								@endforeach
								@error('genres')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>		
						</div>
						<div class="col-4">
							<div class="form-group">
								<p>Select your Offer <span class="required_input_field">*</span></p>
								@foreach ($offers as $offer)
									<div class="form-check @error('offers') is-invalid @enderror">
										<input name="offers[]" class="form-check-input" type="checkbox" value="{{ $offer->id }}"
										{{ in_array($offer->id, old('offers', [])) ? 'checked=checked' : '' }}>
										<label class="form-check-label">
											{{ ucwords($offer->name) }}
										</label>
									</div>
								@endforeach
								@error('offers')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>		
						</div>
					</div>
	
					<div><span class="required_input_field">* Required informations</span></div>
	
					<div class="row">
						<div class="col-12">
							<div class="float-right">
								<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
								<button type="submit" class="btn btn-success">Create Profile</button>
							</div>
						</div>
					</div>	

				</form>
	
			</div> <!-- content (card) -->
			<div class="vertical_spacer"></div>

        </div>
    </div>
</div>


@endsection

{{------------------------------------------------------------------
	CREATE PROFILE ADMIN

	vedo tutti i dettagli in form vuoto

------------------------------------------------------------------}}
{{-- <h2>MODEL: Profile, CRUD: create, AREA: admin - FORM CREAZIONE PROFILO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/profiles/create (get)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
@dd('') --}}

