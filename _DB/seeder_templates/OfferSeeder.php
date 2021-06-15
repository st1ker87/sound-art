<?php

use Illuminate\Database\Seeder;
use App\Offer;
use Faker\Generator as Faker;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
		// protected $fillable = [
		// 	'name', 'description'
		// ];

		$offers = [
			'teaching',
			'live Exhibition', 
			'collaboration',
			'recording',
		];

		foreach($offers as $offer) {

			$new_offer = new Offer();
			$new_offer['name'] = $offer;
			$new_genre['description'] = $faker->text();
			$new_offer->save(); // ! DB writing here ! 

		}
		
    }
}
