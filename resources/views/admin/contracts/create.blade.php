@extends('layouts.dashboard')

@section('title','Sponsorship Gateway')

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
	#bt_form #card-number, 
	#bt_form #cvv, 
	#bt_form #expiration-date {
		/* MODIFICABILE IN BASE AGLI ALTRI FORM */
		background: white;
		height: 38px;
		border: 1px solid #CED4DA;
		padding: .375rem .75rem;
		border-radius: .25rem;
	}
	#bt_form #bt_message_container {
		display: none;
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

@php

	$my_user 	= Auth::user();
	$my_profile = $my_user->profile;

@endphp

<div class="container" id="bt_form">
	<div class="row justify-content-center">
		<div class="col-xs-10 col-sm-12 col-md-9 col-lg-7 col-xl-6">

			<div class="content">

				<div class="d-flex justify-content-between align-items-center">
					<h1>{{ucwords($sponsorship->name)}}</h1>
					<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
				</div>
				<div class="vertical_spacer"></div>
				<h4>{{$sponsorship->description}}</h4>
				<div class="vertical_spacer"></div>
		
				{{-- FORM FEEDBACK MESSAGE (retrieved via js) --}}
				<div id="bt_message_container">
					<div id="bt_message_box" class="alert alert-danger"></div>
					<div class="vertical_spacer"></div>
				</div>
		
				{{-- TRANSACTION FORM --}}	
				<form action="{{ route('checkout') }}" method="POST" id="payment-form">
					@csrf
		
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" value="{{ $my_user->email }}" readonly required>
					</div>
					<div class="form-group">
						<label for="name_on_card">Name on Card <span class="required_input_field">*</span></label>
						<input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{ $my_user->name.' '.$my_user->surname }}" required>
					</div>
		
					{{-- <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="city">City</label>
								<input type="text" class="form-control" id="city" name="city">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="province">Province</label>
								<input type="text" class="form-control" id="province" name="province">
							</div>
						</div>
					</div> --}}
		
					{{-- <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="postalcode">Postal Code</label>
								<input type="text" class="form-control" id="postalcode" name="postalcode">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="country">Country</label>
								<input type="text" class="form-control" id="country" name="country">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" class="form-control" id="phone" name="phone">
							</div>
						</div>
					</div> --}}
		
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="amount">Amount (€)</label>
								<input type="text" class="form-control" id="amount" name="amount" value="{{ $sponsorship->price }}" data-type="currency" readonly required> 
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-12 col-md-6">
							<label for="cc_number">Credit Card Number <span class="required_input_field">*</span></label>
							<div class="form-group" id="card-number"></div>
						</div>
		
						<div class="col-6 col-md-3">
							<label for="expiry">Expiry <span class="required_input_field">*</span></label>
							<div class="form-group" id="expiration-date"></div>
						</div>
		
						<div class="col-6 col-md-3">
							<label for="cvv">CVV <span class="required_input_field">*</span></label>
							<div class="form-group" id="cvv"></div>
						</div>
					</div>
		
		
					<div><span class="required_input_field">* Required informations</span></div>
					<div class="vertical_spacer"></div>
					<div id="paypal-button"></div>
					<div class="vertical_spacer"></div>
		
					<input id="nonce" name="payment_method_nonce" type="hidden" />
		
					{{-- faccio confluire di nascosto nel form id e durata della sponsorship --}}
					<input id="nonce" name="sponsorship_id" type="hidden" value="{{$sponsorship->id}}" />
					<input id="nonce" name="sponsorship_hour_duration" type="hidden" value="{{$sponsorship->hour_duration}}" />
		
					<div class="row">
						<div class="col-12">
							<div class="float-right">
								<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
								<button type="submit" class="btn btn-success">Submit Payment</button>
							</div>
						</div>
					</div>
		
				</form>

			</div> <!-- content (card) -->
			<div class="vertical_spacer"></div>
	
		</div>
	</div>
</div>

{{-- INCLUDE MODAL DELETE PROFILE --}}

@include('partials.modal_profile_delete')


{{-- RISORSE ESTERNE --}}
<!-- Braintree + form customizzabile -->
<script type="application/javascript" src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
<script type="application/javascript" src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
<!-- PayPal + Checkout -->
<script type="application/javascript" src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>
<script type="application/javascript" src="https://js.braintreegateway.com/web/3.38.1/js/paypal-checkout.min.js"></script>

