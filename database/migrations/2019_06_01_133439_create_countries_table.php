<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug');
            $table->integer('parent_id')->nullable()
                ->references('id')
                ->on('countries')
                ->onDelete('CASCADE');
            $table->float('lat', 20, 10)->nullable();
            $table->float('lng', 20, 10)->nullable();
            $table->string('code', 2)->nullable();
            $table->unique(['parent_id', 'slug']);
            $table->unique(['parent_id', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
