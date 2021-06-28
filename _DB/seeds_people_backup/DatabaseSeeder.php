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
		// # BASE STRUCTURE # 

		// tags
		$this->call(CategorySeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(OfferSeeder::class);

		// sponsorships
        $this->call(SponsorshipSeeder::class);

		// # PEOPLE # 

		$this->call(SinglePersonSeeder1::class);
		$this->call(SinglePersonSeeder2::class);
		$this->call(SinglePersonSeeder3::class);
		$this->call(SinglePersonSeeder4::class);
		$this->call(SinglePersonSeeder5::class);
		$this->call(SinglePersonSeeder6::class);
		$this->call(SinglePersonSeeder7::class);
		$this->call(SinglePersonSeeder8::class);
		$this->call(SinglePersonSeeder9::class);
		$this->call(SinglePersonSeeder10::class);
		$this->call(SinglePersonSeeder11::class);
		$this->call(SinglePersonSeeder12::class);
		$this->call(SinglePersonSeeder13::class);
		$this->call(SinglePersonSeeder14::class);
		$this->call(SinglePersonSeeder15::class);
		$this->call(SinglePersonSeeder16::class);
		$this->call(SinglePersonSeeder17::class);
		$this->call(SinglePersonSeeder18::class);
		$this->call(SinglePersonSeeder19::class);
		$this->call(SinglePersonSeeder20::class);
		$this->call(SinglePersonSeeder21::class);
		$this->call(SinglePersonSeeder22::class);
		$this->call(SinglePersonSeeder23::class);
		$this->call(SinglePersonSeeder24::class);
		$this->call(SinglePersonSeeder25::class);
		$this->call(SinglePersonSeeder26::class);
		$this->call(SinglePersonSeeder27::class);
		$this->call(SinglePersonSeeder28::class);
		$this->call(SinglePersonSeeder29::class);
		$this->call(SinglePersonSeeder30::class);
		$this->call(SinglePersonSeeder31::class);
		$this->call(SinglePersonSeeder32::class);
		$this->call(SinglePersonSeeder33::class);
		$this->call(SinglePersonSeeder34::class);
		$this->call(SinglePersonSeeder35::class);
		$this->call(SinglePersonSeeder36::class);
		$this->call(SinglePersonSeeder37::class);
		$this->call(SinglePersonSeeder38::class);
		$this->call(SinglePersonSeeder39::class);
		$this->call(SinglePersonSeeder40::class);
		$this->call(SinglePersonSeeder41::class);
		$this->call(SinglePersonSeeder42::class);
		$this->call(SinglePersonSeeder43::class);
		$this->call(SinglePersonSeeder44::class);
		$this->call(SinglePersonSeeder45::class);
		$this->call(SinglePersonSeeder46::class);
		$this->call(SinglePersonSeeder47::class);
		$this->call(SinglePersonSeeder48::class);
		$this->call(SinglePersonSeeder49::class);
		$this->call(SinglePersonSeeder50::class);
		$this->call(SinglePersonSeeder51::class);
		$this->call(SinglePersonSeeder52::class);
		$this->call(SinglePersonSeeder53::class);
		$this->call(SinglePersonSeeder54::class);
		$this->call(SinglePersonSeeder55::class);
		$this->call(SinglePersonSeeder56::class);
		$this->call(SinglePersonSeeder57::class);
		$this->call(SinglePersonSeeder58::class);
		$this->call(SinglePersonSeeder59::class);
		$this->call(SinglePersonSeeder60::class);
    }
}
