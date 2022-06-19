<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_en');
            $table->integer('duration'); // in minutes

            $table->float('stylist_price');
            $table->float('art_director_price');

            $table->string('hair_size');
            $table->string('hair_size_nl')->nullable();
            $table->string('hair_type')->nullable();
            $table->string('hair_type_nl')->nullable();
            
            $table->string('category');
            $table->string('category_en');
            
            $table->softDeletes();
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
        Schema::dropIfExists('services');
    }
}
