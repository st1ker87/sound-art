<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contract;
use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;
use App\Sponsorship;

class ContractController extends Controller
{
    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             CREATE            %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// ! creation only for users without sponsorship
		//

		// con \Braintree invece di Braintree risolvo la classe introvabile... 
		$gateway = new \Braintree\Gateway([
			'environment' 	=> config('services.braintree.environment'),
			'merchantId' 	=> config('services.braintree.merchantId'),
			'publicKey' 	=> config('services.braintree.publicKey'),
			'privateKey' 	=> config('services.braintree.privateKey')
		]);

		$token = $gateway->ClientToken()->generate();

		$data = [
			'token'			=> $token,
			'users' 		=> User::all(),		
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'sponsorships' 	=> Sponsorship::all(),
 		];

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
		// ! DEVO PORTARMI DIETRO IL PREZZO DELLA SPONSORSHIP SCELTA

		// @dd($request);

		$gateway = new \Braintree\Gateway([
			'environment' 	=> config('services.braintree.environment'),
			'merchantId' 	=> config('services.braintree.merchantId'),
			'publicKey' 	=> config('services.braintree.publicKey'),
			'privateKey' 	=> config('services.braintree.privateKey')
		]);
		
		$amount = $request->amount;
		$nonce = $request->payment_method_nonce;

		// added custom fields to send to BT platform
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

		// @dd($result);

		// if ($result->success || !is_null($result->transaction)) {
		if ($result->success) {
			$transaction = $result->transaction;
			// // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);

			// ! SALVARE DATI SU TABELLA CONTRACTS
			// mi devo portare dietro: sponsorship > id e hour_duration
			// user_id = Auth::id()
			// sponsorship_id = sponsorship > id
			// transaction_status = $transaction->status (string)
			// $new_contract->save()
			// date_start = created_at
			// date_end =  created_at + sponsorship > hour_duration

			return back()->with(
				'success_message',
				'Transaction successful.'.
				' Id: '.$transaction->id.
				' Amount: '.$transaction->amount.
				' Status: '.$transaction->status
			);
			// ! return redirect()->route('braintree')->with('success_message','Transaction successful with ID: '.$transaction->id);
		} else {
			$errorString = "";
			foreach ($result->errors->deepAll() as $error) {
				$errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
			}
			// // $_SESSION["errors"] = $errorString;
			// // header("Location: " . $baseUrl . "index.php");
			return back()->withErrors('Transaction unsuccessful. Message: '.$result->message);
			// ! return redirect()->route('braintree')->withErrors('Transaction unsuccessful. Message: '.$result->message);
		}

    }










    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
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
