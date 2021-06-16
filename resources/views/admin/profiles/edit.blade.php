{{------------------------------------------------------------------
	EDIT PROFILE ADMIN

	vedo tutti i dettagli in form autocompilato

	
	
------------------------------------------------------------------}}
{{-- <h2>MODEL: Profile, CRUD: edit, AREA: admin - FORM COMPIALTO EDIT PROFILO - SOLO SE STESSO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/profiles/{slug}/edit (get)</p>
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

{{------------------------------------------------------------------
	CREATE PROFILE ADMIN

	vedo tutti i dettagli in form vuoto

<<<<<<< HEAD

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


{{-- ------------------------------------------------------------ --}}
{{-- CONTROLLO CHE AUTENTICATO CORRISPONDA A UTENTE PROFILO EDIT  --}}
{{-- ------------------------------------------------------------ --}}


<div class="container">
  <div class="row justify-content-center">
      <div class="col-12">
          <div class="d-flex justify-content-between align-items-center">
              <h1>Edit your profile</h1>
          </div>
          <div>
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </div>
          <form action="{{ route('admin.profiles.update', ['profile'=>$profile->id]) }}" method="post" enctype="multipart/form-data">
              @csrf
      @method('PUT') 
              <div class="form-group">
                  <label>Work Town</label>
                  <input type="text" name="work_town" class="form-control @error('work_town') is-invalid @enderror" placeholder="Work town" value="{{ old('work_town', $profile->work_town)}}">
                  @error('work_town')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Work Address</label>
                  <input type="text" name="work_address" class="form-control @error('work_address') is-invalid @enderror" placeholder="Insert your work address" value="{{ old('work_address', $profile->work_address) }}">
                  @error('work_address')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Phone number</label>
                  <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Insert your phone" value="{{ old('phone', $profile->phone) }}">
                  @error('phone')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>bio_text1</label>
                  <textarea name="bio_text1" class="form-control @error('bio_text1') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text1', $profile->bio_text1) }}</textarea>
                  @error('bio_text1')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>bio_text2</label>
                  <textarea name="bio_text2" class="form-control @error('bio_text2') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text2', $profile->bio_text2) }}</textarea>
                  @error('bio_text2')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>bio_text3</label>
                  <textarea name="bio_text3" class="form-control @error('bio_text3') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text3', $profile->bio_text3) }}</textarea>
                  @error('bio_text3')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>bio_text4</label>
                  <textarea name="bio_text4" class="form-control @error('bio_text4') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa...">{{ old('bio_text4', $profile->bio_text4) }}</textarea>
                  @error('bio_text4')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Your profile image</label>
                  <input type="file" name="image_url" class="form-control-file @error('image_url') is-invalid @enderror" value="{{ old('image_url', $profile->image_url) }}">
                  @error('image_url')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Your video essay</label>
                  <input type="file" name="video_url" class="form-control-file @error('video_url') is-invalid @enderror" value="{{ old('video_url', $profile->video_url) }}">
                  @error('video_url')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Your audio preview</label>
                  <input type="file" name="audio_url" class="form-control-file @error('audio_url') is-invalid @enderror" value="{{ old('audio_url', $profile->audio_url) }}">
                  @error('audio_url')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <p>Select your Category</p>
            @foreach ($categories as $category)
              <div class="form-check @error('categories') is-invalid @enderror">
                <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"
                {{$profile->user->categories->contains($category) ? 'checked=checked' : ''}}>
                <label class="form-check-label">
                  {{ $category->name }}
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
                {{$profile->user->genres->contains($genre) ? 'checked=checked' : ''}}>
                <label class="form-check-label">
                  {{ $genre->name }}
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
            <p>Select your Offer</p>
            @foreach ($offers as $offer)
              <div class="form-check @error('offers') is-invalid @enderror">
                <input name="offers[]" class="form-check-input" type="checkbox" value="{{ $offer->id }}"
                {{$profile->user->offers->contains($offer) ? 'checked=checked' : ''}}>
                <label class="form-check-label">
                  {{ $offer->name }}
                </label>
              </div>
            @endforeach
            @error('offers')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>		
        </div>
      </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Edit Profile
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>

