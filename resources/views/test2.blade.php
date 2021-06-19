<h2>TESTACODICE #2</h2>

{{-- ///////////////////////////////////////////// --}}

@php
	echo 'Curl: ', function_exists('curl_version') ? 'Enabled' : 'Disabled';

	// richiede installazione BT
	$gateway = new Braintree\Gateway([
		'environment' => 'sandbox',
		'merchantId' => 'use_your_merchant_id',
		'publicKey' => 'use_your_public_key',
		'privateKey' => 'use_your_private_key'
	]);

@endphp

<head>
	<meta charset="utf-8">
	<script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
</head>
<body>
	<!-- Step one: add an empty container to your page -->
	<div id="dropin-container"></div>
  
	<script type="text/javascript">
	// call `braintree.dropin.create` code here


	// Step two: create a dropin instance using that container (or a string that functions as a query selector such as `#dropin-container`)
	braintree.dropin.create({
		container: document.getElementById('dropin-container'),
		// ...plus remaining configuration
	}).then((dropinInstance) => {
		// Use `dropinInstance` here
		// Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
	}).catch((error) => {});



	</script>
</body>








{{-- ///////////////////////////////////////////// --}}
{{-- ///////// qua sopra scrivi in blade ///////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
////////// qua sotto scrivi in php //////////
/////////////////////////////////////////////












/////////////////////////////////////////////
/////////////////////////////////////////////
/////////////////////////////////////////////
@endphp


