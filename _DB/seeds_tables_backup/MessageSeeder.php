<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Message;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
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
		 * Message Model $fillable:
		 * 	'user_id','slug',
		 * 	'msg_sender_email','msg_sender_name','msg_subject','msg_text','msg_read_status'
		 */
	
		$min_msg_number = 0;
		$max_msg_number = 10;

		$users = User::All();

		foreach ($users as $user) {

			$msg_num = random_int($min_msg_number,$max_msg_number);

			if ($msg_num > 0) {
				for ($i=1; $i<=$msg_num; $i++) {
	
					$new_message = new Message();
					$new_message['user_id'] = $user['id'];
					$new_message['msg_sender_email'] = $faker->freeEmail();
					$new_message['msg_sender_name'] = $faker->name();
					$new_message['msg_subject'] = $faker->sentence(rand(2,6));
					$new_message['msg_text'] = $faker->text();
					// slug must be unique
					$slug = Str::slug($new_message['msg_subject'],'-');
					$slug_tmp = $slug;
					$slug_is_present = Message::where('slug',$slug)->first();
					$counter = 1;
					while ($slug_is_present) {
						$slug = $slug_tmp.'-'.$counter;
						$counter++;
						$slug_is_present = Message::where('slug',$slug)->first();
					}
					$new_message['slug'] = $slug;
					$new_message['msg_read_status'] = 0;
					$new_message->save(); // ! DB writing here ! 

				}
			}
		}
	}
}
