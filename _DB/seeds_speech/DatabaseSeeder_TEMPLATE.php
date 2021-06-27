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
		// Kate Glock
		$this->call(SinglePersonSeeder1::class);
		// 
		$this->call(SinglePersonSeeder2::class);
		//
		$this->call(SinglePersonSeeder3::class);
		//
		$this->call(SinglePersonSeeder4::class);
		//
		$this->call(SinglePersonSeeder5::class);
		//
		$this->call(SinglePersonSeeder6::class);
		//
		$this->call(SinglePersonSeeder7::class);
		//
		$this->call(SinglePersonSeeder8::class);
		//
		$this->call(SinglePersonSeeder9::class);
		//
		$this->call(SinglePersonSeeder10::class);
		//
		$this->call(SinglePersonSeeder11::class);
		//
		$this->call(SinglePersonSeeder12::class);
		//
		$this->call(SinglePersonSeeder13::class);
		//
		$this->call(SinglePersonSeeder14::class);
		//
		$this->call(SinglePersonSeeder15::class);

    }
}
