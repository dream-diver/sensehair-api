<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->string("employment");
            $table->integer("hrsWeek")->default(0);
            $table->string("weekDays")->nullable();
            $table->string("firstName");
            $table->string("lastName");
            $table->timestamp("dob");
            $table->string("email");
            $table->string("phone");
            $table->string("address");
            $table->string("zip");
            $table->string("city");
            $table->json("education1");
            $table->json("education2");
            $table->json("education3");
            $table->json("exp1");
            $table->json("exp2");
            $table->json("exp3");
            $table->string("motivation",2000)->nullable();
            $table->string("resume")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_applications');
    }
}
