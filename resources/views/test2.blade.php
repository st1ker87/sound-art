<h2>TESTACODICE #2</h2>
{{-- ///////////////////////////////////////////// --}}

  








{{-- ///////////////////////////////////////////// --}}
{{-- ///////// qua sopra scrivi in blade ///////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
////////// qua sotto scrivi in php //////////
/////////////////////////////////////////////


date_default_timezone_set('Europe/Rome');

$hours = 3;

echo 'dateTime (tutte le funzioni php):';
$date = new DateTime();
@dump($date);

echo 'da dateTime a created_at (per il db):';
// $date = $date->format('Y-m-d H:i:s');
$date = date_format($date, 'Y-m-d H:i:s');
@dump($date);

echo 'da created_at a dateTime (tutte le funzioni php):';
$date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
@dump($date); 

echo 'aggiungo 3 ore a dateTime:';
// $date->add(new DateInterval("PT{$hours}H"));
date_add($date, date_interval_create_from_date_string($hours.' hours'));
@dump($date);

echo 'e dopo ritorno a created_at:';
// $date = $date->format('Y-m-d H:i:s');
$date = date_format($date, 'Y-m-d H:i:s');
@dump($date);




// $date->add(new DateInterval('P10D'));
// echo $date->format('Y-m-d') . "\n";







/////////////////////////////////////////////
/////////////////////////////////////////////
/////////////////////////////////////////////
@endphp


