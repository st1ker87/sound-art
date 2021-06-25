@extends('layouts.dashboard')

@section('title','dashboard-messages')
@section('content')

@php

	use App\Classes\DateDisplay;

	$my_user 	= Auth::user();
	$my_profile = $my_user->profile;

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-12">
        	
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
			{{-- FINE FEEDBACK MESSAGES --}}

			<div class="d-flex justify-content-between align-items-center">
            	<h2>Your message box</h2>
			</div>

			@if(count($my_user->messages)>0)

				@foreach ($my_user->messages->sortByDesc('created_at') as $message)
					{{-- MESSAGE BOX --}}
					<div class="msg_box">
						<div class="content">
							<div class="msg_date">
								{{ (new DateDisplay)->get($message->created_at) }}
								@if ($message->msg_sender_name)
									by <span class="sender_name">{{ $message->msg_sender_name }}</span>						
								@endif
							</div>
							<div class="msg_sender_mail">{{ $message->msg_sender_email}}</div>
							<div class="msg_obj">{{ $message->msg_subject}}</div>
							<div class="msg_txt">{{ $message->msg_text}}</div>
							{{-- DELETE --}}
							<form class="d-inline-block msg_delete" action="{{ route('admin.messages.destroy',$message->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
							</form>
						</div>
					</div>
				@endforeach	

			@else
				<p>No messages to show.</p>
			@endif

        </div>
	</div>
</div>


@endsection




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

