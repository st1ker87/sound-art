<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

			// foreign key: user_id <-> id users table
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			// slug: users table 'name-surname'
			$table->string('slug')->unique();

			// personal infos
			$table->string('work_town')->nullable();
			$table->string('work_address')->nullable();
			$table->string('work_address_gps')->nullable();
			$table->string('phone')->nullable(); 		// ! 'phone' => 'string'
            $table->text('bio_text1')->nullable(); 		// bio storia passata
            $table->text('bio_text2')->nullable();		// condizioni di lavoro
            $table->text('bio_text3')->nullable();		// progetti in corso / futuri
            $table->text('bio_text4')->nullable();		// presentazione breve per card
			$table->string('image_url')->nullable();	// file image in storage
			$table->string('video_url')->nullable();	// file video in storage
			$table->string('audio_url')->nullable();	// file audio in storage

			// public activation
			$table->boolean('public')->default(1);		// ! 'public' => 'boolean'

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
        Schema::dropIfExists('profiles');
    }
}
