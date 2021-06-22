{{-- <h2>MODEL: Message, CRUD: index, AREA: admin - ELENCO MESSAGGI</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/messages (get)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p> --}}

{{-- dati user autenticato --}}
@php
	$my_user 	= Auth::user();
	$my_profile = Auth::user()->profile;
@endphp

@extends('layouts.dashboard')

@section('title','dashboard-messages')
@section('content')

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12">
        	
			<div class="d-flex justify-content-between align-items-center">
            	<h2>Your message box</h2>
			</div>

			{{-- FEEDBACK MESSAGES --}}
			<div class="d-flex justify-content-between align-items-center">
				
				{{-- redirect with() [success] --}}
				@if (session()->has('status'))
				<div class="alert alert-success">
					{{ session()->get('status') }}
				</div>
				@endif
				{{-- transaction result with() [success] --}}
				@if (session()->has('transaction_feedbak'))
					<div class="alert alert-success">
						{{ session()->get('transaction_feedbak') }}
					</div>
				@endif
				{{-- redirect withErrors() [errors] --}}
				@if(count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

			</div>
			@if(count($my_user->messages)>0)
				<div class="row">
					@foreach ($my_user->messages as $message)
						<div class="msg_box col-xl-8">
							<div class="msg_head">
								<div class="row">
									<span class="msg_date col-md-4">{{ $message->created_at}}</span>
									<span class="msg_sender col-md-4">from: {{ $message->msg_sender_name}}</span>
									<span class="msg_sender_mail col-md-4">{{ $message->msg_sender_email}}</span>
									<span class="msg_obj col-md-12">{{ $message->msg_subject}}</span>
								</div>
							</div>
							<div class="msg_content row">
								<span class="msg_txt col-md-8">
									@if (strlen($message->msg_text)>50)
										
									@endif{{ $message->msg_text}}</span>
								
								{{-- DELETE --}}
								<form class="d-inline-block msg_delete" action="{{ route('admin.messages.destroy',$message->id) }}" method="post">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>

							</div>
	
	
						</div>
					@endforeach	

				</div>
			@else
				<p>No messages to show.</p>
			@endif
        </div>
	</div>
</div>


@endsection
