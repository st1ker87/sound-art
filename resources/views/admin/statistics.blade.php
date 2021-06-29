@extends('layouts.dashboard')

@section('title','Statistics')


@section('content')

@php

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;

@endphp

<h1>Qui le statistiche di {{$my_user->name}}</h1>
<div class="container">
        <canvas id="myCanvas" style="width: 80%; height:50vh; background: lightgrey; margin: 20px 0 40px 0; "></canvas>
    </div>
    {{-- per ogni utente stampami i suoi messaggi --}}
    <script>
        // javascript normale
        //codice che serve per creare il grafico charts.js
        let myCanvas = document.getElementById("myCanvas").getContext('2d');
        let month = ["gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre",];
        let n_messages = ["20","30","50","10","35","21","20","30","50","10","35","21",];
        let chart = new Chart(myCanvas, {
            type:'bar',
            data: {
                labels:month, 
                datasets: [{
                    label: "messaggi",
                    data: n_messages,
                    backgroundColor: 'darkred'
                }]
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            options: {
            }
        });
    </script>

@endsection


{{-- <h5>TABELLE DISPONIBILI</h5>
<p>$users = @dump($users)</p>
<p>$profiles = @dump($profiles)</p>
<p>$categories = @dump($categories)</p>
<p>$genres = @dump($genres)</p>
<p>$offers = @dump($offers)</p>
<p>$messages = @dump($messages)</p>
<p>$reviews = @dump($reviews)</p>
<p>$contracts = @dump($contracts)</p>
<p>$sponsorships = @dump($sponsorships)</p>
@dd('') --}}

{{-- @php

	use App\Classes\IsNowInInterval;

	$my_user		= Auth::user();
	$my_profile		= $my_user->profile;
	$my_contracts	= $my_user->contracts;
	$is_any_contract = (!$my_contracts->isEmpty());
	$is_active_sponsorship = false;
	foreach ($my_contracts as $my_contract) {
		if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) {
			$is_active_sponsorship = true;
		}
	}
	
	foreach ($my_user->messages as $message) {
		# code...
	}

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <title>Document</title> --}}
    {{-- <style> --}}
        {{-- /* body {
            margin: 120px 100px 10px 100px;
            padding: 0;
            color:white;
            text-align:center;
            background-color: #555652; 
        } */
        /* .container  {
            color: #E8E9EB;
            background-color: #222;
            border: #555652 1px solid;
            padding:10px;
        } */ --}}
    {{-- </style>
</head>
<body>
    <div class="container">
        <canvas id="myCanvas" style="width: 100%; height:60v; background: orange; border: 1px solid yellow; margin-top: 10px; "></canvas>
    </div> --}}
    {{-- per ogni utente stampami i suoi messaggi --}}
    {{-- <script> --}}
        {{-- // javascript normale
        //codice che serve per creare il grafico charts.js
        let myCanvas = document.getElementById("myCanvas").getContext('2d');
        let month = ["gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre",];
        let n_messages = ["20","30","50","10","35","21","20","30","50","10","35","21",];
        let chart = new Chart(myCanvas, {
            type:'line',
            data: {
                labels:month, 
                datasets: [{
                    label: "messaggi",
                    data: n_messages,
                    backgroundColor: 'red'
                }]
            },
            options: {
            }
        });
    </script>
</body>
</html> --}}