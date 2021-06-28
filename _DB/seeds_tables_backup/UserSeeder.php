<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// protected $fillable = [
		// 	'name', 'surname', 'email', 'password',
		// ];

		$number_of_users_to_be_created = 50;

		$names = ['Lorenzo','Enrico','Francesco','Fabrizio','Antonello','Paola','Elisa','Gianna','Vasco','Mina','Ornella','Loredana','Patty','Marco Antonio'];
		$surnames = ['De Andre','Ruggeri','Guccini','Cherubini','Venditti','De Gregori','Turci','Pausini','Nannini','Rossi'];
		
		for ($i=0; $i<$number_of_users_to_be_created; $i++) {
		
			$name = $names[random_int(0,count($names)-1)];
			$surname = $surnames[random_int(0,count($surnames)-1)];
			// email must be unique
			$email_name = strtolower(str_replace(' ', '', $name));
			$email = $email_name.'@gmail.com';
			$email_is_present = User::where('email',$email)->first();
			$counter = 1;
			while ($email_is_present) {
				$email = $email_name.$counter.'@gmail.com';
				$counter++;
				$email_is_present = User::where('email',$email)->first();
			}
			$password = explode('@', $email)[0].explode('@', $email)[0];
		
			$new_user = new User();
			$new_user['name'] 		= $name;
			$new_user['surname'] 	= $surname;
			$new_user['email'] 		= $email;
			$new_user['password'] 	= Hash::make($password);
			$new_user->save(); // ! DB writing here ! 
		
		}
	}
}
