<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoppedStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stopped_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('favorite_time');
            $table->integer('nationality_id');
            $table->integer('country_residence_id');
            $table->string('city');
            $table->string('postal_code');
            $table->string('place_birth');
            $table->string('address');
            $table->string('id_number');
            $table->string('father_whatsApp_number');
            $table->string('mother_whatsApp_number');
            $table->string('father_email');
            $table->string('mother_email');
            $table->string('preferred_language');
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
        Schema::dropIfExists('stopped_students');
    }
}
