<?php

use Illuminate\Support\Facades\Schema;
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
            $table->integer('user_id')->unsigned()
                ->index()
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');;
            $table->string('name');
            $table->string('family_name')->nullable();
            $table->integer('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender')->default('male');
            $table->integer('country_id')->nullable()
                ->references('id')
                ->on('countries')
                ->onDelete('CASCADE');
            $table->integer('created_at');
            $table->integer('updated_at');
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
