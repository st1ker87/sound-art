<?php

use Illuminate\Database\Seeder;
use App\Genre;
use Faker\Generator as Faker;

class GenreSeeder extends Seeder
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

		$genres = [
			'Rock',
			'Pop',
			'Hard Rock',
			'Metal',
			'Classical',
			'Hip Hop',
			'Jazz',
			'Country',
			'Blues',
			'Progressive Rock',
			'Folk',
			'R&B',
			'Reggae',
			'Soul',
			'Funk',
			'Techno',
			'Punk Rock',
			'Gospel',
			'New-age',
			'Reggaeton',
		];

		foreach($genres as $genre) {

			$new_genre = new Genre();
			$new_genre['name'] = $genre;
			$new_genre['description'] = $faker->text();
			$new_genre->save(); // ! DB writing here ! 

		}
		
    }
}
