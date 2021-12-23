<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_students', function (Blueprint $table) {
            $table->id();
            $table->date('bod');
            $table->string('favorite_time');
            $table->string('first_name');
            $table->string('father_name');
            $table->string('grandfather_name');
            $table->string('family_name');
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
            $table->string('guardian_name');
            $table->string('guardian_work');
            $table->string('mother_name');
            $table->string('mother_work');
            $table->string('social_situation');
            $table->string('current_disease')->nullable();
            $table->string('name_school')->nullable();
            $table->enum('studied_qaeedah', [0, 1])->default(0);
            $table->string('student_id_image');
            $table->string('guardian_id_image');
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
        Schema::dropIfExists('new_students');
    }
}