<script type="application/javascript">
	var form = document.querySelector('#payment-form');
	var submit = document.querySelector('input[type="submit"]'); // ! QUESTO È SBAGLIATO !

	braintree.client.create({
		// Insert your tokenization key here
		authorization: '{{ $token }}'  			// ! TOKEN HERE !
	}, function (clientErr, clientInstance) {
		if (clientErr) {
			console.log('error1');
			console.error(clientErr);
			return;
		}
		// This example shows Hosted Fields, but you can also use this
		// client instance to create additional components here, such as
		// PayPal or Data Collector.

		// Create a hostedFields component to initialize the form
		braintree.hostedFields.create({
			client: clientInstance,
			styles: {
				'input': {
					'font-size': '14px'
				},
				'input.invalid': {
					'color': 'red'
				},
				'input.valid': {
					'color': 'green'
				}
			},
			// Configure which fields in your card form will be generated by Hosted Fields instead
			fields: {
				number: {
					selector: '#card-number',
					placeholder: '4242 4242 4242 4242',
				},
				cvv: {
					selector: '#cvv',
					placeholder: '123'
				},
				expirationDate: {
					selector: '#expiration-date',
					placeholder: '12/22'
				}
			}
		}, 
		function (hostedFieldsErr, hostedFieldsInstance) {
			if (hostedFieldsErr) {
				console.log('error2');
				console.error(hostedFieldsErr);
				return;
			}

			// Once the fields are initialized enable the submit button
			// submit.removeAttribute('disabled');

			// Initialize the form submit event
			form.addEventListener('submit', function (event) {
				event.preventDefault();

				// When the user clicks on the 'Submit payment' button this code will send the
				// encrypted payment information in a variable called a payment method nonce
				hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
					if (tokenizeErr) {
						console.error(tokenizeErr);
						// error message for the user ///////////////////////////////
						console.log('tokenizeErr[\'message\']: ',tokenizeErr['message']);
						document.getElementById('bt_message_container').style.display = 'block';
						const msg_box = document.getElementById('bt_message_box');
						var msg = tokenizeErr['message'];
						if (msg.includes('All fields are empty')) {
							msg = 'All credit card input fields are empty';
						} else if (msg.includes('Some payment input fields are invalid')) {
							msg = 'Some credit card input fields are invalid';
						}
						msg_box.innerHTML = msg;
						/////////////////////////////////////////////////////////////
						return;
					}
					// If this was a real integration, this is where you would
					// send the nonce to your server.
					// console.log('Got a nonce: ' + payload.nonce);
					document.querySelector('#nonce').value = payload.nonce;
					form.submit();
				});
			}, false);
		});


		// Create a PayPal Checkout component.
		braintree.paypalCheckout.create({
			client: clientInstance
		}, 
		function (paypalCheckoutErr, paypalCheckoutInstance) {
			// Stop if there was a problem creating PayPal Checkout.
			// This could happen if there was a network error or if it's incorrectly
			// configured.
			if (paypalCheckoutErr) {
				console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
				return;
			}
			// Set up PayPal with the checkout.js library
			paypal.Button.render({
				env: 'sandbox', // or 'production'
				commit: true,
				payment: function () {
					return paypalCheckoutInstance.createPayment({
						// Your PayPal options here. For available options, see
						// http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
						flow: 'checkout', // Required
						amount: 13.00, // Required
						currency: 'USD', // Required
					});
				},
				onAuthorize: function (data, actions) {
					return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
						// Submit `payload.nonce` to your server.
						document.querySelector('#nonce').value = payload.nonce;
						form.submit();
					});
				},
				onCancel: function (data) {
					console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
				},
				onError: function (err) {
					console.error('checkout.js error', err);
				}
			}, 
			'#paypal-button').then(function () {
				// The PayPal button will be rendered in an html element with the id
				// `paypal-button`. This function will be called when the PayPal button
				// is set up and ready to be used.
			});
		});
	});
</script>


@endsection





{{-- <h2>MODEL: Contract, CRUD: create, AREA: admin - FORM CREAZIONE CONTRACT (info pagamento)</h2>
<h5>URL</h5>
<p>url: http://localhost:8000/admin/sponsorship (get)</p>
<h5>SINGOLA SPONSORSHIP PASSATA</h5>
<p>sponsorship->id = @php echo $sponsorship->id @endphp</p>
<p>sponsorship->name = @php echo $sponsorship->name @endphp</p>
<p>dump($sponsorship) = @dump($sponsorship)</p>
<h5>TOKEN PASSATO</h5>
<p>dump($token) = @dump($token)</p>
<h5>ALTRE TABELLE DISPONIBILI</h5>
<p>dump($users) = @dump($users)</p>
<p>dump($profiles) = @dump($profiles)</p>
<p>dump($categories) = @dump($categories)</p>
<p>dump($genres) = @dump($genres)</p>
<p>dump($offers) = @dump($offers)</p>
<p>dump($messages) = @dump($messages)</p>
<p>dump($reviews) = @dump($reviews)</p>
<p>dump($sponsorships) = @dump($sponsorships)</p>
@dd('') --}}

{{-- 
	VALORI DI IMMISSIONE PER TEST TRANSAZIONE
	https://developer.paypal.com/braintree/docs/reference/general/testing 
--}}