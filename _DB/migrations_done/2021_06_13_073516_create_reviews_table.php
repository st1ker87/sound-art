<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

			// foreign key: user_id <-> id users table
			$table->unsignedBigInteger('user_id'); // ! REVIEW RECIPIENT
			$table->foreign('user_id')->references('id')->on('users');

			// slug: rev_subject
			$table->string('slug')->unique();

			// message infos 
            $table->string('rev_sender_name')->nullable();
            $table->string('rev_subject'); // ! required for slug
			$table->tinyInteger('rev_vote'); // ! 'rev_vote' => 'tinyInteger|min:1|max:5'
            $table->text('rev_text')->nullable();

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
        Schema::dropIfExists('reviews');
    }
}
