<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
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

		$categories = [
			// mestieri generali
			'Band',
			'Singer',
			'Vocalist',
			'Composer',
			'Lyricist',
			'Mixer/Engineer',
			'Record Company',
			'Disc Jockey',
			// strumnetisti
			'Bassist',
			'Guitarist',
			'Drummer',
			'Accordionist',
			'Clarinetist',
			'Flautist',
			'Classical Guitarist',
			'Saxophonist',
			'Trumpeter',
			'Violinist',
		];

		foreach($categories as $category) {

			$new_category = new Category();
			$new_category['name'] = $category;
			$new_category['description'] = $faker->text();
			$new_category->save(); // ! DB writing here ! 

		}
		
    }
}
