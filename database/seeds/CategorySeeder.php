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
			'band',
			'singer',
			'vocalist',
			'composer',
			'lyricist',
			'mixer',
			'engineer',
			'record company',
			'disc jockey',
			'bassist',
			'guitarist',
			'drummer',
			'accordionist',
			'clarinetist',
			'flautist',
			'classical guitarist',
			'saxophonist',
			'trumpeter',
			'violinist',
		];

		foreach($categories as $category) {

			$new_category = new Category();
			$new_category['name'] = $category;
			$new_category['description'] = $faker->text();
			$new_category->save(); // ! DB writing here ! 

		}
		
    }
}
