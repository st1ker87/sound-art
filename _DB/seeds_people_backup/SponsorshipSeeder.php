<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/**
		 * Sponsorship Model $fillable:
		 * 	'name', 'description', 'hour_duration', 'price', 'is_active'
		 */

		$products = [
			[
				'name' 			=> 'silver sponsorship',
				'description' 	=> 'Your Profile is highlighted in search results for 24 hours',
				'hour_duration' => 24,
				'price' 		=> 2.99,
				'is_active' 	=> 1
			],
			[
				'name' 			=> 'gold sponsorship',
				'description' 	=> 'Your Profile is highlighted in search results for 72 hours',
				'hour_duration' => 72,
				'price' 		=> 5.99,
				'is_active' 	=> 1
			],
			[
				'name' 			=> 'platinum sponsorship',
				'description' 	=> 'Your Profile is highlighted in search results for 144 hours',
				'hour_duration' => 144,
				'price' 		=> 9.99,
				'is_active' 	=> 1
			],
		];

		foreach ($products as $product) {
			
			$new_sponsorship = new Sponsorship();
			$new_sponsorship['name'] 			= $product['name'];
			$new_sponsorship['description'] 	= $product['description'];
			$new_sponsorship['hour_duration'] 	= $product['hour_duration'];
			$new_sponsorship['price'] 			= $product['price'];
			$new_sponsorship['is_active'] 		= $product['is_active'];
			$new_sponsorship->save(); // ! DB writing here ! 

		}
    }
}
