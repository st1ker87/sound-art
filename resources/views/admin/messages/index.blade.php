@extends('layouts.dashboard')

@section('title','Messages')

{{----------------------------------------------------------- 
	AGGIUNTO IN layouts/dashboard.blade.php

	>>> TEMPORANEO: PORTARE POI IN SASS QUESTO STILE <<<
	<!-- Styles: single page addendum -->
	@stack('dashboard_head')
-----------------------------------------------------------}}
@push('dashboard_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}
	.msg_delete,
	.required_input_field {
		color: #e3342f; /* $red */
	}
	.msg_delete:hover {
		color: #d3231d; /* custom */
	}
	.modal-header,
	.modal-footer {
		border: none;
	}
	.modal-title {
		color: #212949; /* $primaryDarkBlue */
	}
	.modal-footer button {
		margin-left: 5px;
	}
</style>
@endpush


@section('content')

@php

	use App\Classes\DateDisplay;

	$my_user 	= Auth::user();
	$my_profile = $my_user->profile;

@endphp

<div class="container">
	<div class="row justify-content-center">
    	<div class="col-12 col-md-10 col-lg-8 col-xl-7">
        	
			{{-- FEEDBACK MESSAGES --}}
			<div class="d-flex justify-content-between align-items-center">
				
				{{-- redirect with() [success] --}}
				@if (session()->has('status'))
					<div class="alert alert-success col-12">
						{{ session()->get('status') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				{{-- transaction result with() [success] --}}
				@if (session()->has('transaction_feedbak'))
					<div class="alert alert-success col-12">
						{{ session()->get('transaction_feedbak') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				{{-- redirect withErrors() [errors] --}}
				@if(count($errors) > 0)
					<div class="alert alert-danger col-12">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
			</div>
			{{-- FINE FEEDBACK MESSAGES --}}

			<div class="d-flex">
				<h2 class="mr-auto p-2">Your Message Box</h2>
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
							<div class="msg_txt limit">{{ $message->msg_text}}</div>
							{{-- DELETE --}}
							{{-- ORIGINAL BUTTON ----------------------------------------------------------}}
							{{-- <form class="d-inline-block msg_delete" action="{{ route('admin.messages.destroy',$message->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
							</form> --}}
							{{-- MODAL BUTTON -------------------------------------------------------------}}
							<button type="submit" class="btn btn-link msg_delete" data-toggle="modal" data-target="#modal-delete-{{$message->id}}"><i class="fas fa-trash-alt"></i></button>
							{{-----------------------------------------------------------------------------}}
						</div>
					</div>

					{{----------------------------------------------------------------------------}}
					{{-- MODAL CONTENTS start ----------------------------------------------------}}


					<!-- MODAL DELETE MESSAGE start-->
					<div class="modal fade" id="modal-delete-{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-header">
									<h3 class="modal-title" id="demoModalLabel">Message Delete</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>

								<div class="modal-body">
									<p>Are you sure you want to delete the message from {{$message->msg_sender_name}}?</p>
									<p>This action can't be undone.</p>
								</div>

								<div class="modal-footer">
									<div>
										<form class="d-inline-block btn-block" action="{{ route('admin.messages.destroy',$message->id) }}" method="post">
											@csrf
											@method('DELETE')
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
											<button type="submit" class="btn btn-danger">Confirm Delete</button>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- MODAL DELETE MESSAGE end-->


					{{-- MODAL CONTENTS end ------------------------------------------------------}}
					{{----------------------------------------------------------------------------}}

				@endforeach	

			@else
				<p>No messages to show.</p>
			@endif

        </div>
	</div>
</div>

{{-- INCLUDE MODAL DELETE PROFILE --}}

@include('partials.modal_profile_delete')



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

