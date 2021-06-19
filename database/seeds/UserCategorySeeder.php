<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use Illuminate\Support\Facades\DB;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/** 
		 * ! ************************************* !
		 * !                                       !
		 * ! ESEGUIRE SOLO DOPO SEED TABELLA USERS !
		 * !          E TABELLA CATEGORY           !
		 * !                                       !
		 * ! ************************************* !
		 */

		$min_num_categories_per_user = 0;
		$max_num_categories_per_user = 3;

		$users = User::All();
		$categories = Category::All();

		$tag_ids = [];
		foreach ($categories as $category) $tag_ids[] = $category['id'];

		foreach ($users as $user) {

			shuffle($tag_ids);
			$tag_num = random_int($min_num_categories_per_user,$max_num_categories_per_user);

			for ($i=0; $i<$tag_num; $i++) {

				DB::table('user_category')->insert([
        			'user_id'	 	=> $user['id'],  
        			'category_id' 	=> $tag_ids[$i],
    			]);

			}
		}
    }
}
