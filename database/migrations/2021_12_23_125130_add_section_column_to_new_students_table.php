<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionColumnToNewStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_students', function (Blueprint $table) {
            $table->enum('section', [1, 2])->after('family_name'); // 1 => Male, 2 => Female
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_students', function (Blueprint $table) {
            //
        });
    }
}
