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
		/**
		 * Genre Model $fillable:
		 * 	'name', 'description'
		 */

		$genres = [
			'rock',
			'pop',
			'hard rock',
			'metal',
			'classical',
			'hip hop',
			'jazz',
			'country',
			'blues',
			'progressive rock',
			'folk',
			'r&b',
			'reggae',
			'soul',
			'funk',
			'techno',
			'punk rock',
			'gospel',
			'new-age',
			'reggaeton',
		];

		sort($genres);

		foreach($genres as $genre) {

			$new_genre = new Genre();
			$new_genre['name'] = $genre;
			$new_genre['description'] = $faker->text();
			$new_genre->save(); // ! DB writing here ! 

		}
		
    }
}
