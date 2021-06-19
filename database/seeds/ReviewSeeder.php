<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Review;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
		/** 
		 * ! ************************************* !
		 * !                                       !
		 * ! ESEGUIRE SOLO DOPO SEED TABELLA USERS !
		 * !                                       !
		 * ! ************************************* !
		 */

		/**
		 * Review Model $fillable:
		 * 	'user_id','slug',
		 * 	'rev_sender_name','rev_subject','rev_vote','rev_text'
		 */
		
		$min_rev_number = 0;
		$max_rev_number = 10;

		$users = User::All();

		foreach ($users as $user) {

			$rev_num = random_int($min_rev_number,$max_rev_number);

			if ($rev_num > 0) {
				for ($i=1; $i<=$rev_num; $i++) {
	
					$rev_text_is_present = random_int(0,1);

					$new_review = new Review();
					$new_review['user_id'] = $user['id'];
					$new_review['rev_sender_name'] = $faker->name();
					$new_review['rev_vote'] = random_int(1,5);
					$new_review['rev_subject'] = $faker->sentence(rand(2,6)); // ! required for slug
					$new_review['rev_text'] = $rev_text_is_present ? $faker->text() : '';	
					// slug must be unique
					$slug = Str::slug($new_review['rev_subject'],'-');
					$slug_tmp = $slug;
					$slug_is_present = Review::where('slug',$slug)->first();
					$counter = 1;
					while ($slug_is_present) {
						$slug = $slug_tmp.'-'.$counter;
						$counter++;
						$slug_is_present = Review::where('slug',$slug)->first();
					}
					$new_review['slug'] = $slug;
					$new_review->save(); // ! DB writing here ! 

				}
			}
		}
	}
}
