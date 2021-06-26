<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\IsNowInInterval;
use DateTime;

use App\Contract;
use App\Sponsorship;

date_default_timezone_set('Europe/Rome');

class ContractController extends Controller
{
    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             INDEX             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function index() // originale: show(Contract $contract)
    {
		return view('admin.contracts.index');
    }

	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             CREATE            %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
		// choosen sponsorship 
		$sponsorship = Sponsorship::where('id',$id)->first();

		// double check: creation only for users without sponsorship
		$my_contracts = Auth::user()->contracts;
		$is_active_sponsorship = false;
		foreach ($my_contracts as $my_contract) {
			if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) 
				$is_active_sponsorship = true;
		}
		if ($is_active_sponsorship)
			return redirect()->route('dashboard')->withErrors('A Sponsorship is already active!');

		// con \Braintree invece di Braintree risolvo la classe introvabile... 
		$gateway = new \Braintree\Gateway([
			'environment' 	=> config('services.braintree.environment'),
			'merchantId' 	=> config('services.braintree.merchantId'),
			'publicKey' 	=> config('services.braintree.publicKey'),
			'privateKey' 	=> config('services.braintree.privateKey')
		]);

		$token = $gateway->ClientToken()->generate();

		$data = [
			'sponsorship'	=> $sponsorship,
			'token'			=> $token,
		];

		if(!$data['sponsorship'] || !$data['token']) {
			abort(404);
		}

		return view('admin.contracts.create',$data); 

    }

	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %        STORE (CHECKOUT)       %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// validazione 
		$this->contractValidation($request);

		$gateway = new \Braintree\Gateway([
			'environment' 	=> config('services.braintree.environment'),
			'merchantId' 	=> config('services.braintree.merchantId'),
			'publicKey' 	=> config('services.braintree.publicKey'),
			'privateKey' 	=> config('services.braintree.privateKey')
		]);
		
		$amount = $request->amount;
		$nonce = $request->payment_method_nonce;

		// custom fields to send to BT platform
		$result = $gateway->transaction()->sale([
			'amount' => $amount,
			'paymentMethodNonce' => $nonce,
			'creditCard' => [
				'cardholderName' => $request->name_on_card,
			],
			'customer' => [
				'email'	=> $request->email,
			],
			'options' => [
				'submitForSettlement' => true
			]
		]);

		// if ($result->success || !is_null($result->transaction)) {
		if ($result->success) {
			$transaction = $result->transaction;
			// // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);

			// sponsorship id & hour_duration here
			$form_data = $request->all();

			// # NEW CONTRACT #
			$new_contract = new Contract;
			$new_contract['user_id'] = Auth::id();
			$new_contract['sponsorship_id'] = $form_data['sponsorship_id'];
			$new_contract['transaction_status'] = $transaction->status;
			$new_contract->save(); // ! DB writing here !
			// calculating date_start & date_end
			$new_contract['date_start'] = $new_contract->created_at->format('Y-m-d H:i:s');
			// created_at in formato dateTime (per fare calcoli)
			$tmp_time = DateTime::createFromFormat('Y-m-d H:i:s', $new_contract['created_at']);
			// aggiungo numero di ore = sponsorship_hour_duration
			date_add($tmp_time, date_interval_create_from_date_string($form_data['sponsorship_hour_duration'].' hours'));			
			// torno al formato created_at per mettere in DB
			$new_contract['date_end'] = date_format($tmp_time, 'Y-m-d H:i:s');
			$new_contract->update(); // ! DB writing here !

			// # GOOD REDIRECT #
			return redirect()->route('dashboard')->with('transaction_feedbak','Transaction successful. Your Sponsorship is active');
		} else {
			$errorString = "";
			foreach ($result->errors->deepAll() as $error) {
				$errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
			}
			// // $_SESSION["errors"] = $errorString;
			// // header("Location: " . $baseUrl . "index.php");

			// # BAD REDIRECT #
			return redirect()->route('dashboard')->withErrors('Transaction unsuccessful. Message: '.$result->message);
		}

    }


	/**
	 * #################################
	 * #      CONTRACT VALIDATION      #
	 * #################################
     *
	 * Contract: form data validation
	 * https://laravel.com/docs/7.x/validation
	 * errors shown in EDIT/CREATE view
	 * 
	 * @param  \Illuminate\Http\Request  $req
	 */
	protected function contractValidation($req) {
		$req->validate([
			'email'			=> 'required',
			'name_on_card'	=> 'required',
			'amount'		=> 'required',
			'payment_method_nonce'		=> 'required',
			'sponsorship_id'			=> 'required',
			'sponsorship_hour_duration'	=> 'required',
		]);
	}

































    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
