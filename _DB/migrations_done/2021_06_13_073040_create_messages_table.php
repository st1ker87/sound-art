<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

			// foreign key: user_id <-> id users table
			$table->unsignedBigInteger('user_id'); // ! MESSAGE RECIPIENT
			$table->foreign('user_id')->references('id')->on('users');

			// slug: msg_subject
			$table->string('slug')->unique();

			// message infos 
            $table->string('msg_sender_email');
            $table->string('msg_sender_name')->nullable();
            $table->string('msg_subject'); // ! required for slug
            $table->text('msg_text');
			$table->boolean('msg_read_status')->default(0); // ! 'msg_read_status' => 'boolean'

            $table->timestamps(); // ! message date here 'created_at' 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
