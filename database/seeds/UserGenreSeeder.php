<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Genre;
use Illuminate\Support\Facades\DB;

class UserGenreSeeder extends Seeder
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
		 * !            E TABELLA GENRE            !
		 * !                                       !
		 * ! ************************************* !
		 */

		$min_num_genres_per_user = 0;
		$max_num_genres_per_user = 4;

		$users = User::All();
		$genres = Genre::All();

		$tag_ids = [];
		foreach ($genres as $genre) $tag_ids[] = $genre['id'];

		foreach ($users as $user) {

			shuffle($tag_ids);
			$tag_num = random_int($min_num_genres_per_user,$max_num_genres_per_user);

			for ($i=0; $i<$tag_num; $i++) {

				DB::table('user_genre')->insert([
        			'user_id'	=> $user['id'],  
        			'genre_id' 	=> $tag_ids[$i],
    			]);

			}
		}
    }
}
