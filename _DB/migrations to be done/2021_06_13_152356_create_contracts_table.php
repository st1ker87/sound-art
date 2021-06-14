<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

			// foreign key: user_id <-> id users table
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			
			// foreign key: sponsorship_id <-> id sponsorships table
			$table->unsignedBigInteger('sponsorship_id');
			$table->foreign('sponsorship_id')->references('id')->on('sponsorships');

			// date_start: created_at 
			$table->dateTime('date_start', 0); 	// ! usato in laravel-boolpress-base

			// date_end: created_at + sponsorships hour_duration
			$table->dateTime('date_end', 0);

			// transaction_status (Brain Tree Payments)
			$table->string('transaction_status'); // ??? formato? contenuti? ???

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
