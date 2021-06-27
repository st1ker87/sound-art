{{------------------------------------------------------------------
	ADMIN HOME

	attualmente contiene form login (ma non dovrà stare qua)
		
	rifare da zero
------------------------------------------------------------------}}
@extends('layouts.app')

@section('title', 'admin-home')
@section('content')
<main class="py-4">

	{{-- form login orignale laravel: non serve qui --}}
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Dashboard') }}</div>
	
					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
							{{-- mi avete trovato? --}}
						{{ __('You are logged in!') }}
					</div>
				</div>
			</div>
		</div>
	</div>

</main>
@endsection
