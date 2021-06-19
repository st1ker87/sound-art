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
		/**
		 * Category Model $fillable:
		 * 	'name', 'description'
		 */
		
		$categories = [
			'accordionist',
			'band',
			'bassist',
			'clarinetist',
			'composer',
			'disc jockey',
			'drummer',
			'engineer',
			'flautist',
			'guitarist',
			'lyricist',
			'mixer',
			'record company',
			'singer',
			'vocalist',
			'classical guitarist',
			'saxophonist',
			'trumpeter',
			'violinist',
			'pianist'
		];

		sort($categories);

		foreach($categories as $category) {

			$new_category = new Category();
			$new_category['name'] = $category;
			$new_category['description'] = $faker->text();
			$new_category->save(); // ! DB writing here ! 

		}
		
    }
}
