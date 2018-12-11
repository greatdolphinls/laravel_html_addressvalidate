<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->enum('plan', ['Free', 'Business-Monthly', 'Business-Yearly', 'Enterprise']);
            $table->string('company_name');
            $table->string('website_domain');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone_number');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('pay_method', ['N/A', 'visa', 'paypal', 'Bank Transfer']);
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
        Schema::drop('profiles');
    }
}
