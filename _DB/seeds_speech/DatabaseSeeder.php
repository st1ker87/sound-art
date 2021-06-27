<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// users 
		$this->call(UserSeeder::class);
        
		// profiles
		$this->call(ProfileSeeder::class);

		// tags
		$this->call(CategorySeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(OfferSeeder::class);

		// tag links
		$this->call(UserCategorySeeder::class);
		$this->call(UserGenreSeeder::class);
		$this->call(UserOfferSeeder::class);

		// feedbacks
        $this->call(MessageSeeder::class);
        $this->call(ReviewSeeder::class);

		// sponsorships
        $this->call(SponsorshipSeeder::class);

		// contracts
        $this->call(ContractSeeder::class);
    }
}
