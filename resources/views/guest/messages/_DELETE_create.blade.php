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

<section class="container main-show">
    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center">
                <h1>Contact {{$user->name}}</h1>
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

            <form action="{{ route('messages_store',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
				@method('POST') 

				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Email <span class="required_input_field">*</span></label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Insert your email" value="{{ old('email') }}" required>
							@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-6">
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
					<label>Subject <span class="required_input_field">*</span></label>
					<input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="You ask for..." value="{{ old('subject') }}" required>
					@error('subject')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
                <div class="form-group">
                    <label>Text <span class="required_input_field">*</span></label>
                    <textarea rows="5" name="text" class="form-control @error('text') is-invalid @enderror" rows="10" placeholder="Write here your message please..." required>{{ old('text') }}</textarea>
                    @error('text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

				<div><span class="required_input_field">* Required informations</span></div>
				<div class="vertical_spacer"></div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Send your message to {{$user->name}}</button>
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
	CREATE MESSAGE 

	IL CONTENUTO DI QUESTA PAGINA VA DENTRO L'OVERLAY APERTO IN guest/profiles/show


------------------------------------------------------------------}}
{{-- <h2>MODEL: Message, CRUD: create, AREA: guest - FORM INSERIMENTO MESSAGGIO</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/messages/create/{slug} (get)</p>
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


